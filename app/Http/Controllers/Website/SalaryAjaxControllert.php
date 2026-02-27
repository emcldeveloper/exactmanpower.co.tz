<?php

namespace App\Http\Controllers;

use App\Models\PayCalculator;
use Illuminate\Http\Request;

class SalaryAjaxController extends Controller
{
    public function calculate(Request $request)
{
    $salaryType = $request->salaryType;
    $basic_pay  = $request->basic_pay !== null && $request->basic_pay !== '' 
                    ? floatval($request->basic_pay) : null;

    $net_pay    = $request->net_pay !== null && $request->net_pay !== '' 
                    ? floatval($request->net_pay) : null;

    $allowances = $request->allowances ?? [];
    $period     = $request->period ?? 'monthly';

    $allowances = array_filter(array_map(function ($v) {
        return ($v === null || $v === '') ? null : floatval($v);
    }, $allowances));

    $total_allowance = array_sum($allowances);

    $ssc_percentage = 0.10;
    $sdl_percentage = 0.035;
    $wcf_percentage = 0.005;

    $data = PayCalculator::first();
    if (!$data) return response()->json(["error" => "Tax configuration missing"], 500);

    $total_gross = 0;
    $ssc = 0;
    $taxable = 0;
    $paye = 0;
    $net = 0;

    if ($salaryType === 'gross') {

        if ($basic_pay === null) return $this->emptyResponse();

        $total_gross = $basic_pay + $total_allowance;
        $ssc = $total_gross * $ssc_percentage;
        $taxable = $total_gross - $ssc;
        $paye = self::paye($data, $taxable);
        $net = $taxable - $paye;
    }

    elseif ($salaryType === 'net') {

        if ($net_pay === null || $net_pay <= 0) return $this->emptyResponse();

        $targetNet = $net_pay;
        $min = $targetNet;
        $max = $targetNet * 2;

        for ($i = 0; $i < 60; $i++) {
            $gross = ($min + $max) / 2;

            $ssc = $gross * $ssc_percentage;
            $taxable = $gross - $ssc;
            $paye = self::paye($data, $taxable);

            $net = $gross - $ssc - $paye;

            if ($net < $targetNet) $min = $gross;
            else $max = $gross;
        }

        $total_gross = $gross;
        $basic_pay = $total_gross - $total_allowance;
    }

    // Employer cost
    $employer_ssc = $total_gross * $ssc_percentage;
    $sdl          = $total_gross * $sdl_percentage;
    $wcf          = $total_gross * $wcf_percentage;

    $grand_total  = $total_gross + $employer_ssc + $sdl + $wcf;

    return response()->json([
        "basic_pay"      => round($basic_pay ?? 0, 2),
        "net_pay"        => round($net ?? 0, 2),
        "total_gross"    => round($total_gross, 2),
        "total_allowance"=> round($total_allowance, 2),
        "ssc_employee"   => round($ssc, 2),
        "paye"           => round($paye, 2),
        "taxable_amount" => round($taxable, 2),

        // NEW (missing before)
        "employer_ssc"   => round($employer_ssc, 2),
        "sdl"            => round($sdl, 2),
        "wcf"            => round($wcf, 2),
        "grand_total"    => round($grand_total, 2),
    ]);
}

    private function emptyResponse()
    {
        return response()->json([
            "basic_pay"      => 0,
            "net_pay"        => 0,
            "total_gross"    => 0,
            "total_allowance"=> 0,
            "ssc_employee"   => 0,
            "paye"           => 0,
            "taxable_amount" => 0,
        ]);
    }

    private static function paye($data, $taxable)
    {
        $p1 = $data->payone_reduction;
        $p2 = $data->paytwo_reduction;
        $p3 = $data->paythree_reduction;
        $p4 = $data->payfour_reduction;

        if ($taxable <= $p1) return 0;

        if ($taxable <= $p2)
            return ($taxable - $p1) * $data->payone_percentage;

        if ($taxable <= $p3)
            return ($taxable - $p2) * $data->paytwo_percentage + $data->paytwo_addition;

        if ($taxable <= $p4)
            return ($taxable - $p3) * $data->paythree_percentage + $data->paythree_addition;

        return ($taxable - $p4) * $data->payfour_percentage + $data->payfour_addition;
    }
}