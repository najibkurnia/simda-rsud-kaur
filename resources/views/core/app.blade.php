<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="Content-Security-Policy" href="upgrade-insecure-requests">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    <title>{{ $title }} | RSUD KAUR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
</head>
<body>
    @if ($id_page == 'auth-index')
    
    @yield('components')
        
    @else 
    
    <div class="container-fluid">
        @include('partials.header')
        
        <div class="row justify-content-between">  
            @include('partials.sidebar')    
            <div class="col-10" style="height: 100vh; padding-top: 120px; padding-bottom: 40px; overflow-y: auto">    
                @yield('components')
            </div>
        </div>
    </div>

    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>