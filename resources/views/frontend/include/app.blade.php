<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ Helper::getSettings('application_name') }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Arvo&family=Caesar+Dressing&family=Kameron&family=Raleway&display=swap"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('css')
</head>

<body>
    @include('shared.toastr.toastr')

    @include('frontend.include.header')
    <div>
        @yield('content')
    </div>
    @include('frontend.include.footer')
    @include('shared.audio.audio')
    <div id="preloader">
        <video autoplay muted loop>
            <source src="{{ asset('assets/img/logo/opening-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa-solid fa-arrow-up"></i></a>
    <script src="{{ asset('vendor/bootstrap\js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('js')
</body>

</html>
