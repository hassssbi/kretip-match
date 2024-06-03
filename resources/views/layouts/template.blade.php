<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Kretip Match') }} | {{ $breadcrumbs[1]['name'] }}</title>
  <link rel="icon" href="{{ asset('admin/dist/icon/km-logo.ico')}}">

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  {{-- sweetalert2 --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

</head>

<style>
    * {
        font-family: "Radio Canada Big", sans-serif;
    }

    main, html, body {
        background-color: whitesmoke;
    }

    .navbar-nav a.nav-link {
        border: none;
        border-radius: 30px;
    }

    .navbar-nav a.nav-link.active {
        background-color: #ffa600;
        color: white !important;
    }

    .navbar-nav a.nav-link:hover {
        background-color: #ffa600;
        transition: all ease-in-out 2ms
    }


</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-warning navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ auth()->check() ? route(auth()->user()->role_id == 1 ? 'admins.index' : (auth()->user()->role_id == 2 ? 'moderators.index' : 'volunteers.index')) : '#' }}" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link btn-logout" href="#">Logout</a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->

    <a href="{{ auth()->check() ? route(auth()->user()->role_id == 1 ? 'admins.index' : (auth()->user()->role_id == 2 ? 'moderators.index' : 'volunteers.index')) : '#' }}" class="brand-link">
        <img src="{{ asset('admin/dist/icon/km-logo.ico')}}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ (isset(Auth::user()->image) ? Storage::url(Auth::user()->image) : asset('admin/dist/img/default-user.png')) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false" id="navigationMenu">
          {{-- Admin Navbar --}}
          @if (Auth::user()->role_id == 1)
            <li class="nav-item">
                <a href="{{ route('admins.index')}}" class="nav-link @if(Request::routeIs('admins.index')) active @endif">
                <i class="fas fa-home nav-icon"></i>
                <p>Home</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admins.profile', Auth::user()->id) }}" class="nav-link @if(Request::routeIs('admins.profile') || Request::routeIs('admins.editProfile') || Request::routeIs('admins.changePassword')) active @endif">
                <i class="fas fa-user-secret nav-icon"></i>
                <p>Profile</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admins.users') }}" class="nav-link @if(Request::routeIs('admins.users') || Request::routeIs('admins.userProfile')) active @endif">
                <i class="fas fa-users nav-icon"></i>
                <p>Manage Users</p>
                </a>
            </li>
          @endif

          {{-- Moderator Navbar --}}
          @if (Auth::user()->role_id == 2)
            <li class="nav-item">
                <a href="{{ route('moderators.index')}}" class="nav-link @if(Request::routeIs('moderators.index')) active @endif">
                <i class="fas fa-home nav-icon"></i>
                <p>Home</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('moderators.profile', Auth::user()->id) }}" class="nav-link @if(Request::routeIs('moderators.profile') || Request::routeIs('moderators.editProfile') || Request::routeIs('moderators.changePassword')) active @endif">
                <i class="fa fa-user-tie nav-icon"></i>
                <p>Profile</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('moderators.events') }}" class="nav-link @if(Request::routeIs('moderators.events') || Request::routeIs('moderators.createEvent') || Request::routeIs('moderators.editEvent') || Request::routeIs('moderators.viewEvent') || Request::routeIs('moderators.applications')) active @endif">
                <i class="fas fa-calendar nav-icon"></i>
                <p>Events</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('moderators.completedEvents') }}" class="nav-link @if(Request::routeIs('moderators.completedEvents') || Request::routeIs('moderators.viewCompletedEvent') || Request::routeIs('moderators.feedbacks')) active @endif">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Completed Events</p>
                </a>
            </li>
          @endif

          {{-- Volunteer Navbar --}}
          @if (Auth::user()->role_id == 3)
            <li class="nav-item">
                <a href="{{ route('volunteers.index')}}" class="nav-link @if(Request::routeIs('volunteers.index')) active @endif">
                <i class="fas fa-home nav-icon"></i>
                <p>Home</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('volunteers.profile', Auth::user()->id) }}" class="nav-link @if(Request::routeIs('volunteers.profile') || Request::routeIs('volunteers.editProfile') || Request::routeIs('volunteers.changePassword')) active @endif">
                <i class="fa fa-user nav-icon"></i>
                <p>Profile</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('volunteers.events') }}" class="nav-link @if(Request::routeIs('volunteers.events') || Request::routeIs('volunteers.eventDetails')) active @endif">
                <i class="fas fa-calendar nav-icon"></i>
                <p>Events</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('volunteers.status', Auth::user()->id) }}" class="nav-link @if(Request::routeIs('volunteers.status') || Request::routeIs('volunteers.statusDetails')) active @endif">
                <i class="fas fa-tasks nav-icon"></i>
                <p>Status</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('volunteers.assignedEvents', Auth::user()->id) }}" class="nav-link @if(Request::routeIs('volunteers.assignedEvents')) active @endif">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Assigned Events</p>
                </a>
            </li>
          @endif

          <li class="nav-item">
            <a class="nav-link btn-logout" href="#">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>

        </ul>
      </nav>


      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="content m-2">
            @yield('content')
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024-2025 <a href="https://adminlte.io">BYTEBLITZ</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Summernote -->
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Optional: Include jQuery if you want to use it -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>

@stack('scripts')

<script>
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

    // Logout confirmation
    document.querySelectorAll('.btn-logout').forEach(function (a) {
        a.addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    });
</script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
