<?php

namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Product extends Model
{
    protected $table='products';
    protected $guarded=[''];
    protected $country =[
        '0' =>'[N\A]',
        '1' =>'Việt Nam',
        '2' =>'Anh',
        '3' =>'Thụy Sỹ',
        '4' =>'Mỹ'
    ];

    public $size = [
        37 => "S",
        38 => "M",
        39 => "L",
        40 => "XL"
    ];
    public function getCountry(){
        return Arr::get($this->country,2,'[N\A]');
    }
    public function category(){
        return $this->belongsTo(Category::class,'pro_category');
    }
    public function keyword()
    {
        return $this->belongsToMany(Keyword::class,'product_keywords','pk_product_id','pk_keyword_id');
    }

    public function getSize($size)
    {
        return $this->size[$size];
    }

    public function favourite(){
        return $this->belongsToMany(User::class,'user_favourite','uf_product_id','uf_user_id');
    }

    public function getProAvatarAttribute(){
        return pare_url_file($this->attributes['pro_avatar']);
    }

    public function getStarAttribute(){
        return $this->attributes['pro_review_total'] > 0 ? (int)(($this->attributes['pro_review_star'] - 5 ) / $this->attributes['pro_review_total']) : $this->attributes['pro_review_star'];
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function orders(){
        return $this->belongsTo(Order::class, 'od_product_id');
    }

    public function keywords(){
        return $this->belongsTo(ProductKeyword::class, 'pk_product_id');
    }

    public function ratings(){
        return $this->belongsTo(Rating::class, 'r_product_id');
    }

    public function favourites(){
        return $this->belongsTo(UserFavourite::class, 'uf_product_id');
    }

    protected static function booted () {
        static::deleting(function(Product $product) {
             $product->orders()->delete();
             $product->images()->delete();
             $product->keywords()->delete();
             $product->ratings()->delete();
             $product->favourites()->delete();
        });
    }
}
