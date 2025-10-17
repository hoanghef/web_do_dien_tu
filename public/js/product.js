import { previewImage } from "/js/image_preview.js";

/* ========== HÀM HIỂN THỊ / ẨN LOADING ========== */
const setVisible = (selector, visible) => {
    const el = typeof selector === "string" ? document.querySelector(selector) : selector;
    if (el) el.style.display = visible ? "block" : "none";
};

/* ========== XỬ LÝ NÚT XEM CHI TIẾT SẢN PHẨM ========== */
document.addEventListener("DOMContentLoaded", () => {
    const detailButtons = document.querySelectorAll(".detail");

    if (detailButtons.length === 0) {
        console.warn("⚠️ Không tìm thấy nút .detail nào trong trang.");
        return;
    }

    detailButtons.forEach(button => {
        button.addEventListener("click", async () => {
            const id = button.getAttribute("data-id");
            if (!id) {
                alert("Không xác định được sản phẩm cần xem chi tiết!");
                return;
            }

            setVisible("#loading", true);

            try {
                const response = await fetch(`/product/data/${id}`);
                if (!response.ok) throw new Error(`Lỗi HTTP ${response.status}`);

                const product = await response.json();
                if (!product || !product.product_name) throw new Error("Dữ liệu sản phẩm không hợp lệ!");
                console.log("📦 Dữ liệu sản phẩm trả về:", product);

                // Kiểm tra modal có tồn tại không
                const modalElement = document.getElementById("productDetailModal");
                if (!modalElement) {
                    alert("Không tìm thấy modal #productDetailModal trong HTML!");
                    console.error("❌ Thiếu phần modal hiển thị chi tiết sản phẩm.");
                    return;
                }

                // Cập nhật nội dung modal
                const elName = document.querySelector("#detailProductName");
                const elPrice = document.querySelector("#detailProductPrice");
                const elStock = document.querySelector("#detailProductStock");
                const elDesc = document.querySelector("#detailProductDescription");
                const elSpecs = document.querySelector("#detailProductSpecs");
                const elImage = document.querySelector("#detailProductImage");

                if (!elName || !elPrice || !elStock || !elDesc || !elImage) {
                    console.error("❌ Một hoặc nhiều phần tử trong modal bị thiếu.");
                    alert("Không thể hiển thị chi tiết vì modal chưa được cấu hình đúng!");
                    return;
                }

                // Gán dữ liệu vào modal
                elName.textContent = product.product_name;

                const finalPrice = ((100 - product.discount) / 100) * product.price;
                elPrice.innerHTML = product.discount > 0
                    ? `<strong>${finalPrice.toLocaleString("vi-VN")} VNĐ</strong><br>
                       <small>Giá gốc: <s>${product.price.toLocaleString("vi-VN")} VNĐ</s> (-${product.discount}%)</small>`
                    : `<strong>${product.price.toLocaleString("vi-VN")} VNĐ</strong>`;

                elStock.textContent = `Còn lại: ${product.stock}`;
                elDesc.textContent = product.description || "Không có mô tả.";
/* ================== HIỂN THỊ THÔNG SỐ KỸ THUẬT ================== */
if (elSpecs) {
    elSpecs.innerHTML = ""; // Xóa dữ liệu cũ
    const specsText = product.orientation || "Không có thông số kỹ thuật.";

    // Tách các dòng theo xuống dòng hoặc dấu chấm phẩy
    const lines = specsText.split(/\r?\n|;/).filter(line => line.trim() !== "");

    if (lines.length > 0) {
        lines.forEach(line => {
            // Tách key/value chỉ theo dấu ":" hoặc "-" đầu tiên
            const match = line.match(/^(.+?)([:\-–])(.+)$/);
            if (match) {
                const key = match[1].trim();
                const value = match[3].trim();
                elSpecs.innerHTML += `
                    <tr>
                        <th class="bg-light fw-semibold" style="width:40%;">${key}</th>
                        <td>${value}</td>
                    </tr>`;
            } else {
                // Nếu dòng không có dấu phân tách thì hiển thị nguyên dòng
                elSpecs.innerHTML += `
                    <tr>
                        <td colspan="2" class="text-secondary">${line.trim()}</td>
                    </tr>`;
            }
        });
    } else {
        elSpecs.innerHTML = `<tr><td colspan="2" class="text-center text-muted">Không có dữ liệu</td></tr>`;
    }
}



                // Fix lỗi đường dẫn ảnh 404
                if (product.image) {
                    let imageUrl = product.image;
                    imageUrl = imageUrl.replace("http://localhost", "http://127.0.0.1:8000");
                    elImage.src = imageUrl;
                } else {
                    elImage.src = "/images/no-image.png";
                }

                // Hiển thị modal Bootstrap 5
                const modal = new bootstrap.Modal(modalElement);
                modal.show();

            } catch (error) {
                console.error("❌ Lỗi khi tải dữ liệu sản phẩm:", error);
                alert("Không thể tải chi tiết sản phẩm!");
            } finally {
                setVisible("#loading", false);
            }
        });
    });
});

/* ========== XEM TRƯỚC ẢNH SẢN PHẨM ========== */
$("#image").on("change", function () {
    previewImage({
        image: "image",
        image_preview: "image-preview",
        image_preview_alt: "Product Image",
    });
});

/* ========== NÚT LƯU THAY ĐỔI SẢN PHẨM ========== */
$("#button_edit_product").click(function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Sau khi thực hiện, dữ liệu sản phẩm sẽ được thay đổi.",
        icon: "warning",
        confirmButtonText: "Xác nhận",
        cancelButtonText: "Hủy",
        showCancelButton: true,
        confirmButtonColor: "#08a10b",
        cancelButtonColor: "#d33",
        timer: 10000,
    }).then(result => {
        if (result.isConfirmed) {
            $("#form_edit_product").submit();
        } else {
            Swal.fire("Hành động đã bị hủy", "", "info");
        }
    });
});

/* ========== NÚT XÓA SẢN PHẨM ========== */
$("form[action*='delete_product'] button[type='submit']").click(function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Sau khi thực hiện, sản phẩm sẽ bị xóa.",
        icon: "warning",
        confirmButtonText: "Xác nhận",
        cancelButtonText: "Hủy",
        showCancelButton: true,
        confirmButtonColor: "#08a10b",
        cancelButtonColor: "#d33",
        timer: 10000,
    }).then(result => {
        if (result.isConfirmed) {
            $(this).closest("form").submit();
        } else {
            Swal.fire("Hành động đã bị hủy", "", "info");
        }
    });
});
