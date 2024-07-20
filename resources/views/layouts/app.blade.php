
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - MTS NUR IMAN MLANGI</title>

  <link href="assets/img/logo-mts.png" rel="icon">
  <link href="{{asset('assets/template/NiceAdmin/assets')}}//img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{asset('assets/template/NiceAdmin/assets')}}//vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('assets/template/NiceAdmin/assets')}}//vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset('assets/template/NiceAdmin/assets')}}//vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset('assets/template/NiceAdmin/assets')}}//vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('assets/template/NiceAdmin/assets')}}//vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{asset('assets/template/NiceAdmin/assets')}}//vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{asset('assets/template/NiceAdmin/assets')}}//vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="{{asset('assets/template/NiceAdmin/assets')}}//css/style.css" rel="stylesheet">
</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo-mts.png" alt="">
        <span class="d-none d-lg-block"> MTS NUR IMAN</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
        </li>

        <li class="nav-item dropdown">
        </li>

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('assets/template/NiceAdmin/assets')}}//img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"> {{ Auth::user()->name }}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> {{ Auth::user()->name }}</h6>
              <span>Administrator</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="editprofile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
                
                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('kriteria.*') ? '' : 'collapsed' }}" href="{{ route('kriteria.index') }}">
                <i class="bi bi-people"></i>
                <span>Kriteria</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('siswa.*') ? '' : 'collapsed' }}" href="{{ route('siswa.index') }}">
                <i class="bi bi-people"></i>
                <span>Siswa</span>
            </a>
        </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('penilaian.*') ? '' : 'collapsed' }}" href="{{ route('penilaian.index') }}">
          <i class="bi bi-bar-chart"></i>
          <span>Penilaian</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('perhitungan.*') ? '' : 'collapsed' }}" href="perhitungan">
          <i class="bi bi-calculator"></i>
          <span>Perhitungan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('hasil-akhir.*') ? '' : 'collapsed' }}" href="{{ route('hasil-akhir.index') }}">
          <i class="bi bi-clipboard-data"></i>
          <span>Data Hasil Akhir</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('riwayat.perhitungan') ? '' : 'collapsed' }}" href="{{ route('riwayat.perhitungan') }}">
          <i class="bi bi-clipboard-data"></i>
          <span>Riwayat Perhitungan</span>
        </a>
      </li>
    </ul>
  </aside>

  <!-- MASUKAN DATA DASHBOARDNYA  DISINI -->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>@yield('title')</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   @yield('content')
  </main>

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; <?php echo date('Y'); ?> <strong>MTS NUR IMAN MLANGI SLEMAN</strong>.
      <div class="credits">
        Created by <a href="#" target="_blank">Rachma Yuni Andari, S.Kom</a>
      </div>
    </div>
  </footer>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/chart.js/chart.umd.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/echarts/echarts.min.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/quill/quill.min.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/tinymce/tinymce.min.js"></script>
  <script src="{{asset('assets/template/NiceAdmin/assets')}}//vendor/php-email-form/validate.js"></script>

  <script src="{{asset('assets/template/NiceAdmin/assets')}}//js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if ($errors->any())
      <script>
          let errorMessages = '';
          @foreach ($errors->all() as $error)
              errorMessages += "{{ $error }}\n";
          @endforeach

          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: errorMessages,
          });
      </script>
  @endif
  @if (session('success') || session('error'))
  <script>
      $(document).ready(function() {
          var successMessage = "{{ session('success') }}";
          var errorMessage = "{{ session('error') }}";

          if (successMessage) {
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: successMessage,
              });
          }

          if (errorMessage) {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: errorMessage,
              });
          }
      });
  </script>
@endif

</body>

</html>