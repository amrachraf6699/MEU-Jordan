<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('logo.svg') }}">
  <link rel="icon" type="image/png" href="{{ asset('logo.svg') }}">
  <title>
    جامعة الشرق الأوسط - كلية الآداب و العلوم التربوية | @yield('title')
  </title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Cairo', sans-serif !important;
    }

    .pagination {
      display: flex;
      justify-content: center;
    }

    .page-item.active .page-link {
      background-color: #fca311;
      border-color: #fca311;
      color: white;
    }

    .page-link {
      color: #457b9d;
    }

    .page-link:hover {
      background-color: #457b9d;
      color: white;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('') }}assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show rtl bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret" id="sidenav-main">
    <div class="sidenav-header">
      <i class="bx bx-x p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0">
        <span class="me-1 text-lg font-weight-bold text-center">جامعة الشرق الأوسط</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    {{ auth()->user()->full_name . ' (' . auth()->user()->employee_number . ') ' }}
    <hr class="horizontal dark mt-3">
    <div class="collapse navbar-collapse px-0 w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.home') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.home') ? '#' : route('dashboard.home') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class='bx bxs-home' style="font-size: 12px; color: {{ request()->routeIs('dashboard.home') ? '#fff' : '#67748e' }};"></i>
            </div>
            <span class="nav-link-text me-1">الصفحة الرئيسية</span>
          </a>
        </li>
        @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.departments.*') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.departments.*') ? '#' : route('dashboard.departments.index') }}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                <i class='bx bxs-category' style="font-size: 12px; color: {{ request()->routeIs('dashboard.departments.*') ? '#fff' : '#67748e' }};"></i>
              </div>
              <span class="nav-link-text me-1">الأقسام</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.programs.*') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.programs.*') ? '#' : route('dashboard.programs.index') }}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                <i class='bx bxs-notepad' style="font-size: 12px; color: {{ request()->routeIs('dashboard.programs.*') ? '#fff' : '#67748e' }};"></i>
              </div>
              <span class="nav-link-text me-1">البرامج</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.users.*') ? '#' : route('dashboard.users.index') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class='bx bxs-user' style="font-size: 12px; color: {{ request()->routeIs('dashboard.users.*') ? '#fff' : '#67748e' }};"></i>
            </div>
            <span class="nav-link-text me-1">المستخدمين</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.adopt.*') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.adopt.*') ? '#' : route('dashboard.adopt.index') }}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                <i class='bx bxs-file-blank' style="font-size: 12px; color: {{ request()->routeIs('dashboard.adopt.*') ? '#fff' : '#67748e' }};"></i>
              </div>
              <span class="nav-link-text me-1">إعتماد نموذج النتاجات البحثية</span>
            </a>
          </li>
        @endif
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.researches.*') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.researches.*') ? '#' : route('dashboard.researches.index') }}">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
                <i class='bx bxs-file-blank' style="font-size: 12px; color: {{ request()->routeIs('dashboard.researches.*') ? '#fff' : '#67748e' }};"></i>
              </div>
              <span class="nav-link-text me-1">النتاجات البحثية</span>
            </a>
          </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.settings') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.settings') ? '#' : route('dashboard.settings') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class='bx bxs-cog' style="font-size: 12px; color: {{ request()->routeIs('dashboard.settings') ? '#fff' : '#67748e' }};"></i>
            </div>
            <span class="nav-link-text me-1">الإعدادات</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.keys') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.keys') ? '#' : route('dashboard.keys') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class='bx bxs-key' style="font-size: 12px; color: {{ request()->routeIs('dashboard.keys') ? '#fff' : '#67748e' }};"></i>
            </div>
            <span class="nav-link-text me-1">رمز الإسترداد</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.activities') ? 'active' : '' }}" href="{{ request()->routeIs('dashboard.activities') ? '#' : route('dashboard.activities') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class='bx bxs-id-card' style="font-size: 12px; color: {{ request()->routeIs('dashboard.activities') ? '#fff' : '#67748e' }};"></i>
            </div>
            <span class="nav-link-text me-1">النشاطات</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard.logout') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class='bx bxs-log-out-circle' style="font-size: 12px; color: #67748e;"></i>
            </div>
            <span class="nav-link-text me-1">تسجيل الخروج</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class='bx bx-arrow-back'></i> العودة
                </a>
            </ol>
          </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
            <ul class="navbar-nav me-auto ms-0 justify-content-end">
              <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container-fluid py-4">
      @yield('content')
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.js"></script>
@if(session('success'))
    <script>
      Toastify({
        text: "{{ session('success') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: 'center',
        backgroundColor: "linear-gradient(to right, #2ecc71, #27ae60)",
      }).showToast();
    </script>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
    <script>
      Toastify({
        text: "{{ $error }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: 'center',
        backgroundColor: "linear-gradient(to right, #e74c3c, #c0392b)",
      }).showToast();
    </script>
    @endforeach
@endif
  <script src="{{ asset('') }}assets/js/soft-ui-dashboard.min.js"></script>
</body>

</html>
