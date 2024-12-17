<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded=[''];
    public function attributes(){
        return $this->hasMany(Attributes::class, 'menu_id');
    }
}
