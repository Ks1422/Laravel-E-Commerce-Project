<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user(){
        return $this->hasOne('App\Models\User','id','user_id'); //user_id sütunu, mevcut modelde User modeline ait kaydın kimliğini tutar.
    }
    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id'); //product_id sütunu, mevcut modelde product modeline ait kaydın kimliğini tutar.
    }
}
