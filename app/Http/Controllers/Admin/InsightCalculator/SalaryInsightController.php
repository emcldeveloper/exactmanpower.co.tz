<?php

namespace App\Http\Controllers\Admin\InsightCalculator;

use App\Handlers\Admin\Calculator\ConfirmPasswordHandler;
use App\Handlers\Admin\Calculator\InsightHandler;
use App\Handlers\Admin\Calculator\TaxRateHandler;
use App\Handlers\Admin\Calculator\UpdateTaxRateHandler;
use App\Http\Controllers\Controller;
use App\Models\AccessPassword;
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
    public function  confirmPassword(Request $request)
    {

        return ConfirmPasswordHandler::handler($request);
    }
    public function accesspassword()
    {
        try {

            DB::beginTransaction();

            $password = 'EHrm2026@#';

            $model = new AccessPassword();
            $model->password = $password; // will auto hash from model mutator
            $model->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Access password created successfully'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
