<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Notification;
use Redirect;
use Session;
use URL;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class ShoppingCartController extends Controller
{

    public function index(Request $request)
    {
        $allTransaction = Transaction::where('tst_status', 3)->where('updated_at', '<=', date('Y-m-d', strtotime('-3 days')))->get();
        foreach ($allTransaction as $value) {
            $value->update(['tst_status' => 4]);
        }
        $transactions = Transaction::with('orders.product', 'voucher')->where('tst_user_id',get_data_user('api', 'id'))->orderBy('id', 'desc');
        if ($request->id) $transactions->where('id', $request->id);
        if ($email = $request->email) {
            $transactions->where('tst_email', 'like', '%' . $email . '%');
        }
        if ($type = $request->type) {
            if ($type == 1) {
                $transactions->where('tst_user_id', 1);
            } else {
                $transactions->where('tst_user_id', 0);
            }
        }
        if ($status = $request->status) {
            $transactions->where('tst_status', $status);
        }
        $transactions = $transactions->paginate(10);

        $viewData = [
            'status' => 'success',
            'shopping' => $transactions
        ];
        return response()->json($viewData);
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return redirect()->to('/');
        $kickco = 0;
        if ($request->kichco) {
            $kickco = $request->kichco;
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->pro_name,
            'qty' => 1,
            'price' => $product->pro_price ,
            'weight' => '1',
            'options' => [
                'image' => $product->pro_avatar,
                'sale'  => $product->pro_sale,
                'size'  => $kickco
            ]
        ]);
        return true;
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        return true;
    }

    //update cart
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $qty = $request->qty + 1?? 1;
            $idProduct = $request->idProduct;
            $product = Product::find($idProduct);
            if (!$product) return response(['messages' => 'Không tồn tại sản phẩm']);

            if ($product->pro_amount < $qty) {
                return response([
                    'messages' => 'Hiện tại chúng tôi không đủ số lượng',
                    'error' => true
                ]);
            }
            Cart::update($id, $qty); //update the quantity
            return response([
                'messages' => 'Cập nhật thành công',
                'totalMoney' => Cart::subtotal(0),
                'totalItem' => number_price( ($product->pro_price * $qty * (100 - $product->pro_sale)) / 100,0),
                'number' => Cart::count()
            ]);
        }
    }
}
