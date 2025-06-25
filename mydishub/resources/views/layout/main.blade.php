<!DOCTYPE html>
<html lang="en">





<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{url('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{url('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  
  <link rel="stylesheet" href="{{url('css/style.css')}}">
  <style>
  .navbar-menu-wrapper,
  .navbar-search-wrapper {
    background-color: transparent !important;
    box-shadow: none !important;
  }
</style>
  <!-- endinject -->
  <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="shortcut icon" href="{{url('images/dishub.jpg')}}" />
</head>

<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
       <li class="nav-item sidebar-category text-center" style="margin-bottom: 20px;">
  <img src="{{ asset('images/dishub.png') }}" alt="Logo Dishub" 
       style="width: 100px; height: auto; margin-bottom: 10px;">
  <p style="font-size: 1.5rem; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px;">MY DISHUB</p>
</li>


       
         <li class="nav-item sidebar-category">
          <p>Berita</p>
          <span></span>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            <div class="badge badge-info badge-pill">News</div>
          </a>
        </li> 
{{-- Cek jika user sudah login --}}
<li class="nav-item sidebar-category">
          <p>Daftar</p>
          <span></span>
        </li>
@auth

  {{-- MENU UNTUK USER (role = b) --}}
  @if(auth()->user()->role === 'b')
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center" href="{{ url('pemilik') }}">
        <i class="mdi mdi-account-plus menu-icon" style="margin-right: 10px; font-size: 20px;"></i>
        <span class="menu-title">Data Diri/Perusahaan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link d-flex align-items-center" href="{{ url('kapal') }}">
        <i class="mdi mdi-grease-pencil menu-icon" style="margin-right: 10px; font-size: 20px;"></i>
        <span class="menu-title">Data Kapal</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('surat') }}">
        <i class="mdi mdi-file-multiple menu-icon"></i>
        <span class="menu-title">Surat</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('riwayat') }}">
        <i class="mdi mdi-history menu-icon"></i>
        <span class="menu-title">Riwayat</span>
      </a>
    </li>
        <li class="nav-item">
      <a class="nav-link" href="{{ url('perpanjangsurat') }}">
        <i class="mdi mdi-file refresh menu-icon"></i>
        <span class="menu-title">Perpanjang Surat</span>
      </a>
    </li>
  @endif

  {{-- MENU UNTUK ADMIN (role = a) --}}
  @if(auth()->user()->role === 'a')
    <li class="nav-item">
      <a class="nav-link" href="{{ url('laporan') }}">
        <i class="mdi mdi-file-document-box menu-icon"></i>
        <span class="menu-title">Laporan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('proses') }}">
        <i class="mdi mdi-grease-pencil menu-icon"></i>
        <span class="menu-title">Proses yang Berjalan</span>
      </a>
    </li>
  @endif

@endauth

        
        <li class="nav-item sidebar-category">
          <p>Informasi</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">Tentang Kami</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
           <ul class="nav flex-column sub-menu"> 
          <li class="nav-item"> <a class="nav-link" href="{{ route('tentang.profil') }}"> Profil Perusahaan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('tentang.visi') }}"> Visi Misi </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('tentang.kontak') }}"> Kontak </a></li>
          </ul>
          </div>
        </li>
        
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row"
           style="background-image: url('{{ asset('images/header.png') }}');             
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 150px;">
            
              <div class="container-fluid d-flex justify-content-between align-items-center px-4">
<div class="d-flex flex-column align-items-start">
  <a class="navbar-brand brand-logo mb-1" href="index.html">
    <img src="{{ asset('images/logo_dishub.png') }}" alt="logo" style="height: 40px; width: auto;">
  </a>
  <h5 class="mb-0 text-dark fw-bold">Selamat Datang di Website MyDishub</h5>
</div>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="images/faces/profil.png" alt="profile" />
@auth
  <span class="nav-profile-name">{{ auth()->user()->name }}</span>
@else
  <span class="nav-profile-name">Guest</span>
@endauth              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
<a class="dropdown-item" href="{{ route('profile.edit') }}">
  <i class="mdi mdi-settings text-primary"></i>
  Settings
</a>
               <!-- Authentication -->
