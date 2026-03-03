<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PayCalculator;
use App\Models\SalaryInsightLog;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;


class SalaryAjaxController extends Controller
{
    public function calculate(Request $request)
    {
        $salaryType   = $request->salaryType;
        $currency     = $request->currencyType ?? 'tz';
        $period       = $request->period ?? 'monthly';

        $basic_pay    = $request->basic_pay !== null && $request->basic_pay !== ''
            ? floatval($request->basic_pay) : null;

        $net_pay      = $request->net_pay !== null && $request->net_pay !== ''
            ? floatval($request->net_pay) : null;

        $allowances   = $request->allowances ?? [];
        $allowances   = array_filter(array_map(function ($v) {
            return ($v === null || $v === '') ? null : floatval($v);
        }, $allowances));

        $total_allowance = array_sum($allowances);

        $ssc_percentage = 0.10;
        $sdl_percentage = 0.035;
        $wcf_percentage = 0.005;

        $data = PayCalculator::first();
        if (!$data) {
            return response()->json(["error" => "Tax configuration missing"], 500);
        }

        $total_gross = 0;
        $ssc = 0;
        $taxable = 0;
        $paye = 0;
        $net = 0;

        // ======================
        // GROSS → NET
        // ======================
        if ($salaryType === 'gross') {

            if ($basic_pay === null) return $this->emptyResponse();

            $total_gross = $basic_pay + $total_allowance;
            $ssc = $total_gross * $ssc_percentage;
            $taxable = $total_gross - $ssc;
            $paye = self::paye($data, $taxable);
            $net = $taxable - $paye;
        }

        // ======================
        // NET → GROSS
        // ======================
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
            $basic_pay   = $total_gross - $total_allowance;

            // ❗ Validation: Prevent incorrect salary input
            if ($total_allowance >= $total_gross) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation error: When the net salary is fixed in the configuration,
                     total allowances must not exceed the basic salary. Please adjust the allowance
                      amounts as necessary.'
                ]);
            }
        }

        // ======================
        // Employer Cost
        // ======================
        $employer_ssc = $total_gross * $ssc_percentage;
        $sdl          = $total_gross * $sdl_percentage;
        $wcf          = $total_gross * $wcf_percentage;
        $grand_total  = $total_gross + $employer_ssc + $sdl + $wcf;

        // ======================
        // Log user usage (INSIGHT)
        // ======================
        $agent = new Agent();
        // Get previous salary type from session
        $previousType = session('last_salary_type');

        // Save current for next time
        session(['last_salary_type' => $salaryType]);

        // Log ONLY if type changed
        $shouldLog = ($previousType !== $salaryType) && !empty($salaryType);

        if ($shouldLog) {

            $agent = new Agent();


            $agent = new Agent();



            // IP location
            $ip = request()->ip();
            $geo = json_decode(file_get_contents("https://ipinfo.io/{$ip}/json"));

            // Country + Region
            $country = $geo->country ?? "Unknown";
            $city    = $geo->city ?? "Unknown";


            SalaryInsightLog::create([
                "salary_type"   => $salaryType,
                "currency"      => $currency,
                "period"        => $period,
                "input_amount"  => $salaryType === "net" ? ($net_pay ?? 0) : ($basic_pay ?? 0),
                "gross_amount"  => $total_gross,
                "net_amount"    => $net,
                "ip_address"    => request()->ip(),
                "user_agent"    => request()->userAgent(),
                "device"        => $agent->device(),
                "os"            => $agent->platform(),
                "browser"       => $agent->browser(),
                "hour"          => now()->format('H'),
                "day"           => now()->format('l'),
                'country'       =>$country,
                'city'        =>$city,
            ]);
        }


        $usage_count = SalaryInsightLog::count();

        // ======================
        // JSON Response
        // ======================
        return response()->json([
            "basic_pay"        => round($basic_pay ?? 0, 2),
            "net_pay"          => round($net ?? 0, 2),
            "total_gross"      => round($total_gross, 2),
            "total_allowance"  => round($total_allowance, 2),
            "ssc_employee"     => round($ssc, 2),
            "paye"             => round($paye, 2),
            "taxable_amount"   => round($taxable, 2),

            "employer_ssc"     => round($employer_ssc, 2),
            "sdl"              => round($sdl, 2),
            "wcf"              => round($wcf, 2),
            "grand_total"      => round($grand_total, 2),

            "usage_count"      => $usage_count
        ]);
    }

    private function emptyResponse()
    {
        return response()->json([
            "basic_pay"        => 0,
            "net_pay"          => 0,
            "total_gross"      => 0,
            "total_allowance"  => 0,
            "ssc_employee"     => 0,
            "paye"             => 0,
            "taxable_amount"   => 0,

            "employer_ssc"     => 0,
            "sdl"              => 0,
            "wcf"              => 0,
            "grand_total"      => 0,

            "usage_count"      => SalaryInsightLog::count()
        ]);
    }

    private static function paye($data, $taxable)
    {
        $p1 = $data->payone_reduction;
        $p2 = $data->paytwo_reduction;
        $p3 = $data->paythree_reduction;
        $p4 = $data->payfour_reduction;

        if ($taxable <= $p1) return 0;
        if ($taxable <= $p2) return ($taxable - $p1) * $data->payone_percentage;
        if ($taxable <= $p3) return ($taxable - $p2) * $data->paytwo_percentage + $data->paytwo_addition;
        if ($taxable <= $p4) return ($taxable - $p3) * $data->paythree_percentage + $data->paythree_addition;

        return ($taxable - $p4) * $data->payfour_percentage + $data->payfour_addition;
    }
}
