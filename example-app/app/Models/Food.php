<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    
    protected $fillable = [
        'shop_id',
        'name',
        'price',
        'image_url',
        'description',
        'rate',
        'category_id',
    ];
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }   
    // Define the table associated with the model

}
