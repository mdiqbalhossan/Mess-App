
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{--    <meta name="viewport"--}}
{{--        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />--}}
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title> @yield('title') | Amanullah House </title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('frontend') }}/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend') }}/assets/img/icon/192x192.png">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/style.css">
    <link rel="manifest" href="{{ asset('frontend') }}/__manifest.json">
    @stack('css')
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <div class="appHeader bg-primary scrolled">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            @yield('title')
        </div>
        <div class="right">
            <a href="#" class="headerButton">
                <ion-icon name="notifications-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->



    <!-- App Capsule -->
    <div id="appCapsule">


        @yield('content')


    @include('layouts.frontend.partials.footer')
    </div>
    <!-- * App Capsule -->

    <!-- App Bottom Menu -->
    @include('layouts.frontend.partials.bottom-menu')
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    @include('layouts.frontend.partials.sidebar')
    <!-- * App Sidebar -->

    <!-- toast warning -->
    <div id="toast-17" class="toast-box toast-bottom bg-warning">
        <div class="in">
            <div class="text">
                দুঃখিত, এই মূহূতে এই অংশটি সচল নইয়। পরবর্‌তী আপডেটে এই অংশ টি সংযোজন করা হবে।
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
    </div>
    <!-- * toast warning -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('frontend') }}/assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('frontend') }}/assets/js/lib/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('frontend') }}/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="{{ asset('frontend') }}/assets/js/base.js"></script>
    @stack('js')

</body>

</html>
