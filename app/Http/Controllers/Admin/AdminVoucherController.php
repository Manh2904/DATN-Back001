<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestVoucher;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminVoucherController extends Controller
{
    public function index()
    {
        $voucher = Voucher::paginate(10);
        $viewData = [
            'voucher' => $voucher
        ];
        return view('admin.voucher.index', $viewData);
    }

    public function create()
    {
        return view('admin.voucher.create');
    }

    public function store(AdminRequestVoucher $request)
    {
        $data = $request->except('_token');
        $data['created_at'] = Carbon::now();
        $id = Voucher::insertGetId($data);
        return redirect()->back();
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.update', compact('voucher'));
    }

    public function update(AdminRequestVoucher $request, $id)
    {
        $voucher = Voucher::find($id);
        $data = $request->except("_token");
        $data['updated_at'] = Carbon::now();
        $voucher->name = $request->name;
        $voucher->amount = $request->amount;
        $voucher->minimum = $request->minimum;
        $voucher->expired_date = $request->expired_date;
        $voucher->save();
        return redirect()->back();
    }


    public function active($id)
    {
        $voucher = Voucher::find($id);
        $voucher->active = !$voucher->active;
        $voucher->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) $voucher->delete();
        return redirect()->back();
    }

}
