<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="Content-Security-Policy" href="upgrade-insecure-requests">

    <!-- Memuat Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-3.2.6.min.css">

    <!-- Memuat Datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">

    <!-- Memuat BoxIcons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    <title>{{ $title }} | RSUD KAUR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
</head>

<body>
    @if ($id_page == 'auth-index')
        @yield('components')
    @else
        <div class="container-fluid header-container">
            <div class="row header-row">
                <div class="col header-col">
                    @include('partials.header')
                </div>
            </div>
            <div class="row body-row">
                <div class="col-2 seadbar-col">
                    @include('partials.sidebar')
                </div>
                <div class="col konten-col">
                    @yield('components')
                </div>

            </div>

        </div>
    @endif

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    @include('partials.notiflix')

    <!-- Datatable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>


    <script>
        new DataTable('#data', {
            info: false,
            paging: false,
            searching: false,
            ordering: false,
        });
        new DataTable('#data1');
        new DataTable('#data2', {
            ordering: false,

        });

        $(".menu > ul > li").click(function(e) {
            $(this).siblings().removeClass("active");
            $(this).toggleClass("active");
            $(this).find("ul").slideToggle();
            $(this).siblings().find("ul").slideUp();
            $(this).siblings().find("ul").find("li").removeClass("active");
        });
        $(".menu-btn").click(function() {
            $(".sidebar-menu").toggleClass("active");
            $(".seadbar-col").toggleClass("active");
        });
    </script>
</body>

</html>
