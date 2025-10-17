<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'address',
        'shipping_address',
        'total_price',
        'payment_id',
        'bank_id',
        'note_id',
        'status_id',
        'is_done',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Liên kết tới người dùng
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Liên kết tới sản phẩm
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Liên kết tới trạng thái đơn hàng
   public function status()
{
    return $this->belongsTo(Status::class, 'statuses_id', 'id');
}

    // Liên kết tới phương thức thanh toán
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    // Liên kết tới ngân hàng (nếu có)
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    // Liên kết tới ghi chú (nếu bạn đặt model là Note.php)
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }

    // Người duyệt đơn
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Hàm phụ tránh lỗi null khi hiển thị
    public function getPaymentMethodNameAttribute()
    {
        return $this->payment->payment_method ?? 'Chưa chọn phương thức';
    }

    public function getNoteContentAttribute()
    {
        return $this->note->order_notes ?? 'Không có ghi chú';
    }

    public function getStatusNameAttribute()
{
    return $this->status->order_status ?? 'Không rõ trạng thái';
}

}
