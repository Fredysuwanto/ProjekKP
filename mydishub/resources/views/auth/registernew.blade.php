<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>REGISTER</title>
  <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <link rel="shortcut icon" href="{{ url('images/dishub.png') }}" />
</head>
<body>
<div class="container-scroller d-flex">
  <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
    <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
      <div class="row flex-grow">
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
          <div class="auth-form-transparent text-left p-3">

            <!-- Ganti logo di sini -->
            <div class="brand-logo text-center mb-4">
              <img src="{{ url('images/dishub.png') }}" alt="logo" style="width: 100px; height: auto;">
            </div>

            <h4>Belum Punya Akun?</h4>
            <h6 class="font-weight-light">Silahkan Isi Kelengkapan Data Berikut</h6>

            <form class="pt-3" method="POST" action="{{ route('register') }}">
              @csrf

              <!-- Name -->
              <div class="form-group">
                <label for="name">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-account-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control form-control-lg border-left-0" id="name" name="name" placeholder="Username" value="{{ old('name') }}">
                </div>
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Email -->
              <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-email-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="email" class="form-control form-control-lg border-left-0" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                </div>
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Password -->
              <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-lock-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" placeholder="Password">
                </div>
                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Confirm Password -->
              <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-lock-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control form-control-lg border-left-0" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                </div>
              </div>

              <!-- Submit -->
              <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                  SIGN UP
                </button>
              </div>

              <!-- Link to login -->
              <div class="text-center mt-4 font-weight-light">
                Already have an account? <a href="{{ url('/login') }}" class="text-primary">Login</a>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6 register-half-bg d-none d-lg-flex flex-row">
          <p class="text-white font-weight-medium text-center flex-grow align-self-end">
            Copyright © 2018 All rights reserved.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ url('js/off-canvas.js') }}"></script>
<script src="{{ url('js/hoverable-collapse.js') }}"></script>
<script src="{{ url('js/template.js') }}"></script>
</body>
</html>
