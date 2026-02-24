<?php

namespace App\Livewire\Website\Tax;

use App\Models\PayCalculator;
use App\Models\SalaryInsight;
use App\Models\SalaryInsightLog;
use Livewire\Component;
use Jenssegers\Agent\Agent;


class SalaryCalculator extends Component
{
    public $salaryType = '';
    public $period = 'monthly';

    public $currencyType = 'tz';
    public $exchangeRate = 1;

    public $basic_pay = null;
    public $net_pay = null; // Changed from 0 to null

    public $allowances = [];
    public $total_allowance = 0;

    public $total_gross = 0;
    public $taxable_amount = 0;
    public $pay = null;
    public $ssc_employee = 0;

    public $ssc_employee_percentage = 0.10;

    public $showCompanyCost = false;

    public $employer_ssc = 0;
    public $sdl = 0;
    public $wcf = 0;
    public $grand_total = 0;

    public $new = 0;
    public $data;
    public $activeField = null;

    public function mount()
    {
        $this->data = PayCalculator::first();
        $this->new = SalaryInsightLog::count();
        
        // Initialize with null
        $this->basic_pay = null;
        $this->net_pay = null;
        $this->allowances = [];
    }

    public function updated($property)
    {
        if (
            in_array($property, [
                'basic_pay',
                'net_pay',
                'exchangeRate',
                'currencyType',
                'period'
            ]) || str_starts_with($property, 'allowances')
        ) {
            $this->calculate();
        }

        if ($property === 'salaryType') {
            $this->resetOppositeField();
            $this->calculate();
            $this->insight(); // increment once
        }
    }
  
    public function typing($field)
    {
        $this->activeField = $field;
        $this->calculate();
    }

    private function resetOppositeField()
    {
        if ($this->salaryType === 'net') {
            $this->basic_pay = null;
        }

        if ($this->salaryType === 'gross') {
            $this->net_pay = null;
        }
    }

    public function addAllowance()
    {
        $this->allowances[] = null; // Changed from 0 to null
        $this->calculate();
    }

    public function removeAllowance($index)
    {
        unset($this->allowances[$index]);
        $this->allowances = array_values($this->allowances);
        $this->calculate();
    }

    public function calculate()
    {
        // Only cast to float if the value is not null and not empty
        $this->basic_pay = $this->basic_pay !== null && $this->basic_pay !== '' ? (float) $this->basic_pay : null;
        $this->net_pay = $this->net_pay !== null && $this->net_pay !== '' ? (float) $this->net_pay : null;
        $this->exchangeRate = $this->exchangeRate !== null && $this->exchangeRate !== '' ? (float) $this->exchangeRate : 1;

        // Handle allowances - only cast non-null values
        $this->allowances = array_map(function($v) {
            return $v !== null && $v !== '' ? (float) $v : null;
        }, $this->allowances);
        
        // Sum only non-null values for total_allowance
        $this->total_allowance = array_sum(array_filter($this->allowances, function($v) {
            return $v !== null;
        }));

        if ($this->salaryType === 'gross') {
            $this->calculateFromGross();
        }

        if ($this->salaryType === 'net') {
            $this->calculateFromNet();
        }
    }

    private function calculateFromGross()
    {
        // Only calculate if basic_pay has a value
        if ($this->basic_pay === null) {
            $this->total_gross = 0;
            $this->ssc_employee = 0;
            $this->taxable_amount = 0;
            $this->pay = 0;
            $this->net_pay = null; // Keep net_pay as null initially
            $this->calculateCompanyCost();
            return;
        }

        $this->total_gross = $this->basic_pay + $this->total_allowance;
        $this->ssc_employee = $this->total_gross * $this->ssc_employee_percentage;
        $this->taxable_amount = $this->total_gross - $this->ssc_employee;
        $this->pay = $this->calculatePAYE($this->taxable_amount);

        if ($this->activeField !== 'net_pay') {
            $this->net_pay = $this->taxable_amount - $this->pay;
        }

        $this->calculateCompanyCost();
    }

    private function calculateFromNet()
    {
        // Only calculate if net_pay has a value
        if ($this->net_pay === null || $this->net_pay <= 0) {
            $this->total_gross = 0;
            $this->ssc_employee = 0;
            $this->taxable_amount = 0;
            $this->pay = 0;
            $this->basic_pay = null; // Keep basic_pay as null initially
            $this->calculateCompanyCost();
            return;
        }

        $targetNet = $this->net_pay;

        $min = $targetNet;
        $max = $targetNet * 2;

        for ($i = 0; $i < 60; $i++) {
            $gross = ($min + $max) / 2;
            $ssc = $gross * 0.10;
            $taxable = $gross - $ssc;
            $paye = $this->calculatePAYE($taxable);

            $net = $gross - $ssc - $paye;

            if ($net < $targetNet) {
                $min = $gross;
            } else {
                $max = $gross;
            }
        }

        $this->total_gross = $gross;
        $this->ssc_employee = $ssc;
        $this->taxable_amount = $taxable;
        $this->pay = $paye;

        if ($this->activeField !== 'basic_pay') {
            $this->basic_pay = $gross - $this->total_allowance;
        }

        $this->calculateCompanyCost();
    }

    private function calculatePAYE($taxable)
    {
        if (!$this->data) return 0;

        $p1 = $this->data->payone_reduction;
        $p2 = $this->data->paytwo_reduction;
        $p3 = $this->data->paythree_reduction;
        $p4 = $this->data->payfour_reduction;

        if ($taxable <= $p1) return 0;

        if ($taxable <= $p2)
            return ($taxable - $p1) * $this->data->payone_percentage;

        if ($taxable <= $p3)
            return ($taxable - $p2) * $this->data->paytwo_percentage + $this->data->paytwo_addition;

        if ($taxable <= $p4)
            return ($taxable - $p3) * $this->data->paythree_percentage + $this->data->paythree_addition;

        return ($taxable - $p4) * $this->data->payfour_percentage + $this->data->payfour_addition;
    }

    private function calculateCompanyCost()
    {
        $gross = $this->total_gross ?: 0;

        $this->employer_ssc = $gross * 0.10;
        $this->sdl = $gross * 0.035;
        $this->wcf = $gross * 0.005;

        $this->grand_total = $gross + $this->employer_ssc + $this->sdl + $this->wcf;
    }

    public function insight()
    {
        $ip = request()->ip();
        $agent = new Agent();

        SalaryInsightLog::create([

            // Salary metadata
            'salary_type'   => $this->salaryType,
            'currency'      => $this->currencyType,
            'period'        => $this->period,

            // Inputs
            'input_amount'  => $this->salaryType === 'net'
                ? ($this->net_pay ?? 0)
                : ($this->basic_pay ?? 0),

            // Outputs
            'gross_amount'  => $this->total_gross,
            'net_amount'    => $this->net_pay ?? 0,

            // User info
            'ip_address'    => $ip,
            'user_agent'    => request()->userAgent(),
            'device'        => $agent->device(),
            'os'            => $agent->platform(),
            'browser'       => $agent->browser(),

            // Time analytics
            'hour'          => now()->format('H'),
            'day'           => now()->format('l'),
        ]);

        // Update UI usage counter
        $this->new = SalaryInsightLog::count();
    }

    public function render()
    {
        return view('livewire.website.tax.salary-calculator');
    }
}