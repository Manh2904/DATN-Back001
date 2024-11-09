<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;
use Carbon\Carbon;
class UserRatingController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::where('pro_slug', $request->product_id)->first();
        $rating = Rating::where('r_product_id', $product->id)->with('user')->get();
        $viewData = [
            'status' => 'success',
            'content' => $rating
        ];
        return response()->json($viewData);
    }

    public function store(Request $request){
        $rating                     =new Rating();
        $rating->r_user_id          =\Auth::id();
        $rating->r_product_id       =$request->r_product_id;
        $rating->r_number           =$request->r_number;
        $rating->r_content          =$request->r_content;
        $rating->created_at         =Carbon::now();
        $rating->save();
        if($rating->id){
        $this->staticRatingProduct($request->r_product_id ,$request->r_number);
        }
        $viewData = [
            'status'              => 'success'
        ];
        return response()->json($viewData);
    }

    public function date($time){
        Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
        $now = Carbon::now();
        return $time->diffForHumans($now); //12 phút trước
    }

    //tăng rating trong product
    public function staticRatingProduct($productId ,$number){
        $product    =Product::find($productId);
        $product->pro_review_total++;
        $product->pro_review_star +=$number;
        $product->save();
    }
}
