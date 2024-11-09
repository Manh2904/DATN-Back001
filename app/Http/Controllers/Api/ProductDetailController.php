<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;
use App\Providers\ProcessViewService;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function getProductDetail(Request $request, $slug)
    {
        $product = Product::where('pro_slug', $slug)->with('category:id,c_name,c_slug', 'keyword')->first();
        $user_favourite = DB::table('user_favourite')->where('uf_product_id', $product->id)
            ->where('uf_user_id', Auth::id())->count();
        ProcessViewService::view('products', 'pro_view', 'products', $product->id);

        //bài viết đánh giá chung
        $ratings = Rating::with('user:id,name')
            ->where('r_product_id', $product->id);
        if ($number = $request->s) $ratings->where('r_number', $number);
        $ratings = $ratings->orderByDesc('id')->paginate(5);

        //bài viết đánh giá cá nhân
        $rating = 0;
        if (isset(auth('api')->user()->id)) {
            $rating = Rating::with('user:id,name')
                ->where(['r_product_id' => $product->id, 'r_user_id' => auth('api')->user()->id])
                ->count();
        }

        //sao đánh giá
        $ratingsDashboard = Rating::groupBy('r_number')
            ->where('r_product_id', $product->id)
            ->select(DB::raw('count(r_number) as count_number'), DB::raw('sum(r_number) as total'))
            ->addSelect('r_number')
            ->get()->toArray();

        $ratingDefault = $this->mapRatingDefault();
        foreach ($ratingsDashboard as $key => $item) {
            $ratingDefault[$item['r_number']] = $item;
        }
        $isMuaHang = Order::where('od_product_id', $product->id)
        ->whereHas('transaction', function($q){
            $q->where('tst_user_id', auth('api')->user()->id);
        })->count();
        $product['is_buy'] = $isMuaHang;
        $product['rating'] = $rating;
        $viewData = [
            'status'              => 'success',
            'ratingDefault' => $ratingDefault,
            'product' => $product,
            'ratings' => $ratings,
            'rating' => $rating,
            'user_favourite' => $user_favourite,
            'productSuggest' => $this->getProductsSuggest($product->pro_category),
        ];
        Product::where('id', $product->id)
            ->increment('pro_view');
        return response()->json($viewData);
    }

    private function mapRatingDefault()
    {
        $ratingDefault = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDefault[$i] = [
                'count_number' => 0,
                'total' => 0,
                'r_number' => 0
            ];
        }
        return $ratingDefault;
    }


    private function getProductsSuggest($categoriID)
    {
        $products = Product::where([
            'pro_active' => 1,
            'pro_category' => $categoriID
        ])
            ->orderByDesc('id')
            ->select('id', 'pro_name', 'pro_slug', 'pro_sale', 'pro_amount', 'pro_avatar', 'pro_price')
            ->get();

        return $products;
    }
}
