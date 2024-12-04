<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
class Transaction extends Model
{
    protected $guarded=[''];
    protected $status =[
        '2' =>[
            'class' =>'btn btn-info',
            'name'  =>'Đang vận chuyển'
        ],
        '3' =>[
            'class' =>'btn btn-success',
            'name'  =>'Đã giao hàng'
        ],
        '-1' =>[
            'class' =>'btn btn-danger',
            'name'  =>'Đã hủy'
        ],
        '4' =>[
            'class' =>'btn btn-primary',
            'name'  =>'Hoàn thành'
        ],
        '5' =>[
            'class' =>'btn btn-primary',
            'name'  =>'Chờ xác nhận'
        ],
        '6' =>[
            'class' =>'btn btn-primary',
            'name'  =>'Đã xác nhận'
        ],
    ];
     public function getStatus()
    {
        return Arr::get($this->status, $this->tst_status,"[N\A]");
    }

    public function voucher(){
        return $this->belongsTo(Voucher::class,'voucher_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'od_transaction_id');
    }
}
