<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    HomeController,
    OrderController,
    PointController,
    ReviewController,
    ProductController,
    ProfileController,
    RajaOngkirController,
    TransactionController
};

// Trang sản phẩm công khai
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::middleware(['alreadyLogin'])->group(function () {

    Route::get('/', function () {
        return view('landing.index', [
            "title" => "Preview",
        ]);
    });

    // Đăng nhập
    Route::get('/{url}', [AuthController::class, "loginGet"])
        ->where(["url" => "auth|auth/login"])
        ->name("auth");
    Route::post('/auth/login', [AuthController::class, "loginPost"]);

    // Đăng ký
    Route::get('/auth/register', [AuthController::class, "registrationGet"]);
    Route::post('/auth/register', [AuthController::class, "registrationPost"]);
});


// ==========================
// CÁC ROUTE CHÍNH CẦN ĐĂNG NHẬP
// ==========================
Route::middleware(['auth'])->group(function () {

    // Trang chủ
    Route::controller(HomeController::class)->group(function () {
        Route::get("/home", "index");
        Route::get("/home/customers", "customers");
    });

    // Hồ sơ
    Route::controller(ProfileController::class)->group(function () {
        Route::get("/profile/my_profile", "myProfile");
        Route::get("/profile/edit_profile", "editProfileGet");
        Route::post("/profile/edit_profile/{user:id}", "editProfilePost");
        Route::get("/profile/change_password", "changePasswordGet");
        Route::post("/profile/change_password", "changePasswordPost");
    });

    // ==========================
    // SẢN PHẨM
    // ==========================
    Route::controller(ProductController::class)->group(function () {
        // Trang chính & API
        Route::get("/product", "index");
        Route::get("/product/data/{id}", "getProductData"); // ⚡ API JSON

        // Chỉ Admin – thêm / sửa / xóa
        Route::get("/product/add_product", "addProductGet")
            ->can("add_product", App\Models\Product::class);
        Route::post("/product/add_product", "addProductPost")
            ->can("add_product", App\Models\Product::class);

        Route::get("/product/edit_product/{product:id}", "editProductGet")
            ->can("edit_product", App\Models\Product::class);
        Route::post("/product/edit_product/{product:id}", "editProductPost")
            ->can("edit_product", App\Models\Product::class);

        Route::delete("/product/delete_product/{product:id}", "deleteProduct")
            ->can("delete_product", App\Models\Product::class);

        // ⚠️ Đặt route động cuối cùng để không nuốt route khác
        Route::get("/product/{category}", "showByCategory");
    });

    // ==========================
    // ĐƠN HÀNG
    // ==========================
    Route::controller(OrderController::class)->group(function () {
    Route::get("/order/order_data", "orderData");
    Route::get("/order/order_history", "orderHistory");

    // HIỂN THỊ FORM ĐẶT HÀNG (GET)
    Route::get("/order/make_order/{product:id}", "makeOrderGet")
        ->can("create_order", App\Models\Order::class)
        ->name('orders.make');

    // GỬI FORM ĐẶT HÀNG (POST)
    Route::post('/order/make_order', 'store')
        ->can("create_order", App\Models\Order::class)
        ->name('orders.store');

    // chỉ admin
    Route::post('/order/approve/{order}', 'approveOrder')
        ->middleware(['auth', 'can:is_admin'])
        ->name('order.approve');
});


    // ==========================
    // ĐÁNH GIÁ
    // ==========================
    // ==========================
// ĐÁNH GIÁ
// ==========================
Route::controller(ReviewController::class)->group(function () {
    Route::get("/review/product/{product}", "productReview");
    Route::get("/review/data/{review}", "getDataReview");
    Route::post("/review/add_review/", "addReview");
    Route::post("/review/edit_review/{review}", "editReview")->can("edit_review", "review");
    Route::post("/review/delete_review/{review}", "deleteReview")->can("delete_review", "review");
    Route::put('/review/edit_review/{id}', [ReviewController::class, 'update'])->name('review.update');

    // 👉 Thêm 2 dòng dưới đây
    Route::get('/review/get/{id}', 'get')->name('review.get');
    Route::put('/review/update', 'update')->name('review.update');
});


    // ==========================
    // GIAO DỊCH
    // ==========================
    Route::controller(TransactionController::class)->group(function () {
        Route::get("/transaction", "index")->can("is_admin");
        Route::get("/transaction/add_outcome", "addOutcomeGet")->can("is_admin");
        Route::post("/transaction/add_outcome", "addOutcomePost")->can("is_admin");
        Route::get("/transaction/edit_outcome/{transaction}", "editOutcomeGet")->can("is_admin");
        Route::post("/transaction/edit_outcome/{transaction}", "editOutcomePost")->can("is_admin");
        Route::post('/transaction/add-outcome', [TransactionController::class, 'addOutcomePost']);

    });

    // ==========================
    // ĐĂNG XUẤT
    // ==========================
    Route::post('/auth/logout', [AuthController::class, "logoutPost"]);
});

// Chi tiết sản phẩm công khai
Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::post('/order/cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
