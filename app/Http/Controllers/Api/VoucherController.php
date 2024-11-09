<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function detail(Request $request){
        $voucher= Voucher::where('name', $request->voucher)
        ->where('expired_date', '>', now())
        ->first();
        $viewData = [
            'status'              => 'success',
            'content'              => $voucher,
        ];
        return response()->json($viewData);
    }
}
