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

        $taxrate->update($request->except(['_token', '_method']));

        return back()->with('alert-success', 'Tax rate updated successfully');
    }
}
