@extends('/layouts/main')

@push('css-dependencies')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
:root{
    --bg: #f6f7f8;
    --card: #ffffff;
    --muted: #6b7280;
    --cell-red: #EE0033;
    --cell-red-2: #ff4d6d;
    --input-bg: #fbfcfd;
    --shadow-1: 0 6px 20px rgba(14, 21, 47, 0.06);
    --shadow-2: 0 10px 30px rgba(14,21,47,0.08);
    --glass: rgba(255,255,255,0.6);
}

/* Base */
body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(180deg, var(--bg), #ffffff 60%);
    min-height: 100vh;
    margin: 0;
    color: #111827;
}

/* Center container */
.main-body {
    display: flex;
    justify-content: center;
    padding: 60px 20px;
}

/* Card */
.profile-card {
    background: var(--card);
    border-radius: 14px;
    box-shadow: var(--shadow-1);
    overflow: hidden;
    display: flex;
    width: 100%;
    max-width: 720px; /* CHANGED: 720px premium */
    transition: box-shadow 0.25s ease, transform 0.25s ease;
    border: 1px solid rgba(16,24,40,0.03);
}
.profile-card::before,
.profile-card::after,
.profile-image::before,
.profile-image::after {
    content: none !important;
    display: none !important;
}

/* Accent stripe left (subtle) */
.profile-card::before{
    content: "";
    width: 6px;
    background: linear-gradient(180deg, var(--cell-red), var(--cell-red-2));
    position: absolute;
    height: calc(100% - 120px);
    left: calc(50% - 360px); /* align with left edge of card when centered */
    top: 60px;
    border-radius: 8px;
    opacity: 0.08;
    pointer-events: none;
}

/* Left column - avatar */
.profile-image {
    padding: 34px 22px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 34%;
    min-width: 160px;
    background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(0,0,0,0.01));
    position: relative;
}

/* Avatar wrap for glow */
.avatar-wrap{
    width: 140px;
    height: 140px;
    border-radius: 50%;
    padding: 6px;
    background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.28s cubic-bezier(.2,.9,.2,1), box-shadow 0.28s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

/* Avatar image */
.profile-image img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 5px solid #fff;
    object-fit: cover;
    display: block;
}

/* Info under avatar */
.profile-image h3{
    margin: 14px 0 6px;
    font-size: 18px;
    font-weight: 600;
    color: #0f172a;
    text-align: center;
}
.profile-image p{
    margin: 0;
    font-size: 13px;
    color: var(--muted);
    text-align: center;
}

/* Right column - form content */
.profile-form {
    flex: 1;
    padding: 28px 28px 34px 28px;
    width: 66%;
}

/* Header row */
.profile-form .header{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom: 18px;
}
.icon-lock{
    width:36px;
    height:36px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background: linear-gradient(90deg, rgba(238,0,51,0.12), rgba(255,77,109,0.08));
    color: var(--cell-red);
    flex-shrink:0;
}
.profile-form h2{
    margin:0;
    font-size:20px;
    font-weight:700;
    color:#0b1220;
}

/* Subtitle / helper text */
.subtext{
    font-size:13px;
    color:var(--muted);
    margin-top:6px;
}

/* Form groups */
.form-group{
    margin-top:14px;
    transition: transform .22s ease, box-shadow .22s ease;
    position: relative;
    display:block;
}
.form-group label{
    display:block;
    font-weight:500;
    font-size:13px;
    margin-bottom:8px;
    color:#111827;
}

/* Input */
.profile-form input[type="password"],
.profile-form input[type="text"],
.profile-form input[type="email"]{
    width:100%;
    padding:12px 14px;
    border-radius:10px;
    border:1px solid rgba(15,23,42,0.06);
    background: var(--input-bg);
    font-size:14px;
    transition: box-shadow .22s ease, border-color .18s ease, background .18s ease;
    outline: none;
    color: #0b1220;
}

/* Focus state - CellphoneS red glow */
.profile-form input:focus{
    border-color: rgba(238,0,51,0.9);
    box-shadow: 0 6px 20px rgba(238,0,51,0.08);
    background: #fff;
}

/* Validation error text */
.text-danger{
    margin-top:6px;
    font-size:13px;
    color: #b91c1c;
}

/* Submit button */
.btn-change-password{
    margin-top:18px;
    display:inline-block;
    width:100%;
    padding:12px 14px;
    border-radius:12px;
    border: none;
    cursor:pointer;
    font-weight:700;
    font-size:15px;
    color:#fff;
    background: linear-gradient(90deg, var(--cell-red), var(--cell-red-2));
    box-shadow: 0 8px 30px rgba(238,0,51,0.16);
    transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
}

