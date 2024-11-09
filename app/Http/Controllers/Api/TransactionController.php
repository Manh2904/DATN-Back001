<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Voucher;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Notification;
use Redirect;
use Mail;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use App\Mail\TransactionSuccess;

class TransactionController extends Controller
{
    public function postPay(Request $request)
    {
        $code = 'SA'. strtoupper(Str::random(10));
        $data = $request->except('_token', 'submit');
        $data['code'] = $code;

        if ($request->tst_type == 1) {
            $this->storeTransaction($data, 1, 1);
        }

        if ($request->tst_type == 2) {

            $this->storeTransaction($data, 5, 2);
            $latestId = Transaction::orderBy('id', 'desc')->first()['id'];
            $vnp_TmnCode = Config::get('env.vnpay.code'); //Mã website tại VNPAY
            $vnp_HashSecret = Config::get('env.vnpay.secret'); //Chuỗi bí mật
            $vnp_Url = Config::get('env.vnpay.url');
            $vnp_Returnurl = Config::get('env.vnpay.callback');
            $vnp_TxnRef = $latestId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->tst_total_money * 100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();
            $startTime = date("YmdHis");
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate"=> date('YmdHis',strtotime('+15 minutes',strtotime($startTime)))
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $viewData = [
                'status'              => 'success',
                'vnp_Url' => $vnp_Url,
            ];
            return response()->json($viewData);
        }
        $viewData = [
            'status'   => 'success',
            'vnp_Url' => null,
        ];
        return response()->json($viewData);
    }

    //store transaction to database
    public function storeTransaction($data, $status, $type)
    {
        $voucher = Voucher::where('name', $data['voucher'])
        ->where('expired_date', '>', now())
        ->first();
        $price = $data['tst_total_money'];
        $id = null;
        if ($voucher) {
            $price = $data['tst_total_money'] * (100 - $voucher->amount) / 100;
            $id = $voucher->id;
        }
        $transactionId = Transaction::create([
            'tst_user_id' => Auth::id(),
            'tst_total_money' => $price,
            'tst_name' => $data['tst_name'],
            'tst_email' => $data['tst_email'],
            'tst_phone' => $data['tst_phone'],
            'tst_address' => $data['tst_address'] ?? '',
            'tst_note' => $data['tst_note'] ?? '',
            'tst_code' => $data['tst_code'] ?? '',
            'tst_status' => $status,
            'tst_type' => $type,
            'voucher_id' => $id
        ]);
        if ($transactionId) {
            $shopping = $data['products'];
            Mail::to($data['tst_email'])->send(new TransactionSuccess($shopping));
            foreach ($shopping as $key => $item) {
                $product = Product::find($item['od_product_id']);
                Order::insert([
                    'od_transaction_id' => $transactionId->id,
                    'od_product_id' => $item['od_product_id'],
                    'od_sale' => $product->pro_sale,
                    'od_qty' => $item['od_qty'],
                    'od_price' => $product->pro_price,
                    'od_size' => 37,
                ]);
                //Tăng số lượt mua của sản phẩm
                Product::where('id', $item['od_product_id'])
                    ->increment("pro_pay");
                $product->pro_amount = $product->pro_amount - $item['od_qty'];
                $product->update();
            }
        }

        // Cart::destroy();
        return 1;
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function callback(Request $request)
    {
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $vnp_TmnCode = Config::get('env.vnpay.code'); //Mã website tại VNPAY
        $vnp_TransactionDate = $request->vnp_PayDate; // Thời gian ghi nhận giao dịch
        $vnp_HashSecret = Config::get('env.vnpay.secret'); //Chuỗi bí mật
        $vnp_RequestId = rand(1,10000); // Mã truy vấn
        $vnp_Command = "querydr"; // Mã api
        $vnp_TxnRef = $request->vnp_TxnRef; // Mã tham chiếu của giao dịch
        $vnp_OrderInfo = "Query transaction"; // Mô tả thông tin
        //$vnp_TransactionNo= ; // Tuỳ chọn, Mã giao dịch thanh toán của CTT VNPAY
        $vnp_CreateDate = date('YmdHis'); // Thời gian phát sinh request
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của máy chủ thực hiện gọi API


        $datarq = array(
            "vnp_RequestId" => $vnp_RequestId,
            "vnp_Version" => "2.1.0",
            "vnp_Command" => $vnp_Command,
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            //$vnp_TransactionNo= ;
            "vnp_TransactionDate" => $vnp_TransactionDate,
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_IpAddr" => $vnp_IpAddr
        );

        $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s';

        $dataHash = sprintf(
            $format,
            $datarq['vnp_RequestId'], //1
            $datarq['vnp_Version'], //2
            $datarq['vnp_Command'], //3
            $datarq['vnp_TmnCode'], //4
            $datarq['vnp_TxnRef'], //5
            $datarq['vnp_TransactionDate'], //6
            $datarq['vnp_CreateDate'], //7
            $datarq['vnp_IpAddr'], //8
            $datarq['vnp_OrderInfo']//9
        );

        $pay = Transaction::where('id', $request->vnp_TxnRef)->first();
        if ($pay) {
            if($request->vnp_ResponseCode == "00") {
                $pay->tst_status = 2;
            } else {
                $pay->tst_status = -1;
            }
            $pay->update();
        }
       return redirect()->to('http://localhost:4000');
    }
}
