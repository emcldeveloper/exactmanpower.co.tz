<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PayCalculator;
use App\Models\SalaryInsightLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;
use Torann\GeoIP\Facades\GeoIP;

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
            // IP location
            // $location = geoip()->getLocation(request()->ip());
            $ip = $ip ?? request()->ip();
            $token = '289bbcd87f0c7e'; // Sign up at ipinfo.io for free token

            $response = Http::get("https://ipinfo.io/{$ip}?token={$token}");
            if ($response->successful()) {
                $data = $response->json();

                // Split location coordinates if available
           
                
                 $countryCode = $data['country'] ?? 'Unknown';
                $city = $data['city'] ?? 'Unknown';
                 $country = $this->getCountryName($countryCode);
            }
            

 

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
                "country"       => $country,
                "city"          => $city,
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
 


// Helper function to convert country codes to names
function getCountryName($countryCode) {
    $countries = [
        'AF' => 'Afghanistan',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, the Democratic Republic of the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea, Democratic People\'s Republic of',
        'KR' => 'Korea, Republic of',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia, the Former Yugoslav Republic of',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States of',
        'MD' => 'Moldova, Republic of',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'CS' => 'Serbia and Montenegro',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard and Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan, Province of China',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania, United Republic of',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Minor Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    ];
    
    return $countries[$countryCode] ?? $countryCode;
}
}
