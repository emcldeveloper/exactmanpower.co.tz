<?php

namespace App\Http\Controllers\Maintenance;

use App\Models\Merchant;
use App\Models\Transaction;
use App\Models\TransactionRequest;
use App\Models\TransactionCharge;
use App\Models\MerchantCollectionNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestPayment(Request $request)
    {
        return [];
    }    
}
