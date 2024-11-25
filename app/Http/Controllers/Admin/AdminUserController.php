<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);
        $viewData = [
            'user' => $user
        ];
        return view('admin.user.index', $viewData);
    }
}
