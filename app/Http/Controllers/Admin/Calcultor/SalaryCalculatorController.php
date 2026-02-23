<?php

namespace App\Http\Controllers\Admin\Calcultor;

use App\Http\Controllers\Controller;
use App\Models\SalaryInsightLog;
use Illuminate\Http\Request;

class SalaryCalculatorController extends Controller
{
    public function index(Request $request)
    {

        // -----------------------------
        // 1. DATE RANGE / PRESETS
        // -----------------------------
        $preset = $request->get('preset'); // last7, last30, last90, ytd

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->start_date;
            $end   = $request->end_date;
        } else {
            // If no manual dates, use preset or default (last 30 days)
            switch ($preset) {
                case 'last7':
                    $start = now()->subDays(6)->toDateString();
                    $end   = now()->toDateString();
                    break;

                case 'last30':
                    $start = now()->subDays(29)->toDateString();
                    $end   = now()->toDateString();
                    break;

                case 'last90':
                    $start = now()->subDays(89)->toDateString();
                    $end   = now()->toDateString();
                    break;

                case 'ytd':
                    $start = now()->startOfYear()->toDateString();
                    $end   = now()->toDateString();
                    break;

                default:
                    // Default = last 30 days
                    $start = now()->subDays(29)->toDateString();
                    $end   = now()->toDateString();
                    break;
            }
        }

        // -----------------------------
        // 2. BASE QUERY
        // -----------------------------
        $baseQuery = SalaryInsightLog::whereBetween('created_at', [
            $start . ' 00:00:00',
            $end   . ' 23:59:59',
        ]);

        // -----------------------------
        // 3. SUMMARY METRICS
        // -----------------------------
        $total_uses = (clone $baseQuery)->count();

        $salary_type_usage = (clone $baseQuery)
            ->selectRaw('salary_type, COUNT(*) as total')
            ->groupBy('salary_type')
            ->get();

        $currency_usage = (clone $baseQuery)
            ->selectRaw('currency, COUNT(*) as total')
            ->groupBy('currency')
            ->get();
        $os_usage = (clone $baseQuery)
            ->selectRaw('os, COUNT(*) as total')
            ->groupBy('os')
            ->get();
        $device_usage = (clone $baseQuery)
            ->selectRaw('device, COUNT(*) as total')
            ->groupBy('device')
            ->get();
        $browser_usage = (clone $baseQuery)
            ->selectRaw('browser, COUNT(*) as total')
            ->groupBy('browser')
            ->get();

        // -----------------------------
        // 4. TREND DATA
        // -----------------------------

        // Daily
        $usage_per_day = (clone $baseQuery)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Weekly (ISO week, year + week_number)
        $usage_per_week = (clone $baseQuery)
            ->selectRaw('YEAR(created_at) as year, WEEK(created_at, 1) as week_number, COUNT(*) as total')
            ->groupBy('year', 'week_number')
            ->orderBy('year')
            ->orderBy('week_number')
            ->get()
            ->map(function ($row) {
                $row->label = $row->year . '-W' . str_pad($row->week_number, 2, '0', STR_PAD_LEFT);
                return $row;
            });

        // Monthly (Year + Month label)
        $usage_per_month = (clone $baseQuery)
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month_number, COUNT(*) as total')
            ->groupBy('year', 'month_number')
            ->orderBy('year')
            ->orderBy('month_number')
            ->get()
            ->map(function ($row) {
                // Example label: 2026-02
                $row->label = $row->year . '-' . str_pad($row->month_number, 2, '0', STR_PAD_LEFT);
                return $row;
            });

        // Yearly
        $usage_per_year = (clone $baseQuery)
            ->selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return view('admin.Calculator.index', compact(
            'total_uses',
            'salary_type_usage',
            'currency_usage',
            'usage_per_day',
            'usage_per_week',
            'usage_per_month',
            'usage_per_year',
            'start',
            'end',
            'preset'
        ));
    }
}
