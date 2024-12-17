<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{

    use AuthenticatesUsers;

    public function getLoginAdmin()
    {
        if (get_data_user('admins', 'id')) {
            return redirect()->route('admin.index');
        }
        return view('admin.auth.login');
    }

    public function postLoginAdmin(Request $request)
    {
        if (get_data_user('admins', 'id')) {
            return redirect()->route('admin.index');
        }
        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->route('admin.index');
        }

        return redirect()->back();
    }

    public function getLogoutAdmin()
    {
        Auth::guard('admins')->logout();
        return redirect()->to('http://localhost:8000/');
    }

}
