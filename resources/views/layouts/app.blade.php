<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kretip Match') }}</title>
    <link rel="icon" href="{{ asset('admin/dist/img/km-logo-initials.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

    <!-- Custom Styles -->
    <style>
        * {
            font-family: "Radio Canada Big", sans-serif;
        }

        main, html, body {
            background-color: whitesmoke;
        }

        li.nav-item {
            margin-right: .5em
        }

        a.nav-link {
            border: none;
            border-radius: 30px;
        }

        a.active {
            background-color: #ffa600;
            color: white !important;
        }

        a.nav-link:hover {
            background-color: #ffa600;
            transition: all ease-in-out 2ms;
        }

        footer {
            bottom: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-warning shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Kretip Match') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/about-us') }}" class="nav-link {{ Request::is('about-us') ? 'active' : '' }}">About Us</a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 my-auto">
        @yield('content')
    </main>

    <footer class="footer footer-expand-md bg-light p-3">
        <div>
            <strong>Copyright &copy; 2024-2025 <a href="https://adminlte.io">BYTEBLITZ</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script> $.widget.bridge('uibutton', $.ui.button); </script>
    <!-- Bootstrap 4 -->
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            // Initialize Select2 Elements
            $('.select2').select2();
            // Initialize Select2 Elements with Bootstrap4 theme
            $('.select2bs4').select2({ theme: 'bootstrap4' });
        });

        // SweetAlert2 for flash messages
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
    @stack('scripts')
</body>
</html>
