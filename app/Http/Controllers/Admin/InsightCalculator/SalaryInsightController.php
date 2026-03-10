<?php

namespace App\Http\Controllers\Admin\InsightCalculator;

use App\Handlers\Admin\Calculator\InsightHandler;
use App\Handlers\Admin\Calculator\TaxRateHandler;
use App\Handlers\Admin\Calculator\UpdateTaxRateHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryInsightController extends Controller
{
    public function insight(Request $request)
    {
        return InsightHandler::handler($request);
    }

    public function taxrate(Request $request)
    {
        return  TaxRateHandler::handler($request);
    }
    public function update(Request $request, $id)
    {
        return UpdateTaxRateHandler::handler($request, $id);
      
    }
}
