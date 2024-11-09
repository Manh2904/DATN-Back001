<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $product = Product::all();
        // chọn sản phẩm sắp xếp theo id ( sản phẩm mới)
        $productsAccessoriess = Product::where('pro_active', 1)
            ->where('pro_category', '>', 20)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        // chọn sản phẩm sắp xếp theo hot (sản phẩm hot)
        $productsGlass = Product::where('pro_active', 1)
            ->where('pro_category', '>', 10)
            ->where('pro_category', '<', 21)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        // chọn sản phẩm sắp xếp theo hot (sản phẩm hot)
        $productsWatch = Product::where('pro_active', 1)
            ->where('pro_category', '<', 11)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $listProduct1 = Product::where('pro_active', 1)
            ->where('pro_category', 1)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $listProduct2 = Product::where('pro_active', 1)
            ->where('pro_category', 2)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $listProduct3 = Product::where('pro_active', 1)
            ->where('pro_category', 3)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $listProduct4 = Product::where('pro_active', 1)
            ->where('pro_category', 4)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $listProduct5 = Product::where('pro_active', 1)
            ->where('pro_category', 5)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $listProduct6 = Product::where('pro_active', 1)
            ->where('pro_category', 6)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $listProduct7 = Product::where('pro_active', 1)
            ->where('pro_category', 7)
            ->orderBydesc('pro_pay')
            ->limit(10)
            ->get();
        $data = [
            'category' => $category,
            'product' => $product,
            'productsWatch' => $productsWatch,
            'productsGlass' => $productsGlass,
            'productsAccessoriess' => $productsAccessoriess,
            'title_page' => 'Đồng hồ Thụy Sỹ, đồng hồ nam, đồng hồ nữ chính hãng cao cấp',
            'listProduct1' => $listProduct1,
            'listProduct2' => $listProduct2,
            'listProduct3' => $listProduct3,
            'listProduct4' => $listProduct4,
            'listProduct5' => $listProduct5,
            'listProduct6' => $listProduct6,
            'listProduct7' => $listProduct7,
        ];
        return response()->json($data, 200);
    }
}
