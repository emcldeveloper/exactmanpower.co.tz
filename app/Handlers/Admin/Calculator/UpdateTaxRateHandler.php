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


class UpdateTaxRateHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $id)
    {
        $taxrate = PayCalculator::findOrFail($id);

        $data = $request->except(['_token', '_method']);

        // Convert percentage to decimal
        $data['payone_percentage'] = $request->payone_percentage / 100;
        $data['paytwo_percentage'] = $request->paytwo_percentage / 100;
        $data['paythree_percentage'] = $request->paythree_percentage / 100;
        $data['payfour_percentage'] = $request->payfour_percentage / 100;

        $taxrate->update($data);

        return back()->with('alert-success', 'Tax rate updated successfully');
    }
}