<form method="POST" action="{{ route('logout') }}" id="logout-form">
  @csrf
  <a href="#" onclick="confirmLogout(event)" class="dropdown-item">
    <i class="mdi mdi-logout text-primary"></i> {{ __('Log Out') }}
  </a>
</form>
</div>
</li>
<li class="nav-item">
  <a href="https://dishub.sumselprov.go.id/" class="nav-link icon-link" target="_blank" rel="noopener">
    <i class="mdi mdi-web"></i>
  </a>
</li>
</ul>
</div>
</nav>
<!-- partial -->
  <div class="container-scroller ">
    <div class="main-panel flex-fill ">
      <div class="content-wrapper flex-grow-1">
    @yield('content')
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:./partials/_footer.html -->
<footer style="background-color: #8b8b8b;" class="text-white pt-5">
    <div class="container py-4">
        <div class="row">
            <!-- Alamat Kantor -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Alamat Kantor</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i> Jalan Kapten A. Rivai No. 51, Sungai Pangeran, Ilir Timur I, Sungai Pangeran, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30127, Indonesia</p>
                <p><i class="fas fa-phone me-2"></i> (0711) 352005-363125 / (0711) 377170</p>
                <p><i class="fas fa-envelope me-2"></i> dishubsumsel2019@gmail.com</p>
            </div>

            <!-- Tentang Kami -->
            <div class="col-md-2 mb-4">
                <h5 class="fw-bold mb-3">Tentang Kami</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-angle-double-right me-2"></i><a href="{{ url('/') }}" class="text-white text-decoration-none"> Home</a></li>
                    <li><i class="fas fa-angle-double-right me-2"></i><a href="{{ url('/tentang/profil') }}" class="text-white text-decoration-none"> Profil</a></li>
                    <li><i class="fas fa-angle-double-right me-2"></i><a href="{{ url('/tentang/visi-misi') }}" class="text-white text-decoration-none"> Visi Misi</a></li>
                    <li><i class="fas fa-angle-double-right me-2"></i><a href="{{ url('/tentang/kontak') }}" class="text-white text-decoration-none"> Kontak Kami</a></li>
                </ul>
            </div>

            <!-- Situs Kelola -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Situs Kelola</h5>
                <p>Dikelola Oleh Dinas Perhubungan <br>Provinsi Sumatera Selatan</p>
            </div>

            <!-- Sosial Media -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Follow Us On</h5>
                <a href="https://web.facebook.com/dinasperhubungan.provinsisumsel?mibextid=LQQJ4d&_rdc=1&_rdr#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg border rounded-circle p-3 fs-5"></i></a>
                <a href="https://www.youtube.com/@dishubsumsel2198" class="text-white me-3"><i class="fab fa-youtube fa-lg border rounded-circle p-3 fs-5"></i></a>
                <a href="https://www.instagram.com/dishub_sumsel/" class="text-white"><i class="fab fa-instagram fa-lg border rounded-circle p-3 fs-5"></i></a>
            </div>
        </div>
    </div>

    <div style="background-color: #00c67a;" class="text-center text-white py-2">
        <p class="mb-0">Copyright © 2024 Dinas Perhubungan Prov. Sumsel</p>
        <div class="text-center mt-1">dishub</div>
    </div>
</footer>

  <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- base:js -->
<script src="{{url('vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{url('vendors/chart.js/Chart.min.js')}}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{url('js/off-canvas.js')}}"></script>
<script src="{{url('js/hoverable-collapse.js')}}"></script>
<script src="{{url('js/template.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="js/dashboard.js"></script>
<!-- End custom js for this page-->

<!-- Custom logout confirmation script -->
<script>
  function confirmLogout(event) {
    event.preventDefault();
    if (confirm('Apakah Anda yakin ingin logout?')) {
      document.getElementById('logout-form').submit();
    }
  }
</script>

@yield('scripts')

<script>
    function updateDateTime() {
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const dateStr = now.toLocaleDateString('en-US', options);
        const timeStr = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        const target = document.getElementById("currentDateTime");
        if (target) {
            target.textContent = `${dateStr} - ${timeStr}`;
        }
    }

    updateDateTime();
    setInterval(updateDateTime, 60000);
</script>
@stack('scripts')


</body>

</html>
