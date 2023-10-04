
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Amanullah House | Member Login</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('frontend') }}/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend') }}/assets/img/icon/192x192.png">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/style.css">
    <link rel="manifest" href="{{ asset('frontend') }}/__manifest.json">
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="{{ asset('frontend') }}/assets/img/login.jpg" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>Get started</h1>
                <h4>নিচের দেওয়া User ID ফিল্ডে ম্যানেজার থেকে পাওয়া প্রদত্ত আইডি টি দিন এবং লগইন বাটন এ ক্লিক করুন।
                    আইডি টি সঠিক হলে আপনাকে হোম পেজ এ নিয়ে যাবে। ভূল User Id দিলে এরর শো করবে।
                    লগইন করার পর আপনি চাইলে প্রোফাইল থেকে ইউজার আইডি Change করতে পারবেন।
                    ইউজার আইডি ভূলে গেলে ম্যানেজার এর সাথে যোগাযোগ করার জন্য অনুরোধ করা হলো।
                    সিস্টেম এর সব ফাংশনালিটি বুজার জন্য ভিডিও আইকন এ ক্লিক করে ভিডিও টা ভালো ভাবে দেখার অনুরোধ রইলো।
                </h4>
            </div>
            <div class="section mt-1 mb-5">
                <form id="loginForm">
                    <input type="hidden" name="password" value="0">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" name="u_id" id="u_id" placeholder="User Id">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed" id="password_field" style="display: none;">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password1" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-links mt-2" id="forgot_password_field" style="display: none;">
                        <div><a href="page-forgot-password.html" class="text-muted">Forgot Password?</a></div>
                    </div>

                    <div class="form-button-group">
                        <button type="button" id="loginBtn" class="btn btn-primary btn-block btn-lg">Log in</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="fab-button animate bottom-right dropdown" style="bottom: 75px;">
            <a href="#" class="fab" data-toggle="modal" data-target="#DialogImage" style="background: #071327">
                <ion-icon name="videocam-outline"></ion-icon>
            </a>
        </div>

        <!-- Dialog Image -->
        <div class="modal fade dialogbox" id="DialogImage" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <iframe width="100%" height="100%"
                            src="https://www.youtube.com/embed/tgbNymZ7vqY">
                    </iframe>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Dialog Image -->

        {{-- Toast --}}
        <div id="toast-12" class="toast-box bg-danger toast-center">
            <div class="in">
                <ion-icon name="trash-outline" class="text-light"></ion-icon>
                <div class="text" id="message">
                    Success Message
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
        </div>
        <!-- * toast danger -->

        <!-- toast success -->
        <div id="toast-11" class="toast-box bg-success toast-center">
            <div class="in">
                <ion-icon name="checkmark-circle" class="text-light"></ion-icon>
                <div class="text" id="message-success">
                    Success Message
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
        </div>
        <!-- * toast success -->

    </div>
    <!-- * App Capsule -->



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
    <script>
        // Ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#loginBtn").click(function (e) {
            e.preventDefault();
            $(this).html("Waiting...");
            $.ajax({
                type: "POST",
                url: "{{ route('check.userid') }}",
                data: $("#loginForm").serialize(),
                success: function (response) {
                    $("#loginBtn").html("Log in");
                    if(response.status == "success"){
                        toastbox('toast-11');
                        $("#message-success").html(response.message);
                        setTimeout(() => {
                            window.location = '/user/dashboard';
                        }, 800);
                    }else{
                        toastbox('toast-12');
                        $("#message").html(response.message);
                    }
                }
            });
        });
    </script>

</body>

</html>
