<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    //This model for get products data
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = false;

    //this method for get order details
    public function details(){
        return $this->hasMany('App\Models\OrderDetailsModel', 'order_id', 'id');
    }


    //this method for get shipping details
    public function shipping(){
        return $this->hasOne('App\Models\ShippingModel', 'order_id', 'id');
    }

    //this method for get user details
    public function user(){
        return $this->hasOne('App\Models\UsersModel', 'id', 'user_id');
    }

}
