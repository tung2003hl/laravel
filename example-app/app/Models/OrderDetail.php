<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'food_id',
        'quantity',
        'price',        
    ];
    protected $table = 'order_detail';
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }
}
