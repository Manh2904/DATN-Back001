<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $voucher = Voucher::where('active', 1)
        ->where('expired_date', '>', now())
        ->get();
        $viewData = [
            'status' => 'success',
            'content' => $voucher
        ];
        return response()->json($viewData);
    }
    public function detail(Request $request){
        $voucher= Voucher::where('name', $request->voucher)
        ->where('active', 1)
        ->where('expired_date', '>', now())
        ->first();
        $viewData = [
            'status'              => 'success',
            'content'              => $voucher,
        ];
        return response()->json($viewData);
    }
}
