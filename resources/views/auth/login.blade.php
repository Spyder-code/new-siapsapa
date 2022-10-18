<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIAPSAPA | Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('social') }}/media/favicon.png">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/icofont/icofont.min.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/slick-carousel/css/slick.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/slick-carousel/css/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/magnific-popup/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/sal.js/sal.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/select2/css/select2.min.css" type="text/css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{ asset('social') }}/assets/css/app.css">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <style>
        .field-icon {
            float: right;
            margin-right: 20px;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 99;
        }
    </style>

</head>

<body class="sticky-header">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->
    <a href="#wrapper" data-type="section-switch" class="scrollup">
        <i class="icofont-bubble-up"></i>
    </a>
    <!-- Preloader Start Here -->
    {{-- <div id="preloader"></div> --}}
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper overflow-hidden">

        <!--=====================================-->
        <!--=          Header Menu Start       	=-->
        <!--=====================================-->
        <div class="login-page-wrap">
            <div class="content-wrap">
                <div class="login-content">
                    <div class="login-form-wrap">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#login-tab" role="tab" aria-selected="true"><i class="icofont-users-alt-4"></i> Sign In </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#registration-tab" role="tab" aria-selected="false"><i class="icofont-download"></i> Registration</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('password.request') }}"><i class="icofont-refresh"></i> Reset Password</a>
                            </li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane login-tab fade show active" id="login-tab" role="tabpanel">
                                <h3 class="item-title">Sign Into <span>Your Account</span></h3>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Your E-mail">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Password"><span toggle="#password" class="icofont-eye-alt field-icon toggle-password"></span>
                                    </div>
                                    <div class="form-group reset-password" role="tablist">
                                        <a class="nav-link" href="{{ route('password.request') }}">* Reset Password</a>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="remember" value="true" class="form-check-input" id="validationFormCheck2">
                                            <label class="form-check-label" for="validationFormCheck2">Keep me as signed in</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="login-btn" class="submit-btn w-100" value="Login">
                                    </div>
                                    <a href="{{ url('/') }}" class="btn btn-info w-100"> Kembali</a>
                                </form>
                                {{-- <div class="account-create">
                    		Don't have an account yet? <a href="#registration-tab">Sign Up Now</a>
                    	</div> --}}
                            </div>
                            <div class="tab-pane registration-tab fade" id="registration-tab" role="tabpanel">
                                <h3 class="item-title">Sign Up Your Account</h3>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password-register" class="form-control" placeholder="Password"><span toggle="#password-register" class="icofont-eye-alt field-icon field-icon toggle-password"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Konfirmasi Password"><span toggle="#password-confirm" class="icofont-eye-alt field-icon field-icon toggle-password"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="validationFormCheck1">
                                            <label class="form-check-label" for="validationFormCheck1">I accept the <a href="#">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="registration" class="submit-btn" value="Complete Registration">
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane login-tab fade show" id="reset-tab" role="tabpanel">
                                <h3 class="item-title">Reset <span>Password</span></h3>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Your E-mail">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="login-btn" class="submit-btn w-100" value="Login">
                                    </div>
                                    <a href="{{ url('/') }}" class="btn btn-info w-100"> Kembali</a>
                                </form>
                                {{-- <div class="account-create">
                    		Don't have an account yet? <a href="#registration-tab">Sign Up Now</a>
                    	</div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="map-line">
                    <img src="{{ asset('social') }}/media/banner/map_line.png" alt="map">
                    <ul class="map-marker">
                        <li><img src="{{ asset('social') }}/media/banner/marker_1.png" alt="marker"></li>
                        <li><img src="{{ asset('social') }}/media/banner/marker_2.png" alt="marker"></li>
                        <li><img src="{{ asset('social') }}/media/banner/marker_3.png" alt="marker"></li>
                        <li><img src="{{ asset('social') }}/media/banner/marker_4.png" alt="marker"></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--=====================================-->
        <!--=      Header Search Start          =-->
        <!--=====================================-->
        <div id="header-search" class="header-search">
            <button type="button" class="close">×</button>
            <form class="header-search-form">
                <input type="search" value="" placeholder="Search here..." />
                <button type="submit" class="search-btn">
                    <i class="flaticon-search"></i>
                </button>
            </form>
        </div>
    </div>
    <!-- Jquery Js -->
    <script src="{{ asset('social') }}/dependencies/jquery/js/jquery.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/popper.js/js/popper.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/isotope-layout/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/slick-carousel/js/slick.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/sal.js/sal.js"></script>
    <script src="{{ asset('social') }}/dependencies/magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/bootstrap-validator/js/validator.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/select2/js/select2.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>

    <!-- Site Scripts -->
    <script src="{{ asset('social') }}/assets/js/app.js"></script>
    <script>
        $(".toggle-password").click(function() {
                $(this).toggleClass("icofont-eye-blocked");
                var input = $(this).attr('toggle');
                input = $(input);
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
    </script>
</body>

</html>
