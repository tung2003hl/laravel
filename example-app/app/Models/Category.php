<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // Tên của bảng trong cơ sở dữ liệu

    protected $fillable = ['name', 'description']; // Các cột có thể được gán dữ liệu

    // Định nghĩa một quan hệ nếu cần (ví dụ: nhiều sản phẩm thuộc về một danh mục)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
