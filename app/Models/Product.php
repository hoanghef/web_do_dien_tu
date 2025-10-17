<?php

namespace App\Models;

use App\Models\{Order, Review, Category}; // Thêm Category vào use
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    // Quan hệ với category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
