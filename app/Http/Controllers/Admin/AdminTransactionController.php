<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Attributes;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\Product;
use DB;
use Excel;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $allTransaction = Transaction::where('tst_status', 3)->where('updated_at', '<=', date('Y-m-d', strtotime('-3 days')))->get();
        foreach ($allTransaction as $value) {
            $value->update(['tst_status' => 4]);
        }
        $transactions = Transaction::orderBy('id', 'desc');
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
        if ($request->export) {
            return Excel::download(new TransactionExport($transactions), date('Y-m-d') . '-don-hang.xlsx');
        }
        $viewData = [
            'transaction' => $transactions,
            'query' => $request->query()
        ];
        return view('admin.transaction.index', $viewData);
    }

    public function getTransactionDetail(Request $request, $id)
    {
        if ($request->ajax()) {
            $modelProduct = new Product();
			$size = $modelProduct->size;
            $order = Order::with('product:id,pro_name,pro_slug,pro_avatar')->where('od_transaction_id', $id)->get();
            foreach ($order as $key => $value) {
                $menuColorId = Menu::where('slug', 'mau')->first()['id'];
                $menuSizeId = Menu::where('slug', 'kich-co')->first()['id'];
                $ord = OrderAttribute::where([
                    'order_id' => $value->id,
                ])->get();
                foreach($ord as $item) {
                    $attrMaus = Attributes::where([
                        'menu_id' => $menuColorId,
                        'id' => $item->attribute_id,
                    ])->first();
                    if ($attrMaus) {
                        $value['mau'] = $attrMaus['name'];
                    }
                    $attrSizes = Attributes::where([
                        'menu_id' => $menuSizeId,
                        'id' => $item->attribute_id,
                    ])->first();
                    if ($attrSizes) {
                        $value['size'] = $attrSizes['name'];
                    }
                }

            }
            $html = view("component.transaction", compact('order', 'size'))->render();
            return response([
                'html' => $html
            ]);
        }
    }

    public function guest($id)
    {
        $transactions = Transaction::find($id);
        if ($transactions) {
            $transactions->tst_user_id = !$transactions->tst_user_id;
        }
        $transactions->save();
        return redirect()->back();
    }

    public function deleteOrderItem(Request $request, $id)
    {
        if ($request->ajax()) {
            $order = Order::find($id);
            if ($order) {
                $money = $order->od_qty * $order->od_price;

                DB::table('transactions')
                    ->where('id', $order->od_transaction_id)
                    ->decrement('tst_total_money', $money);
                $order->delete();

            }
            return response(['code' => 299]);
        }

    }

    public function delete($id)
    {
        $transactions = Transaction::find($id);
        if ($transactions) {
            $transactions->delete();
            DB::table('orders')->where('od_transaction_id', $id)->delete();

            return redirect()->back();
        }
    }

    public function getAction($action, $id)
    {
        // [5, 6, 2, 3, 4, -1]
        $transactions = Transaction::find($id);
        if ($transactions) {
            switch ($action) {
                case 'process':
                    if($transactions->tst_status == 6) {
                        $transactions->tst_status = 2;
                    }
                    break;
                case 'success':
                    if($transactions->tst_status == 2) {
                        $transactions->tst_status = 3;
                    }
                    break;

                case 'cancel':
                    if($transactions->tst_status == 5 && $transactions->tst_status == 6) {
                        $transactions->tst_status = -1;
                    }
                    break;

                case 'confirm':
                    if($transactions->tst_status == 3) {
                        $transactions->tst_status = 4;
                    }
                    break;

                // case 'waiting_confirmation':
                //     if($transactions->tst_status == 5) {
                //         $transactions->tst_status = 5;
                //     }
                //     break;

                case 'confirmed':
                    if($transactions->tst_status == 5) {
                        $transactions->tst_status = 6;
                    }
                    break;
            }
            $transactions->save();
        }
        return redirect()->back();
    }

    public function cancelTransaction(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        if($transaction->tst_status == 5 || $transaction->tst_status == 6) {
            $viewData = [
              'transaction' => $transaction,
            ];
            return view('admin.transaction.cancel', $viewData);
        }
        return back();
    }


    public function cancelTransactionAction(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->tst_status = -1;
        $transaction->description_cancel = $request->description_cancel;
        $transaction->update();
        $orders = Order::where("od_transaction_id", $id)->get();
        foreach ($orders as $order) {
            $product = Product::find($order->od_product_id);
            $product->pro_pay = $product->pro_pay - 1;
            $product->pro_amount = $product->pro_amount + $order->od_qty;
            $product->update();
        }
        return redirect()->route('admin.transaction.index');
    }

}
