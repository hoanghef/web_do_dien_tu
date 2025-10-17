<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form id="form_edit_review" method="POST" action="{{ route('review.update') }}">
      @csrf
      @method('PUT')

      <input type="hidden" name="id" id="edit_review_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editReviewLabel">Chỉnh sửa đánh giá</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="edit_rating">Chọn sao:</label>
            <div id="edit_rating" class="rating-wrapperr">
              @for ($i = 5; $i >= 1; $i--)
              <input type="radio" id="edit-star-{{ $i }}" name="rating" value="{{ $i }}">
              <label for="edit-star-{{ $i }}" class="star-rating">
                <i class="fas fa-star d-inline-block"></i>
              </label>
              @endfor
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="edit_review_text">Nội dung đánh giá</label>
            <textarea id="edit_review_text" name="review" class="form-control" rows="3"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
      </div>
    </form>
  </div>
</div>
