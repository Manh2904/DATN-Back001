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
        $totalProduct = Product::where("pro_active", 1)->count();
        $hotProduct = Product::orderByDesc('pro_pay')->limit(5)->get();
        //thống kê trạng thái đơn hàng
        $transactionProcess = DB::table('transactions')->where('tst_status', 2)->select('id')->count();
        $transactionShipped = DB::table('transactions')->where('tst_status', 3)->select('id')->count();
        $transactionFinish = DB::table('transactions')->where('tst_status', 4)->select('id')->count();
        $transactionConfirm = DB::table('transactions')->where('tst_status', 5)->select('id')->count();
        $transactionConfirmed = DB::table('transactions')->where('tst_status', 6)->select('id')->count();
        $transactionCanCel = DB::table('transactions')->where('tst_status', -1)->select('id')->count();
        $statusTransaction = [
            ['Đang vận chuyển', $transactionProcess, false],
            ['Đã giao hàng', $transactionShipped, false],
            ['Đã hủy', $transactionCanCel, false],
            ['Hoàn thành', $transactionFinish, false],
            ['Chờ xác nhận', $transactionConfirm, false],
            ['Đã xác nhận', $transactionConfirmed, false]
        ];

        $listDay = Date::getListDayAndMonth();
        //doanh thu theo tháng đã xử lý
        $revenueTransactionMonthDefault = Transaction::where('tst_status', 4)
            ->whereMonth('created_at', date('m'))
            ->select(DB::raw("sum(cast(tst_total_money as int)) as totalMoney"), DB::raw('DATE(created_at) as day'))
            ->groupBy('day')
            ->get()
            ->toArray();
        //doanh thu theo tháng chưa xử lý
        $revenueTransactionMonth = Transaction::where('tst_status', 5)
            ->whereMonth('created_at', date('m'))
            ->select(DB::raw("sum(cast(tst_total_money as int)) as totalMoney"), DB::raw('DATE(created_at) as day'))
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
        $viewDate = [
            'totalTransaction' => $totalTransaction,
            'totalUser' => $totalUser,
            'totalRating' => $totalRating,
            'totalProduct' => $totalProduct,
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
        //doanh thu theo tháng đã xử lý
        $revenueTransactionMonthDefault = Transaction::where('tst_status', 3)
          ->whereMonth('created_at', date('m'))
          ->select(DB::raw("sum(cast(tst_total_money as int)) as totalMoney"), DB::raw('DATE(created_at) as day'))
          ->groupBy('day')
          ->get()
          ->toArray();
        //doanh thu theo tháng chưa xử lý
        $revenueTransactionMonth = Transaction::where('tst_status', 1)
            ->whereMonth('created_at', date('m'))
            ->select(DB::raw("sum(cast(tst_total_money as int)) as totalMoney"), DB::raw('DATE(created_at) as day'))
            ->groupBy('day')
            ->get()
            ->toArray();
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
}
