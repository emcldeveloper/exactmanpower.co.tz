<?php

namespace App\Handlers\Admin\Calculator;

use App\Models\AccessPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmPasswordHandler
{
    public static function handler(Request $request)
    {
        $access = AccessPassword::first();

        if ($access && Hash::check($request->password, $access->password)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}