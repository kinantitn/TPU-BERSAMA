<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    @yield('css-ekstra')
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">

</head>

<body>

    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-brand.png') }}" class="navbar-brand-img" alt="Logo">
                </a>
                <div class="ml-auto">
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ App\Utilities\Helpers::checkUrlForMenu('home') }}" href="{{ route('home') }}">
                                <i class="ni ni-shop text-primary"></i>
                                <span class="nav-link-text font-weight-bold">
                                    Beranda
                                </span>
                            </a>
                        </li>
                        @if(App\Utilities\Helpers::checkRoleWithoutAction(['admin']))
                        <li class="nav-item">
                            <a class="nav-link {{ App\Utilities\Helpers::checkUrlForMenu('applicant') }}" href="{{ route('applicant') }}">
                                <i class="ni ni-archive-2 text-danger"></i>
                                <span class="nav-link-text font-weight-bold">
                                    Data Permohonan
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ App\Utilities\Helpers::checkUrlForMenu('funeral') }}" href="{{ route('funeral') }}">
                                <i class="ni ni-istanbul text-warning"></i>
                                <span class="nav-link-text font-weight-bold">
                                    Data TPU
                                </span>
                            </a>
                        </li>
                        @endif
                        @if(App\Utilities\Helpers::checkRoleWithoutAction(['user']))
                        <li class="nav-item">
                            <a class="nav-link {{ App\Utilities\Helpers::checkUrlForMenu('status') }}" href="{{ route('status') }}">
                                <i class="ni ni-book-bookmark text-warning"></i>
                                <span class="nav-link-text font-weight-bold">
                                    Status Permohanan
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ App\Utilities\Helpers::checkUrlForMenu('order') }}" href="{{ route('order') }}">
                                <i class="ni ni-building text-danger"></i>
                                <span class="nav-link-text font-weight-bold">
                                    Pemilihan Lokasi TPU
                                </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content" id="panel">
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-search navbar-search-dark form-inline mr-sm-3 d-none d-xl-block" id="navbar-search-main">

                        <a href="{{ url()->previous() }}" class="float-left" style="padding-top: .30rem !important;">
                            <i class="ni ni-bold-left text-white"></i>
                        </a>
                        <span class="h2 pl-3 mb-0 text-white">
                            @yield('title')
                        </span>
                    </div>
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item d-xl-none">
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark">
                                <a href="{{ url()->previous() }}">
                                    <div class="sidenav-toggler-inner pt-1">
                                        <i class="ni ni-bold-left text-white"></i>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item d-xl-none">
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-xl-none">
                            <h3 class="mb-1 text-white">
                                @yield('title')
                            </h3>
                        </li>
                    </ul>

                    <ul class="navbar-nav align-items-center ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="https://ui-avatars.com/api/?name={{ Auth::user()['name'] }}&size=160">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">
                                            {{ Auth::user()['name'] }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ni ni-user-run"></i>
                                    <span>{{ __('Keluar') }}</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">&nbsp;</div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt--7 pb-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('layouts.__alert')
                </div>
            </div>
            @yield('content')
        </div>

        <div class="container-fluid" style="bottom: 0;position: fixed;">
            <footer class="footer py-2 px-2">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-12">
                        <div class="copyright text-center text-lg-left text-muted">
                            &copy; {{ date('Y') }} <a href="{{ route('home') }}" class="font-weight-bold ml-1">{{ env('APP_NAME') }}</a>
                        </div>
                    </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Core -->
        <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
        @yield('js-ekstra')
        <!-- Argon JS -->
        <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>

</body>

</html>
