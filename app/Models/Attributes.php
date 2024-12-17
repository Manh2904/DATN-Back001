<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model 
{ 
    protected $guarded=[''];
    public function getType(){
        return Arr::get($this->type,$this->atb_type,"[N\A]");
    }
    public function menus(){
        return $this->belongsTo(Menu::class,'menu_id');
    }
}
