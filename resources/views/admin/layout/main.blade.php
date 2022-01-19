<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog | Admin</title>

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-5.15.4/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui-1.13.0/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/css/style.css') }}">

</head>

<body>
    <header>
        @include('admin.path.topbar')
    </header>
    <div id="main-container">
            <div class="menu-col">
                @include('admin.path.menu')
            </div>
            <div class="content-col">
                @yield('main-content')
            </div>
        </div>
    </div>
    <footer>

        <!-- js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('vendor/jquery-ui-1.13.0/jquery-ui.js') }}"></script>
        <script src="{{ asset('admin_asset/js/main.js') }}"></script>
    </footer>
</body>

</html>