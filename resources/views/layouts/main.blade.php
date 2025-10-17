<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Trang web' }}</title>

  {{-- CSS & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  @include('/partials/main_css')
  @stack('css-dependencies')

  <style>
    html, body {
      height: 100%;
      width: 100%;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      background-color: #f5f5f5;
    }

    body.sb-nav-fixed {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    #layoutContent {
      flex: 1;
      width: 100vw;
      height: 100%;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    footer {
      width: 100%;
      margin-top: auto;
    }
  </style>
</head>

<body class="sb-nav-fixed">
  {{-- Loading --}}
  <div id="loading" style="display: none"></div>

  {{-- Topbar --}}
  @include('/partials/topbar')

  {{-- Nội dung chính --}}
  <main id="layoutContent">
      @yield("content")
  </main>

  {{-- Hiển thị thông báo flash (success / error) --}}
  @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3" style="z-index:9999;">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
  @endif

  @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" style="z-index:9999;">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
  @endif

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
          integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="/js/datatables-simple.js"></script>
  <script src="/js/scripts.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @stack('scripts-dependencies')
  @stack('modals-dependencies')   

  {{-- Tự động ẩn alert sau 3s --}}
  <script>
    setTimeout(() => {
      document.querySelectorAll('.alert').forEach(a => a.classList.remove('show'));
    }, 3000);
  </script>
</body>
</html>
