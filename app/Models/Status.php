<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses'; // ✅ chỉ rõ tên bảng
    protected $primaryKey = 'id';
    public $timestamps = false; // ✅ nếu bảng không có created_at, updated_at

    protected $fillable = ['order_status', 'style']; // ✅ các cột bạn có

    public function orders()
    {
        return $this->hasMany(Order::class, 'status_id'); // ✅ khóa ngoại
    }
}
