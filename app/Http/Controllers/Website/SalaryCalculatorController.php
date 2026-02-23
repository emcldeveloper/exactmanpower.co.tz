<?php

namespace App\Http\Controllers\Website;

use App\Handlers\Website\SalaryCalculator\SalaryCalculatorHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalaryCalculatorController extends Controller
{
    // \App\Http\Controllers\Controller
    public function __construct()
    {
        parent::__construct();
    }
    public function index(Request $request)
    {
        return SalaryCalculatorHandler::handle($request);
    }
}
