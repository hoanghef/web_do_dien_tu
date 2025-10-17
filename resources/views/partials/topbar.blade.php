<style>
/* ===== TOPBAR ===== */
.topbar-main {
    background: linear-gradient(90deg, #c10000, #ff4d4d);
    color: #fff;
    padding: 10px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-family: "Poppins", sans-serif;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

/* LEFT - LOGO */
.topbar-left {
    display: flex;
    align-items: center;
    gap: 8px;
}

.topbar-brand {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1.4rem;
    font-weight: 700;
    text-decoration: none;
    color: #fff;
}

.topbar-brand i {
    background: #fff;
    color: #c10000;
    border-radius: 6px;
    padding: 4px 6px;
}

/* CENTER NAVIGATION */
.topbar-nav {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 25px;
    flex: 1;
}

.topbar-nav a {
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 6px 10px;
    border-radius: 6px;
}

.topbar-nav a:hover {
    background: rgba(255,255,255,0.15);
    color: #fff;
    transform: translateY(-2px);
}

/* DROPDOWN */
.dropdown {
    position: relative;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 120%;
    left: 0;
    background: #fff;
    border-radius: 8px;
    min-width: 180px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    overflow: hidden;
    animation: fadeIn 0.25s ease;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu a {
    color: #333;
    padding: 10px 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    transition: 0.2s;
}

.dropdown-menu a:hover {
    background: #ffe5e5;
    color: #c10000;
}

/* RIGHT - USER INFO */
.topbar-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.topbar-right img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 2px solid #fff;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.topbar-right img:hover {
    transform: scale(1.1);
}

.username {
    font-weight: 600;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
}

/* RESPONSIVE */
.menu-toggle {
    display: none;
    font-size: 1.4rem;
    background: none;
    border: none;
    color: #fff;
}

@media (max-width: 992px) {
    .topbar-main {
        flex-wrap: wrap;
        justify-content: center;
    }

    .topbar-nav {
        display: none;
        flex-direction: column;
        width: 100%;
        margin-top: 10px;
        gap: 0;
    }

    .topbar-nav.show {
        display: flex;
    }

    .menu-toggle {
        display: block;
        position: absolute;
        right: 20px;
    }

    .topbar-right {
        margin-top: 10px;
    }
}
/* ===== DROPDOWN CHUNG ===== */
.dropdown {
    position: relative;
}

.dropdown > a {
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 500;
    color: #fff;
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dropdown > a:hover {
    background: rgba(255,255,255,0.15);
    transform: translateY(-2px);
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    border-radius: 8px;
    min-width: 180px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s;
    z-index: 100;
}

/* Khi mở bằng click */
.dropdown.show .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 15px;
    color: #333;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
}

.dropdown-menu a:hover {
    background: #ffe5e5;
    color: #c10000;
}

</style>

<nav class="topbar-main">
    <!-- Logo -->
    <div class="topbar-left">
        <a href="/product" class="topbar-brand">
            <i class="fas fa-bolt"></i> ElectroShop
        </a>
    </div>

    <!-- Menu giữa -->
    <div class="topbar-nav">
        <!-- ✅ Nút mới thêm -->
        <a href="/product"><i class="fas fa-home"></i> Trang chủ</a>

        <div class="dropdown">
            <a href="#"><i class="fas fa-boxes"></i> Loại sản phẩm <i class="fas fa-angle-down"></i></a>
            <div class="dropdown-menu">
                <a href="/product/gpu"><i class="fas fa-microchip"></i> Card màn hình</a>
                <a href="/product/ram"><i class="fas fa-memory"></i> RAM</a>
                <a href="/product/psu"><i class="fas fa-bolt"></i> Nguồn</a>
                <a href="/product/motherboard"><i class="fas fa-desktop"></i> Mainboard</a>
                <a href="/product/ssd"><i class="fas fa-hdd"></i> SSD</a>
                <a href="/product/cooler"><i class="fas fa-fan"></i> Tản nhiệt</a>
 <a href="/product/cpu"><i class="fas fa-microchip"></i> CPU</a>
                <a href="/product/case"><i class="fas fa-cube"></i> Case</a>
                <a href="/product/peripherals"><i class="fas fa-keyboard"></i> Phụ kiện</a>
            </div>
        </div>

        @can("is_admin")
        <a href="{{ url('/home') }}">Bảng điều khiển</a>
        <a href="/home/customers"><i class="fas fa-users"></i> Khách hàng</a>
        @endcan

        <div class="dropdown">
            <a href="#"><i class="fas fa-clipboard-list"></i> Đơn hàng <i class="fas fa-angle-down"></i></a>
            <div class="dropdown-menu">
                <a href="/order/order_data"><i class="fas fa-database"></i> Dữ liệu đơn hàng</a>
                <a href="/order/order_history"><i class="fas fa-history"></i> Lịch sử đơn hàng</a>
            </div>
        </div>
    </div>

    <!-- Tài khoản -->
    <div class="topbar-right dropdown">
        <span class="username">{{ auth()->user()->username }}</span>
        <a href="#" id="userDropdown" data-bs-toggle="dropdown">
            <img src="{{ '/'.'storage/' . auth()->user()->image }}" alt="Avatar">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="right:0; left:auto;">
            <li><a class="dropdown-item" href="/profile/my_profile"><i class="fas fa-user-circle"></i> Hồ sơ của tôi</a></li>
            <li><a class="dropdown-item" href="/profile/change_password"><i class="fas fa-key"></i> Đổi mật khẩu</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="/auth/logout" method="post" style="margin:0;">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- ✅ Script thêm để liên kết nút Electronic -->
<script>
document.querySelector('.topbar-brand').addEventListener('click', e => {
    e.preventDefault();
    if (window.location.pathname === '/') {
        // Nếu đã ở trang chủ thì cuộn đến đầu trang hoặc hero
        const hero = document.querySelector('#hero');
        if (hero) hero.scrollIntoView({ behavior: 'smooth' });
        else window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        // Nếu không thì quay về trang chủ
        window.location.href = '/';
    }
});
</script>
<script>
// Lấy tất cả dropdown
document.querySelectorAll('.dropdown').forEach(drop => {
    const toggle = drop.querySelector('a'); 
    toggle.addEventListener('click', e => {
        e.preventDefault(); // tránh link reload
        // Ẩn các dropdown khác
        document.querySelectorAll('.dropdown').forEach(d => {
            if (d !== drop) d.classList.remove('show');
        });
        // Toggle dropdown hiện tại
        drop.classList.toggle('show');
    });
});

// Ẩn dropdown nếu click ra ngoài
document.addEventListener('click', e => {
    if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('show'));
    }
});
</script>
