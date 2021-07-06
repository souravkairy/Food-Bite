<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailsModel extends Model
{

    //This model for get products data
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = false;
}
