<!-- ========== MODAL CHI TIẾT SẢN PHẨM ========== -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-3">
      
      <!-- Header -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="productDetailLabel">Chi tiết sản phẩm</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <div class="row align-items-center">
          
          <!-- Ảnh -->
          <div class="col-md-5 text-center mb-3 mb-md-0">
            <img id="detailProductImage" src="" alt="Ảnh sản phẩm"
              class="img-fluid rounded shadow-sm border" 
              style="max-height: 280px; object-fit: cover;" />
          </div>

          <!-- Thông tin -->
          <div class="col-md-7">
            <h4 id="detailProductName" class="fw-bold mb-2 text-dark"></h4>

            <div class="d-flex align-items-center mb-2">
              <p id="detailProductPrice" class="text-danger fs-5 fw-semibold mb-0 me-2"></p>
              <p id="detailProductOldPrice" class="text-muted text-decoration-line-through mb-0 me-2"></p>
              <span id="detailProductDiscount" class="badge bg-success" style="display:none;"></span>
            </div>
            <p class="mb-1"><strong>Tồn kho:</strong> <span id="detailProductStock">-</span></p>

            <hr>

            <p class="mb-1"><strong>Mô tả:</strong> <span id="detailProductDescription" class="text-secondary"></span></p>
            <p class="mb-0"><strong>Thông số kỹ thuật:</strong> <span id="detailProductSpecs" class="text-secondary"></span></p>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<!-- Loading -->
<div id="loading" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.85); z-index:2000; text-align:center; padding-top:200px;">
  <div class="spinner-border text-danger" role="status">
    <span class="visually-hidden">Đang tải...</span>
  </div>
  <p class="mt-3 fw-bold text-danger">Đang tải dữ liệu sản phẩm...</p>
</div>



<!-- ========== LOADING (ĐẸP HƠN) ========== -->
<div id="loading" style="display:none; position:fixed; inset:0; background:rgba(255,255,255,0.9); z-index:2000; text-align:center;">
  <div class="position-absolute top-50 start-50 translate-middle">
    <div class="spinner-border text-danger" role="status" style="width: 3rem; height: 3rem;"></div>
    <p class="mt-3 fw-semibold text-danger fs-6">Đang tải dữ liệu sản phẩm...</p>
  </div>
</div>
