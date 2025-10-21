Giới thiệu
Dự án là một trang web thương mại điện tử chuyên cung cấp các sản phẩm điện tử chất lượng cao như laptop, điện thoại, linh kiện máy tính, phụ kiện, v.v.
Trang web được phát triển bằng Laravel, một framework PHP mạnh mẽ và hiện đại, giúp quá trình xây dựng và quản lý hệ thống trở nên hiệu quả, bảo mật và dễ mở rộng.
 
Thành viên thực hiện
•	Tống Nguyên Thắng
•	Nguyễn Tất Hoàng Hà
 
Chức năng chính
🛍️ Đối với người dùng
•	Đăng ký & đăng nhập: Hỗ trợ xác thực tài khoản người dùng.
•	Xem & tìm kiếm sản phẩm: Dễ dàng duyệt, lọc và tìm kiếm sản phẩm theo danh mục.
•	Giỏ hàng & thanh toán: Thêm sản phẩm vào giỏ hàng, cập nhật số lượng, tiến hành thanh toán.
•	Theo dõi đơn hàng: Xem trạng thái, lịch sử đơn hàng.
•	Đánh giá & bình luận sản phẩm: Người dùng có thể để lại đánh giá sau khi mua hàng.
🧑‍💼 Đối với quản trị viên
•	Quản lý sản phẩm: Thêm mới, chỉnh sửa, xóa sản phẩm.
•	Quản lý danh mục: Tổ chức các loại sản phẩm theo danh mục rõ ràng.
•	Quản lý đơn hàng: Duyệt, cập nhật trạng thái đơn hàng, xem chi tiết khách hàng.
•	Quản lý người dùng: Theo dõi, chỉnh sửa hoặc khóa tài khoản khi cần thiết.
•	Quản lý giao dịch: Theo dõi hoạt động thanh toán và doanh thu.
Phần 2 : Mục tiêu dự án.
1.	Mục tiêu tổng quát.
-	Dự án nhằm xây dựng một hệ thống quản lý web bán đồ ăn nhanh sử dụng Lavarel Framework, tạo ra một nền tảng thương mại điện tử với đầy đủ các chức năng cho người dùng sử dụng.
2.	Mục tiêu cụ thể.
-	Người dùng :
•	Đăng nhập/Đăng ký tài khoản.
•	Xem menu.
•	Xem chi tiết thông tin của sản phẩm.
•	Thêm sản phẩm vào giỏ hàng.
•	Xem các sản phẩm trong giỏ hàng và thanh toán.
•	Xem trạng thái đơn hàng.
•	Xem thông tin người dùng.
•	Sửa thông tin người dùng.
-	Admin/Quản lý :
•	Thêm/sửa/xóa sản phẩm.
•	Sửa/xóa đơn hàng.
•	Sửa/xóa thông tin khách hàng.
Hướng dẫn cài đặt
1️⃣ Clone dự án về máy
git clone https://github.com/hoanghef/web_do_dien_tu.git
Sau khi clone xong, di chuyển vào thư mục dự án:
cd Electronic
 
2️⃣ Cài đặt các gói phụ thuộc PHP và Node.js
Cài đặt các thư viện PHP cần thiết:
composer install
Cài đặt các gói front-end:
npm install
 
3️⃣ Cấu hình môi trường
Tạo file .env từ file mẫu:
cp .env.example .env
Sau đó mở file .env và chỉnh lại các thông tin sau cho phù hợp:
APP_NAME="Laravel"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=electronic
DB_USERNAME=root
DB_PASSWORD=
 
4️⃣ Tạo khóa ứng dụng
php artisan key:generate
 
5️⃣ Chạy migration và seed dữ liệu mẫu
php artisan migrate --seed
Lệnh này sẽ:
•	Tạo các bảng trong cơ sở dữ liệu.
•	Thêm dữ liệu mẫu để bạn có thể thử nghiệm ngay.
 
6️⃣ Biên dịch giao diện (CSS & JS)
Nếu bạn muốn chạy ở chế độ phát triển:
npm run dev
Hoặc build cho môi trường production:
npm run build
 
7️⃣ Khởi động server Laravel
php artisan serve
