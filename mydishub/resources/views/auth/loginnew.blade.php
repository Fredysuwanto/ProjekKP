<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <link rel="shortcut icon" href="{{ url('images/dishub.png') }}" />

  <style>
    body, html {
      height: 100%;
    }

    .auth-container {
      display: flex;
      height: 100vh;
    }

    .login-left {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 2rem;
      background-color: #f4f6f9;
    }

    .login-form-box {
      width: 100%;
      max-width: 420px;
      background-color: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .brand-logo img {
      width: 80px;
      height: auto;
      display: block;
      margin: 0 auto 1rem auto;
    }

    .login-right {
  background-color: #001DFF; /* Biru gelap seperti tampilan Dishub */
  width: 100%;
  max-width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}


    .login-right img {
  max-width: 60%;
  height: auto;
  object-fit: contain;
}

    @media (max-width: 991.98px) {
      .login-right {
        display: none;
      }
    }

    .btn-primary {
      background-color: #5e50f9;
      border: none;
    }

    .btn-primary:hover {
      background-color: #4836e0;
    }

    .text-small {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>

<div class="auth-container">
  <!-- Left Panel -->
  <div class="login-left">
    <div class="login-form-box">
      <div class="brand-logo">
        <img src="{{ asset('images/dishub.png') }}" alt="Dishub Logo">
      </div>
      <h4 class="text-center mb-4">Selamat Datang Kembali</h4>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group mb-3">
          <label for="email">Email</label>
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="mdi mdi-account-outline text-primary"></i></span>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
          </div>
          @error('email')
              <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <label for="password">Password</label>
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="mdi mdi-lock-outline text-primary"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          @error('password')
              <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-check mb-2">
          <input type="checkbox" class="form-check-input" id="remember">
          <label class="form-check-label text-small" for="remember">Ingat Saya</label>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <a href="#" class="text-decoration-none text-small">Lupa Password?</a>
        </div>

        <button type="submit" class="btn btn-primary btn-block w-100 mb-3">Login</button>

        <div class="text-center text-small">
          Belum punya akun? <a href="{{ url('/registernew') }}" class="text-primary">Daftar</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Right Panel -->
  <div class="login-right">
    <img src="{{ asset('images/auth/login-bg-new4.jpeg') }}" alt="Dishub Illustration">
  </div>
</div>

<script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ url('js/off-canvas.js') }}"></script>
<script src="{{ url('js/hoverable-collapse.js') }}"></script>
<script src="{{ url('js/template.js') }}"></script>
</body>
</html>
