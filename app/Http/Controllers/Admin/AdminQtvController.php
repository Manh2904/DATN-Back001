<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateQtvRequest;
use App\Http\Requests\AdminUpdateQtvRequest;
use App\Models\Admin;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminQtvController extends Controller
{
    public function index()
    {
        $qtv = Admin::where('id', '<>', get_data_user('admins', 'id'))->paginate(10);
        $viewData = [
            'qtv' => $qtv
        ];
        return view('admin.qtv.index', $viewData);
    }

    public function create()
    {
        return view('admin.qtv.create');
    }

    public function store(AdminCreateQtvRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation');
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = Carbon::now();
        $id = Admin::insertGetId($data);
        return redirect()->to('/api-admin/qtv');
    }

    public function edit($id)
    {
        $qtv = Admin::findOrFail($id);
        return view('admin.qtv.update', compact('qtv'));
    }

    public function update(AdminUpdateQtvRequest $request, $id)
    {
        $qtv = Admin::find($id);
        $data = $request->except("_token", 'password_confirmation');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }
        $qtv->update($data);
        return redirect()->to('/api-admin/qtv');
    }

    public function delete($id)
    {
        $Admin = Admin::find($id);
        if ($Admin) $Admin->delete();
        return redirect()->back();
    }

}
