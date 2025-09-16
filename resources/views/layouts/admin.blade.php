<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2ecd82a135.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.png') }}">

    <title>@yield('title')</title>
    @vite('resources/css/admin.css')
    @yield('head')
</head>

<body>
    <!-- Toggle button for small screens -->
    <button class="btn btn-light d-lg-none position-fixed" style="top: 10px; left: 10px; z-index: 1050;" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header d-lg-none">
            <h5 class="offcanvas-title" id="sidebarLabel"><a class="q navbar-brand fw-bold" href="{{ route('views.dashboard') }}"><span class="b">Byte</span>Quest</a></h5>

        @yield('content')
    </main>
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
        </script>

</body>

</html>