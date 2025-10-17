@extends('/layouts/main')

@push('css-dependencies')
<style>
  body {
    background-color: #f8f8f8;
  }

  .card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    background: #fff;
  }

  .card-header {
    background: linear-gradient(90deg, #f42424, #ff5b5b);
    color: #fff;
    font-weight: 700;
    font-size: 1.2rem;
    padding: 18px 25px;
    display: flex;
    align-items: center;
  }

  .card-header i {
    margin-right: 10px;
  }

  .form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
  }

  .form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    transition: all 0.25s ease;
  }

  .form-control:focus {
    border-color: #f42424;
    box-shadow: 0 0 0 0.2rem rgba(244, 36, 36, 0.2);
  }

  .btn-primary {
    background-color: #f42424;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 600;
    box-shadow: 0 3px 8px rgba(244, 36, 36, 0.3);
    transition: all 0.25s ease;
  }

  .btn-primary:hover {
    background-color: #ff5b5b;
    transform: translateY(-1px);
  }

  .btn-secondary {
    background-color: #ccc;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all 0.25s ease;
  }

  .btn-secondary:hover {
    background-color: #b0b0b0;
  }

  .btn-danger {
    background-color: #444;
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
    color: white;
    transition: all 0.25s ease;
  }

  .btn-danger:hover {
    background-color: #666;
    transform: translateY(-1px);
  }

  .image-preview {
    border-radius: 12px;
    border: 2px solid #eee;
    max-width: 100%;
    height: auto;
    background-color: #fafafa;
  }

  .container-fluid {
    background-color: transparent;
    padding: 25px;
  }

  .text-danger {
    font-size: 0.9rem;
  }

  .file-input-label {
    font-weight: 600;
    margin-bottom: 8px;
    color: #444;
  }
</style>
@endpush

@section('content')
<div class="container-fluid">

  @include('/partials/breadcumb')

  @if(session()->has('message'))
  {!! session("message") !!}
  @endif

  <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-pen-nib"></i> Chỉnh sửa sản phẩm
    </div>

    <div class="card-body">
      <form action="/product/edit_product/{{ $product->id }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row mb-4">
          <!-- Cột trái: ảnh sản phẩm -->
          <div class="col-md-4 text-center">
            <label class="file-input-label">Ảnh sản phẩm</label>
            <img id="image-preview" src="{{ '/storage/' . $product->image }}" class="image-preview mb-3" alt="{{ $product->product_name }}">
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
              <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>

          <!-- Cột phải: thông tin -->
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text" id="product_name" name="product_name"
                  class="form-control @error('product_name') is-invalid @enderror"
                  value="{{ old('product_name', $product->product_name) }}">
                @error('product_name')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="category_id">Loại sản phẩm</label>
                <select name="category_id" id="category_id"
                  class="form-control @error('category_id') is-invalid @enderror">
                  <option value="">-- Chọn loại sản phẩm --</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                      {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                      {{ $category->category_name }}
                    </option>
                  @endforeach
                </select>
                @error('category_id')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4 mb-3">
                <label for="stock">Tồn kho</label>
                <input type="text" id="stock" name="stock"
                  class="form-control @error('stock') is-invalid @enderror"
                  value="{{ old('stock', $product->stock) }}">
                @error('stock')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4 mb-3">
                <label for="price">Giá</label>
                <input type="text" id="price" name="price"
                  class="form-control @error('price') is-invalid @enderror"
                  value="{{ old('price', $product->price) }}">
                @error('price')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4 mb-3">
                <label for="discount">Giảm giá (%)</label>
                <input type="text" id="discount" name="discount"
                  class="form-control @error('discount') is-invalid @enderror"
                  value="{{ old('discount', $product->discount) }}">
                @error('discount')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="orientation">Thông số kỹ thuật</label>
                <input type="text" id="orientation" name="orientation"
                  class="form-control @error('orientation') is-invalid @enderror"
                  value="{{ old('orientation', $product->orientation) }}">
                @error('orientation')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="description">Mô tả</label>
                <input type="text" id="description" name="description"
                  class="form-control @error('description') is-invalid @enderror"
                  value="{{ old('description', $product->description) }}">
                @error('description')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
          <a href="/product" class="btn btn-secondary me-3">Quay lại</a>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
      </form>

      <form action="{{ url('/product/delete_product/' . $product->id) }}" method="POST" class="mt-4 text-end">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Xóa sản phẩm</button>
      </form>
    </div>
  </div>
</div>

@push('scripts-dependencies')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');
    input.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
      }
    });
  });
</script>
@endpush
@endsection
