<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [

        'status',
        'total_price',
        'user_id'

    ];
}
