<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menu = Menu::has('attributes')->with('attributes')->where('active', 1)->get();
        $viewData = [
            'content' => $menu,
            'status' => 'success'
        ];
        return response()->json($viewData);
    }
}
