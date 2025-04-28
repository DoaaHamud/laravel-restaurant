<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable=[
       'order_number',
        'order_name',
        'status',
        'payment_method',
        'delivery_address',
        'total_price'
    ];
}
