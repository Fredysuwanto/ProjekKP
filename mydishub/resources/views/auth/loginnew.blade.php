<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LOGIN</title>
  <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <link rel="shortcut icon" href="{{ url('images/favicon.png') }}" />
</head>
<body>
<div class="container-scroller d-flex">
  <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
    <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
      <div class="row flex-grow">
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
          <div class="auth-form-transparent text-left p-3">
            <div class="brand-logo">
              <img src="../../images/logo.svg" alt="logo">
            </div>
            <h4>Welcome back!</h4>
            <h6 class="font-weight-light">Happy to see you again!</h6>
            <form class="pt-3" method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-account-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control form-control-lg border-left-0" id="email" name="email" placeholder="Email">
                  @error('email')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="mdi mdi-lock-outline text-primary"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" placeholder="Password">
                  @error('password')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    Keep me signed in
                  </label>
                </div>
                <a href="#" class="auth-link text-black">Forgot password?</a>
              </div>
              <div class="my-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
              </div>
              <div class="text-center mt-4 font-weight-light">
                Don't have an account? <a href="{{ url('/registernew') }}" class="text-primary">Create</a>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6 login-half-bg d-none d-lg-flex flex-row">
          <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018 All rights reserved.</p>
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
