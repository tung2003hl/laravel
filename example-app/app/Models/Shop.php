<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'phone_num',
        'main_food',
        'logo',
    ];

    // Define the table associated with the model
    protected $table = 'shops';
}
