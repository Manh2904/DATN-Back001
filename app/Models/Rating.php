<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded=[''];

    public function user(){
        return $this->belongsTo(User::class,'r_user_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'r_product_id');
    }
}
