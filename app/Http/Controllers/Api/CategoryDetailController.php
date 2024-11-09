<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryDetailController extends Controller
{
    public function getCategoryDetail(Request $request, $slug)
    {
        $cate = Category::with('product')->where('c_slug', $slug)->first();
        $products = Product::where([
            'pro_category' => $cate->id,
            'pro_active' => 1
        ]);
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '1':
                    $products->where('pro_price', '<', 2000000);
                    break;

                case '2':
                    $products->whereBetween('pro_price', [2000000, 5000000]);
                    break;
                case '5':
                    $products->whereBetween('pro_price', [5000000, 10000000]);
                    break;
                case '10':
                    $products->whereBetween('pro_price', [10000000, 50000000]);
                    break;
                case '50':
                    $products->where('pro_price', '>', 50000000);
                    break;
            }
        }
        if ($request->s) {
            $request->s == 1 ? $products->orderBy('pro_price', 'desc') : $products->orderBy('pro_price', 'asc');
        }
        $products = $products->orderByDesc('pro_pay')->paginate(15);
        $viewData = [
            'cate' => $cate,
            'products' => $products
        ];
        return response()->json($viewData);
    }
}
