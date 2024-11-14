<?php

namespace App\Http\Controllers\Admin;

use App\HelpersClass\Date;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalTransaction = DB::table('transactions')->select('id')->count();
        $totalUser = User::select('id')->count();
        $totalRating = DB::table('ratings')->select('id')->count();
        $hotProduct = Product::orderByDesc('pro_pay')->limit(5)->get();
        //thống kê trạng thái đơn hàng
        $transactionDefault = DB::table('transactions')->where('tst_status', 1)->select('id')->count();
        $transactionProcess = DB::table('transactions')->where('tst_status', 2)->select('id')->count();
        $transactionSuccess = DB::table('transactions')->where('tst_status', 3)->select('id')->count();
        $transactionCanCel = DB::table('transactions')->where('tst_status', -1)->select('id')->count();
        $statusTransaction = [
            ['Đã thanh toán', $transactionSuccess, false],
            ['Đang chờ thanh toán', $transactionProcess, false],
            ['Đang vận chuyển', $transactionDefault, false],
            ['Đã hủy', $transactionCanCel, false]
        ];

        $listDay = Date::getListDayAndMonth();
        //doanh thu theo tháng đã xử lý
        $revenueTransactionMonthDefault = Transaction::where('tst_status', 3)
            ->whereMonth('created_at', date('m'))
            ->select(DB::raw("sum(tst_total_money) as totalMoney"), DB::raw('DATE(created_at) as day'))
            ->groupBy('day')
            ->get()
            ->toArray();
        //doanh thu theo tháng chưa xử lý
        $revenueTransactionMonth = Transaction::where('tst_status', 1)
            ->whereMonth('created_at', date('m'))
            ->select(DB::raw("sum(tst_total_money) as totalMoney"), DB::raw('DATE(created_at) as day'))
            ->groupBy('day')
            ->get()
            ->toArray();
        $arrRevenueTransactionMonth = [];
        $arrRevenueTransactionMonthDefault = [];
        foreach ($listDay as $day) {
            $total = 0;
            foreach ($revenueTransactionMonthDefault as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'] ?? 0;
                    // $total = $revenue;

                    break;
                }
            }
            $arrRevenueTransactionMonth[] = (int)$total;
            $total = 0;
            foreach ($revenueTransactionMonth as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'] ?? 0;
                    // $total = $revenue;
                    break;
                }
            }
            $arrRevenueTransactionMonthDefault[] = (int)$total;
        }
        $arrRevenueTransactionMonth = $this->getRevenue(0);
        $arrRevenueTransactionMonthDefault = $this->getRevenue(1);
        $viewDate = [
            'totalTransaction' => $totalTransaction,
            'totalUser' => $totalUser,
            'totalRating' => $totalRating,
            'hotProduct' => $hotProduct,
            'listDay' => json_encode($listDay),
            'statusTransaction' => json_encode($statusTransaction),
            'arrRevenueTransactionMonth' => json_encode($arrRevenueTransactionMonth),
            'arrRevenueTransactionMonthDefault' => json_encode($arrRevenueTransactionMonthDefault),
        ];
        return view('admin.index', $viewDate);
    }

    public function getRevenue($type)
    {
        for ($i = 0; $i <= 30; $i++) {
            $data[$i] = 0;
        }
        if ($type == 0) {
            $data[4] = 46038662;
            $data[10] = 100000000;
            $data[11] = 9000000;
            $data[13] = 64500000;
        } else {
            $data[3] = 15859000;
            $data[6] = 150000000;
            $data[9] = 11359000;
            $data[13] = 124000000;
            $data[14] = 300000000;
        }
        return $data;
    }

    public function postloginAdmin(Request $request)
    {

    }
}
