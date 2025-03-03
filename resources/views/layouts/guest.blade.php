<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
</head>
<body>


    <div class="flex-row bg-light min-vh-100 d-flex align-items-center">

        <div class="container">
            <div class="d-flex justify-content-center">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" class="mb-3 " style="width: 130px;">
            </div>
            <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
@vite('resources/js/app.js')
</body>
</html>
