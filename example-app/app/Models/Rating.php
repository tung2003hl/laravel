<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table ='rating';

    protected $primarykey = 'id';

    protected $fillable = ['user_id','shop_id','rating','comment'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');

    }
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
}
