<?php

/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */

namespace App\Handlers\Admin\Calculator;

use App\Models\PayCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxRateHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        $taxrate = PayCalculator::first();

         
        return view('admin.Calculator.tax-rate', compact('taxrate'));
    }
}
