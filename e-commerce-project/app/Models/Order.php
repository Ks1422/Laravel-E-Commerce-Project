<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function User()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function Product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
