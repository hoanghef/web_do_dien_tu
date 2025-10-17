@extends('/layouts/main')

@push('css-dependencies')
<link rel="stylesheet" type="text/css" href="/css/product.css" />
@endpush

@push('scripts-dependencies')
<script src="/js/product.js" type="module"></script>
@endpush

@push('modals-dependencies')
@endpush

<style>
    .strikethrough {
        text-decoration: line-through;
    }

    /* Nút thêm sản phẩm nhỏ gọn kiểu CellphoneS */
    /* --- Nút thêm sản phẩm kiểu CellphoneS hiện đại --- */
/* --- Nút thêm sản phẩm kiểu hiện đại, không lắc --- */
.add-product-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #e63946, #d62828);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.2px;
    box-shadow: 0 3px 6px rgba(230, 57, 70, 0.4);
    transition: all 0.25s ease;
    text-decoration: none;
}

.add-product-btn:hover {
    background: linear-gradient(135deg, #d62828, #ba181b);
    box-shadow: 0 5px 12px rgba(230, 57, 70, 0.55);
    transform: translateY(-2px);
    color: #fff;
    filter: brightness(1.1); /* sáng nhẹ */
}

.add-product-btn i {
    font-size: 1rem;
}



    .category-tag {
        background-color: #f5f5f5;
        color: #444;
        padding: 3px 8px;
        border-radius: 8px;
        font-size: 0.8rem;
        display: inline-block;
        margin-top: 5px;
    }

    /* Nút trong từng sản phẩm */
    .product-buttons .btn {
        border-radius: 6px;
        font-weight: 500;
        padding: 5px 10px;
        font-size: 0.85rem;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .product-buttons .btn:hover {
        transform: translateY(-1px);
    }

    .btn-outline-warning {
        color: #d97706;
        border-color: #d97706;
    }

    .btn-outline-warning:hover {
        background-color: #d97706;
        color: #fff;
    }

    .btn-success {
        background-color: #16a34a;
        border-color: #16a34a;
    }

    .btn-success:hover {
        background-color: #15803d;
    }

    .section-title {
        color: #e63946;
    }
</style>

@section('content')
<section id="product" class="pb-5">
    <div class="container">

        @if(session()->has('message'))
        {!! session("message") !!}
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="section-title h1 m-0 fw-bold">Khám phá đẳng cấp công nghệ</h5>

            @can('add_product', App\Models\Product::class)
            <a href="/product/add_product" class="add-product-btn">
                <i class="fas fa-plus"></i> Thêm sản phẩm
            </a>
            @endcan
        </div>

        {{-- Thanh tìm kiếm --}}
        <form method="GET" action="{{ url('/product') }}" class="mb-4">
            <div class="input-group">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Tìm kiếm sản phẩm..." 
                    value="{{ request('search') ?? '' }}"
                >
                <button class="btn btn-danger" type="submit">Tìm</button>
            </div>
        </form>

        <div class="row justify-content-center">
            @foreach($product as $row)
            <div class="col-12 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="product-image">
                            <img class="img" src="{{ '/' . 'storage/' . $row->image }}" alt="{{ $row->product_name }}" style="width: 150px; border-radius: 8px;">
                        </div>
                        <div class="product-info ms-3 flex-grow-1">
                            <h4 class="card-title mb-2 text-primary">{{ $row->product_name }}</h4>

                            {{-- Loại sản phẩm --}}
                            @if($row->category)
                            <span class="category-tag">
                                <i class="fas fa-tags"></i> {{ $row->category->category_name }}
                            </span>
                            @endif

                            <p class="mt-2 mb-1">
                                <strong>Giá gốc: </strong>
                                @if($row->discount)
                                    <span class="strikethrough">{{ number_format($row->price, 0, ',', '.') }} VNĐ</span>
                                    <span class="text-danger ms-2">-{{ $row->discount }}%</span>
                                @else
                                    {{ number_format($row->price, 0, ',', '.') }} VNĐ
                                @endif
                            </p>

                            @if($row->discount)
                            <p class="mb-1"><strong>Giá sau giảm: </strong>{{ number_format($row->price * (1 - $row->discount / 100), 0, ',', '.') }} VNĐ</p>
                            @endif

                            <p class="mb-1"><strong>Tồn kho:</strong> {{ $row->stock }}</p>
                        </div>

                        <div class="product-buttons ms-auto d-flex flex-column gap-2">
                            <button data-id="{{ $row->id }}" class="btn btn-outline-primary btn-sm detail">
                                <i class="fas fa-info-circle"></i> Chi tiết
                            </button>
                            <a href="/review/product/{{ $row->id }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-star"></i> Đánh giá
                            </a>

                            @can('edit_product', App\Models\Product::class)
                            <a href="/product/edit_product/{{ $row->id }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit"></i> Chỉnh sửa
                            </a>
                            @endcan

                            @can('create_order', App\Models\Order::class)
                            <a href="/order/make_order/{{ $row->id }}" class="btn btn-success btn-sm">
                                <i class="fas fa-shopping-cart"></i> Mua
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @if($product->isEmpty())
            <div class="col-12">
                <p class="text-center text-muted">Không tìm thấy sản phẩm phù hợp.</p>
            </div>
            @endif
        </div>
    </div>
</section>
@include('/partials/product/product_detail_modal')
@endsection