/* Hover button */
.btn-change-password:hover{
    transform: translateY(-3px);
    box-shadow: 0 14px 40px rgba(238,0,51,0.22);
    filter: brightness(1.03);
}

/* subtle helper row for messages */
.session-message{
    padding:10px 12px;
    border-radius:8px;
    background: linear-gradient(90deg, rgba(14,165,233,0.06), rgba(34,197,94,0.03));
    border:1px solid rgba(14,165,233,0.06);
    font-size:13px;
    color:#064e3b;
    margin-bottom:8px;
}

/* Small screens */
@media (max-width:780px){
    .profile-card{
        flex-direction: column;
        max-width: 100%;
    }
    .profile-image{
        width:100%;
        padding:24px;
    }
    .profile-form{
        width:100%;
        padding:20px;
    }
    .avatar-wrap{
        width:120px;
        height:120px;
    }
    .profile-card::before{ display:none; }
}

/* hover interactions */
.form-group:hover{
    transform: translateY(-4px);
    box-shadow: 0 8px 26px rgba(12,17,23,0.06);
}

/* avatar hover glow (red) */
.avatar-wrap:hover{
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(238,0,51,0.18), 0 6px 18px rgba(0,0,0,0.12);
    border-radius: 50%;
}

/* small helper for icons inside inputs if needed */
.input-icon{
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    color:var(--muted);
    font-size:14px;
}

/* subtle focus for the whole card on load */
.profile-card:focus-within{
    box-shadow: var(--shadow-2);
}

</style>
@endpush

@push('css-dependencies')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Roboto', sans-serif;
    background: #f3f4f6;
    min-height: 100vh;
}

.main-body {
    display: flex;
    justify-content: center;
    padding: 40px 15px;
}

.profile-card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    overflow: hidden;
    display: flex;
    max-width: 900px;
    width: 100%;
}

/* Avatar cột trái */
.profile-image {
    background: linear-gradient(135deg, #ffffffff, #ffffffff);
    padding: 40px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 1;
    color: #fff;
    text-align: center;
}

.profile-image img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,0.8);
    margin-bottom: 15px;
    object-fit: cover;
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.profile-image img:hover {
    transform: scale(1.06);
}

.profile-form {
    flex: 2;
    padding: 40px 30px;
}

/* Title căn giữa */
.profile-form h2 {
    text-align: center;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 25px;
    color: #333;
}

.profile-form input {
    width: 100%;
    padding: 12px 15px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    background: #f9fafb;
    transition: all 0.3s ease;
}

.profile-form input:focus {
    border-color: #EE0033;
    box-shadow: 0 0 10px rgba(238, 0, 51, 0.25);
    background: #ffffff;
    outline: none;
}

/* Nút đỏ chuẩn CellphoneS */
.btn-change-password {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    background: linear-gradient(90deg, #EE0033, #ff4d6d);
    color: #fff;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 18px rgba(238, 0, 51, 0.28);
}

.btn-change-password:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(238, 0, 51, 0.4);
}

</style>
@endpush


@section('content')
<div class="main-body">
    <div class="profile-card" role="region" aria-label="User profile card">

        <!-- Left: Avatar / basic info -->
        <div class="profile-image" aria-hidden="false">
            <div class="avatar-wrap" title="Avatar">
                <img src="{{ '/' . 'storage/' . auth()->user()->image }}" alt="Ảnh hồ sơ của {{ auth()->user()->fullname }}">
            </div>
            <h3>{{ auth()->user()->fullname }}</h3>
            <p>{{ auth()->user()->email }}</p>
        </div>

        <!-- Right: Form -->
        <div class="profile-form">
            @if(session()->has('message'))
                <div class="session-message">
                    {!! session("message") !!}
                </div>
            @endif

            <div class="header" role="heading" aria-level="2">
                <!-- Icon khóa SVG inline -->
                <div>
                    <h2>Đổi Mật Khẩu</h2>
                    <div class="subtext">Bảo mật tài khoản của bạn — sử dụng mật khẩu mạnh và không chia sẻ với người khác.</div>
                </div>
            </div>

            <form action="/profile/change_password" method="post" novalidate>
                @csrf

                <div class="form-group">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" name="current_password" class="@error('current_password') is-invalid @enderror" autocomplete="current-password" required>
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror" autocomplete="new-password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Nhập lại mật khẩu mới</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror" autocomplete="new-password" required>
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-change-password" aria-label="Đổi Mật Khẩu">Đổi Mật Khẩu</button>
            </form>
        </div>

    </div>
</div>
@endsection
