<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laundry') }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('/theme/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('/theme/css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="{{ asset('/') }}theme/images/logos/logo-laundry.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        @include('layouts.sidebar')

        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
    @include('layouts.navigation')
      <!--  Header End -->

        <div class="container-fluid">
            {{ $slot }}
        </div>

    </div>
  </div>

    <script src="{{ asset('/theme/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/theme/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/theme/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('/theme/js/app.min.js') }}"></script>
    <script src="{{ asset('/theme/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
            });
        });

        $('.show_cancel').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to cancel this order?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
            });
        });
    </script>
</body>

</html>
