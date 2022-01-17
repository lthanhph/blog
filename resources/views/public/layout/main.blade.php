<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-5.15.4/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('public_asset/css/style.css') }}">
</head>
<body>
    <header>
        @include('public.path.menu')
    </header>
    <div id="main_container">
        @yield('main-content')
    </div>
    <footer class="bg-dark mt-5 d-flex flex-column">
        <div class="footer-1 w-100"></div>
        <div class="footer-2 w-100 flex-grow-1 d-flex justify-content-center align-items-center">
            <span class="text-light">Copyright &copy; 2021 Phule, Example Corporation</span>
        </div>
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('public_asset/js/main.js') }}"></script>
    <!-- <script src="{{ asset('vendor/common.js') }}"></script> -->
    </footer>
</body>
</html>