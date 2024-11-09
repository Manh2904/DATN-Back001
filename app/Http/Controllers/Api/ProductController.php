<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::all();
        $products = Product::where('pro_active', 1)->with('category');
        if ($cate = $request->category_id) {
            $products->whereHas('category', function($q) use ($cate) {
                $q->where('c_slug', $cate);
            });
        }
        if ($name = $request->keyword) {
            $products->where('pro_name', 'like', '%' . $name . '%');
        }
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
        $products = $products
            ->select('id', 'pro_name', 'pro_slug', 'pro_sale', 'pro_avatar', 'pro_price', 'pro_review_total', 'pro_review_star')
            ->paginate(20);
        $viewData = [
            'category' => $category,
            'title_page' => 'Kết quả tìm kiếm cho ' . $name,
            'products' => $products,
            'query' => $request->query()
        ];
        return response()->json($viewData);
    }

    public function list(Request $request){
        $category    =Category::all();
        $product     =Product::limit(20);
        if ($cate = $request->category_id) {
            $product->whereHas('category', function($q) use ($cate) {
                $q->where('c_slug', $cate);
            });
        }
        if ($request->search) {
            $product->where('pro_name', 'like', '%' . $request->search . '%');
        }
        $product = $product->get();
        // chọn sản phẩm sắp xếp theo id ( sản phẩm mới)
        $productsAccessoriess =Product::where('pro_active',1)
        ->where('pro_category','>',20)
        ->orderBydesc('pro_pay')
        ->limit(4)
        ->get();
         // chọn sản phẩm sắp xếp theo hot (sản phẩm hot)
         $productsGlass=Product::where('pro_active',1)
            ->where('pro_category','>',10)
            ->where('pro_category','<',21)
            ->orderBydesc('pro_pay')
            ->limit(4)
            ->get();
        // chọn sản phẩm sắp xếp theo hot (sản phẩm hot)
        $productsWatch =Product::where('pro_active',1)
            ->where('pro_category','<',11)
            ->orderBydesc('pro_pay')
            ->limit(4)
            ->get();
        $listProduct1 =Product::where('pro_active',1)
        ->where('pro_category',1)
        ->with('category')
        ->orderBydesc('pro_pay')
        ->limit(4)
        ->get();
        $listProduct2 =Product::where('pro_active',1)
        ->where('pro_category',2)
        ->with('category')
        ->orderBydesc('pro_pay')
        ->limit(4)
        ->get();
        $listProduct3 =Product::where('pro_active',1)
        ->where('pro_category',3)
        ->with('category')
        ->orderBydesc('pro_pay')
        ->limit(4)
        ->get();
        $listProduct4 =Product::where('pro_active',1)
        ->where('pro_category',4)
        ->with('category')
        ->orderBydesc('pro_pay')
        ->limit(4)
        ->get();
        $listProduct5 =Product::where('pro_active',1)
        ->where('pro_category',5)
        ->with('category')
        ->orderBydesc('pro_pay')
        ->limit(4)
        ->get();
        $listProduct6 =Product::where('pro_active',1)
        ->where('pro_category',6)
        ->with('category')
        ->orderBydesc('pro_pay')
        ->limit(4)
        ->get();
        $listProduct7 =Product::where('pro_active',1)
        ->where('pro_category',7)
        ->with('category')
        ->orderBydesc('pro_pay')
        ->limit(10)
        ->get();
        $viewData=[
            'status'              => 'success',
            'category'            =>$category,
            'product'             =>$product,
            'productsWatch'       =>$productsWatch,
            'productsGlass'       =>$productsGlass,
            'productsAccessoriess'=>$productsAccessoriess,
            'listProduct1'        =>$listProduct1,
            'listProduct2'        =>$listProduct2,
            'listProduct3'        =>$listProduct3,
            'listProduct4'        =>$listProduct4,
            'listProduct5'        =>$listProduct5,
            'listProduct6'        =>$listProduct6,
            'listProduct7'        =>$listProduct7
        ];
        return response()->json($viewData);
    }
}
