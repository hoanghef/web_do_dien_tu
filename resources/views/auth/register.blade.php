@extends('/layouts/auth')

@push('css-dependencies')
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
body { 
    margin:0; 
    font-family:'Orbitron',sans-serif; 
    background:url('/storage/home/logo1.png') no-repeat center center fixed; 
    background-size:cover; 
    display:flex; 
    align-items:center; 
    justify-content:center; 
    min-height:100vh; 
    position:relative; 
}
.overlay { 
    position:absolute; top:0; left:0; right:0; bottom:0; 
    background: rgba(0,0,0,0.65); 
    z-index:1; 
}

.register-card { 
    position:relative; 
    z-index:2; 
    background: rgba(18,18,18,0.9); 
    border-radius:20px; 
    padding:40px 30px; 
    width:600px; 
    max-width:95%; 
    box-shadow:0 0 25px rgba(255,187,0,0.6); 
    border:2px solid rgba(255,187,0,0.3); 
    text-align:center; 
    display:flex; 
    flex-direction:column; 
    gap:15px; 
}
.register-card h1 { 
    color:#ffbb00; 
    font-size:28px; 
    margin-bottom:10px; 
    text-shadow:0 0 10px #ffbb00, 0 0 25px #ffcc33; 
}
.register-card p { 
    color:#eee; 
    font-size:13px; 
    margin-bottom:15px; 
}

.input-group { position:relative; margin-bottom:15px; }
.input-group input, .input-group select { 
    width:100%; 
    padding:10px 35px 10px 10px; 
    border-radius:8px; 
    border:1px solid #ffbb00; 
    background:rgba(0,0,0,0.6); 
    color:#fff; 
    font-size:14px; 
    transition: all 0.3s ease; 
}
.input-group input:focus, .input-group select:focus { 
    border-color:#ffcc33; 
    box-shadow:0 0 10px #ffbb00, 0 0 20px #ffcc33; 
    outline:none; 
}
.input-group i { 
    position:absolute; right:10px; top:50%; 
    transform:translateY(-50%); 
    color:#ffbb00; pointer-events:none; 
}

.btn-register { 
    width:100%; 
    padding:12px; 
    font-size:16px; 
    font-weight:bold; 
    border-radius:10px; 
    border:none; 
    cursor:pointer; 
    background: linear-gradient(90deg,#ffcc00,#ff8800); 
    color:#121212; 
    transition: all 0.3s ease; 
    box-shadow:0 0 15px #ffbb00; 
}
.btn-register:hover { 
    transform: translateY(-2px); 
    box-shadow:0 0 25px #ffcc00,0 0 40px #ffaa00; 
}

.register-card a { 
    color:#ffcc00; 
    text-decoration:none; 
    font-size:13px; 
}
.register-card a:hover { 
    color:#ffaa00; 
}

.row-two-columns { 
    display:flex; 
    gap:15px; 
}
.row-two-columns .input-group { 
    flex:1; 
}
@media(max-width:650px){ 
    .row-two-columns { flex-direction:column; } 
}
</style>

@endpush

@push('scripts-dependencies')
<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.input-group input, .input-group select').forEach(input=>{
        input.addEventListener('focus', ()=>input.style.background='rgba(0,0,0,0.8)');
        input.addEventListener('blur', ()=>input.style.background='rgba(0,0,0,0.7)');
    });
});
</script>
@endpush

@section('content')
<div class="overlay"></div>
<div class="register-card">
    <h1>Đăng Ký</h1>
    <p>Tạo tài khoản để mua sắm phụ kiện máy tính gaming & PC cao cấp</p>

    @if(session()->has('message')) {!! session("message") !!} @endif

    <form method="post" action="/auth/register">
        @csrf
        <div class="row-two-columns">
            <div class="input-group"><input type="text" name="fullname" placeholder="Họ và tên" value="{{ old('fullname') }}"><i class="fas fa-user"></i></div>
            <div class="input-group"><input type="text" name="username" placeholder="Tên đăng nhập" value="{{ old('username') }}"><i class="fas fa-id-badge"></i></div>
        </div>
        <div class="input-group"><input type="text" name="email" placeholder="Email" value="{{ old('email') }}"><i class="fas fa-envelope"></i></div>
        <div class="row-two-columns">
            <div class="input-group"><input type="password" name="password" placeholder="Mật khẩu"><i class="fas fa-lock"></i></div>
            <div class="input-group"><input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu"><i class="fas fa-lock"></i></div>
        </div>
        <div class="row-two-columns">
            <div class="input-group"><input type="text" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}"><i class="fas fa-phone"></i></div>
            <div class="input-group"><input type="text" name="address" placeholder="Địa chỉ" value="{{ old('address') }}"><i class="fas fa-map-marker-alt"></i></div>
        </div>
        <div class="input-group">
            <select name="gender">
                <option value="">Giới tính</option>
                <option value="M" {{ old('gender')=='M'?'selected':'' }}>Nam</option>
                <option value="F" {{ old('gender')=='F'?'selected':'' }}>Nữ</option>
            </select>
        </div>
        <button type="submit" class="btn-register">Đăng Ký</button>
    </form>

    <p style="margin-top:15px;"><a href="/auth/login">Đã có tài khoản? Đăng nhập ngay!</a></p>
</div>
@endsection
