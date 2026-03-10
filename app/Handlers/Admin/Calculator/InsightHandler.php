<?php

/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */

namespace App\Handlers\Admin\Calculator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsightHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public static function handler(Request $request, $api = false)
{
    $query = DB::table('salary_insight_logs');

    // 🔍 Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('ip_address', 'like', "%{$request->search}%")
              ->orWhere('browser', 'like', "%{$request->search}%")
              ->orWhere('os', 'like', "%{$request->search}%");
        });
    }

    // 🌍 Filter by country
    if ($request->country) {
        $query->where('country', $request->country);
    }

    // 📱 Filter by device
    if ($request->device) {
        $query->where('device', $request->device);
    }

    // Logs
    $insightLogs = $query->latest()->paginate(20);

    // 📊 Statistics
    $stats = [
        'total' => DB::table('salary_insight_logs')->count(),
        'countries' => DB::table('salary_insight_logs')->distinct('country')->count('country'),
        'devices' => DB::table('salary_insight_logs')->distinct('device')->count('device'),
        'browsers' => DB::table('salary_insight_logs')->distinct('browser')->count('browser'),
    ];

    // Country list for filter
    $countries = DB::table('salary_insight_logs')->select('country')->distinct()->pluck('country');

    return view('admin.Calculator.Insight', compact(
        'insightLogs',
        'stats',
        'countries'
    ));
}
}
