<style>
/* ===== Order List Card ===== */
.order-list {
    background-color: #fdf6e3; /* pastel cream */
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.order-list:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

/* ===== Product Image ===== */
.product-image {
    border-radius: 12px;
    width: 100%;
    max-width: 160px;
    height: auto;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
}

/* ===== Links & Badges ===== */
.order-detail-link {
    color: #2a7ae2;
    font-weight: bold;
    cursor: pointer;
}

.order-detail-link:hover {
    color: #1a5bb8;
}

.link-info {
    color: #2a7ae2;
    text-decoration: none;
    font-size: 0.9rem;
}

/* ===== History Title ===== */
.order-history-title {
    font-size: 2rem;
    font-weight: bold;
    color: #ffffff;
    padding: 15px 20px;
    border-radius: 12px;
    text-align: center;
    background: linear-gradient(90deg, #4facfe, #00f2fe); /* soft blue gradient */
    background-size: 200% 200%;
    animation: shine 4s linear infinite;
    margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

@keyframes shine {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* ===== Status Colors ===== */
.text-warning { color: #d9822b; } /* softer orange */
.text-success { color: #2e7d32; } /* green */
.text-danger { color: #c62828; } /* red */

/* ===== Buttons ===== */
.btn-success { background-color: #2e7d32; border-color: #2e7d32; }
.btn-success:hover { background-color: #27632a; border-color: #27632a; }

.btn-danger { background-color: #c62828; border-color: #c62828; }
.btn-danger:hover { background-color: #a31f1f; border-color: #a31f1f; }

.badge.bg-primary { background-color: #1976d2; }
.badge.bg-secondary { background-color: #9e9e9e; }
</style>


<div class="container">
    <h2 class="order-history-title">
        <i class="fas fa-history"></i> Lịch Sử Đơn Hàng
    </h2>

    @foreach ($orders as $row)
    <div class="row mb-3 order-list align-items-center">
        <div class="col-md-2 text-center">
            <img src="{{ $row->product && $row->product->image ? Storage::url($row->product->image) : asset('storage/default-image.png') }}" class="product-image" />
        </div>

        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <strong>{{ $row->product ? $row->product->product_name : 'Sản phẩm không tồn tại' }}</strong>
                    <br>
                    <small>Số lượng: {{ $row->quantity }}, Tổng giá: {{ $row->total_price }} VNĐ</small>
                    <br>
                    <small>Ghi chú: {{ $row->refusal_reason ?? $row->note->order_notes ?? 'Không có ghi chú' }}</small>
                    <br>
                    @if(isset($row->product_id) && $row->is_done && $row->status_id == 2)
                        <a href="/review/product/{{ $row->product_id }}" class="link-info">Đánh giá ngay</a>
                    @endif
                </div>

                <div class="text-end">
                    <span class="badge bg-{{ $row->payment->payment_method ? 'primary' : 'secondary' }}">
                        {{ $row->payment->payment_method ?? 'Chưa chọn phương thức' }}
                    </span>
                </div>
            </div>

            <div class="mt-2">
                @if($row->status_id == 1)
                    <span class="text-warning">Chờ duyệt</span>
                @elseif($row->status_id == 2)
                    Đã duyệt bởi <span class="text-success">{{ '@' . ($row->approver->username ?? 'admin') }}</span>
                    <br>
                    <small class="text-muted">{{ $row->approved_at ? $row->approved_at->format('d/m/Y H:i:s') : '' }}</small>
                @elseif($row->status_id == 5)
                    <span class="text-danger">Đã huỷ</span>
                @else
                    Trạng thái không xác định
                @endif
            </div>

            <div class="mt-2">
                Đơn hàng được tạo bởi
                @php
                    $dest = auth()->user()->role_id == 1
                        ? ($row->user ? "/home/customers?username=" . $row->user->username : "/home/customers")
                        : "/profile/my_profile";
                @endphp
                <a href="{{ $dest }}" style="text-decoration:none;">{{ $row->user ? '@' . $row->user->username : 'Unknown User' }}</a>
            </div>

            <div class="mt-2">
                @if(auth()->user()->role_id == 1 && $row->status_id == 1)
                    <form action="{{ route('order.approve', $row->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Bạn có chắc muốn duyệt đơn hàng này?')">
                            <i class="fas fa-check"></i> Duyệt đơn
                        </button>
                    </form>
                @elseif(auth()->user()->role_id != 1 && $row->status_id == 1)
                    <form action="{{ route('order.cancel', $row->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn huỷ đơn hàng này?')">
                            <i class="fas fa-times"></i> Huỷ đơn
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.order-detail-link').forEach(el => {
        el.addEventListener('click', function() {
            const orderId = this.dataset.id;
            window.location.href = '/order/' + orderId;
        });
    });
});
</script>
