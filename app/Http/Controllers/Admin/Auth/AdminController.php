<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
        return redirect()->to('http://localhost:4000/');
    }

}
