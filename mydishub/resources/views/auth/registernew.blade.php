<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>REGISTER</title>
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

    .register-left {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 2rem;
      background-color: #f4f6f9;
    }

    .register-form-box {
      width: 100%;
      max-width: 450px;
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

    .register-right {
  background-color: #001DFF; /* Biru gelap seperti tampilan Dishub */
  width: 100%;
  max-width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}


    .register-right img {
  max-width: 60%;
  height: auto;
  object-fit: contain;
}

    @media (max-width: 991.98px) {
      .register-right {
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
  <div class="register-left">
    <div class="register-form-box">
      <div class="brand-logo">
        <img src="{{ asset('images/dishub.png') }}" alt="Dishub Logo">
      </div>
      <h4 class="text-center mb-3">Daftar Akun Baru</h4>
      <p class="text-center text-muted mb-4">Silakan isi data di bawah ini untuk membuat akun.</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group mb-3">
          <label for="name">Username</label>
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="mdi mdi-account-outline text-primary"></i></span>
            <input type="text" class="form-control" id="name" name="name" placeholder="Username" value="{{ old('name') }}">
          </div>
          @error('name')
              <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group mb-3">
          <label for="email">Email</label>
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="mdi mdi-email-outline text-primary"></i></span>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
          </div>
          @error('email')
              <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group mb-3">
          <label for="password">Password</label>
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="mdi mdi-lock-outline text-primary"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          @error('password')
              <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group mb-3">
          <label for="password_confirmation">Konfirmasi Password</label>
          <div class="input-group">
            <span class="input-group-text bg-light"><i class="mdi mdi-lock-outline text-primary"></i></span>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password">
          </div>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-primary btn-block w-100">Daftar</button>
        </div>

        <div class="text-center text-small">
          Sudah punya akun? <a href="{{ url('/login') }}" class="text-primary">Login</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Right Panel -->
  <div class="register-right">
    <img src="{{ asset('images/auth/login-bg-new4.jpeg') }}" alt="Ilustrasi Dishub">
  </div>
</div>

<script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ url('js/off-canvas.js') }}"></script>
<script src="{{ url('js/hoverable-collapse.js') }}"></script>
<script src="{{ url('js/template.js') }}"></script>
</body>
</html>
