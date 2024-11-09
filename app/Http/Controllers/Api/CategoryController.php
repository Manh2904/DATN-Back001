<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cart;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $countCard = Cart::count();
        $viewData = [
            'status' => 'success',
            'countCard' => $countCard,
            'content' => Category::limit(8)->get()
        ];
        return response()->json($viewData);
    }
}
