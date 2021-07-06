<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingModel extends Model
{
    //This model for get products data
    protected $table = 'shipping';
    protected $primaryKey = 'id';
    public $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = false;
}
