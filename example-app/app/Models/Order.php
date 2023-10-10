<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'shop_id',
        'user_id',
        'receiver_name',
        'food_id',
        'order_date',
        'delivery_address',
        'email',
        'total_price',
        'note'
    ];
    protected $table = 'orders';
}
