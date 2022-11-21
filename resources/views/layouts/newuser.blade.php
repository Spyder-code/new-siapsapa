<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIAPSAPA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logosiap.png') }}">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/icofont/icofont.min.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/slick-carousel/css/slick.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/slick-carousel/css/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/magnific-popup/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/sal.js/sal.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/mcustomscrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="{{ asset('social') }}/dependencies/select2/css/select2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{ asset('social') }}/assets/css/app.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    @yield('style')
    <style>
        .loading {
            z-index: 9999;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .loading img{
            width: 300px;
            height: 300px;
            animation-name: stretch;
            animation-duration: 1.5s;
            animation-timing-function: ease-out;
            animation-delay: 0;
            animation-direction: alternate;
            animation-iteration-count: infinite;
            animation-fill-mode: none;
            animation-play-state: running;
        }

        /* css loading */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        @keyframes stretch {
            0% {
                transform: scale(.3);
            }
            /* 25% {
                transform: scale(.6);
            }
            50% {
                transform: scale(.9);
            }
            75% {
                transform: scale(1.2);
            } */
            100% {
                transform: scale(1.5);
            }
        }
    </style>
</head>

<body class="sticky-header">
    {{-- <a href="index.html#wrapper" data-type="section-switch" class="scrollup">
        <i class="icofont-bubble-up"></i>
    </a> --}}
    <a href="https://t.me/siapsapa" style="position: fixed; bottom:0px; right:0px; z-index:999;">
        <img src="{{ asset('berkas/cs.jpeg') }}" alt="customer service" class="img-fluid" style="border-radius:100%; height:100px">
    </a>
    <!-- Preloader Start Here -->
    {{-- <div id="preloader"></div> --}}
    <!-- Preloader End Here -->

    <div class="loading-overlay" id="loading">
        <div class="loading">
            <img src="{{ asset('images/logosiap.png') }}" alt="siapsapa">
        </div>
    </div>
    <div id="wrapper" class="wrapper overflow-hidden">
        <header class="header">
            <div id="rt-sticky-placeholder"></div>
            <div id="header-menu" class="header-menu menu-layout1">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="temp-logo">
                                <a href="https://radiustheme.com/demo/html/cirkle/index.html"><img src="{{ asset('images/logos.png') }}" style="height: 70px" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7 col-sm-7 col-8 d-flex justify-content-xl-start justify-content-center">
                            <div class="mobile-nav-item hide-on-desktop-menu">
                                <div class="mobile-toggler">
                                    <button type="button" class="mobile-menu-toggle">
                                        <i class="icofont-navigation-menu"></i>
                                    </button>
                                </div>
                                <div class="mobile-logo">
                                    <span class="text-white font-bold" style="font-size: 18pt">SIAPSAPA</span>
                                </div>
                            </div>
                            <nav id="dropdown" class="template-main-menu">
                                <button type="button" class="mobile-menu-toggle mobile-toggle-close">
                                    <i class="icofont-close"></i>
                                </button>
                                <ul class="menu-content">
                                    @include('layouts.landingpage.menu')
                                </ul>
                            </nav>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-sm-5 col-4 d-flex justify-content-end">
                            <div class="header-action">
                                <ul>
                                    <li class="header-social">
                                        <a href="index.html#"><i class="icofont-facebook"></i></a>
                                        <a href="index.html#"><i class="icofont-twitter"></i></a>
                                        <a href="index.html#"><i class="icofont-linkedin"></i></a>
                                        <a href="index.html#"><i class="icofont-pinterest"></i></a>
                                        <a href="index.html#"><i class="icofont-skype"></i></a>
                                    </li>
                                    <li class="header-search-icon">
                                        <a href="index.html#header-search" title="Search"><i class="icofont-qr-code"></i></a>
                                    </li>
                                    @if (Auth::check())
                                    <li class="login-btn">
                                        <a href="{{ route('logout') }}" class="item-btn"><i class="fas fa-user"></i>Logout</a>
                                    </li>
                                    @else
                                    <li class="login-btn">
                                        <a href="{{ route('login') }}" class="item-btn"><i class="fas fa-user"></i>Login</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
        <!--=====================================-->
        <!--=        Footer Area Start       	=-->
        <!--=====================================-->
        <footer class="footer-wrap">
            <ul class="footer-top-image">
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="400"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_5.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="500"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_6.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="300"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_4.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="600"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_7.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="200"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_3.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="700"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_8.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="100"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_2.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500" data-sal-delay="800"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_9.png" alt="Man"></li>
                <li data-sal="slide-up" data-sal-duration="500"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/man_1.png" alt="Man"></li>
            </ul>
            <div class="main-footer">
                <div class="container">
                    <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
                        <div class="col">
                            <div class="footer-box">
                                <div class="footer-logo">
                                    <a href="https://radiustheme.com/demo/html/cirkle/index.html"><img src="{{ asset('images/logosiap.png') }}" alt="SIAPSAPA" style="width: 200px"></a>
                                </div>
                                <p>Gerakan Pramuka Wadah Utama Pembentukan Kader Pemimpin Bangsa.</p>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-lg-center">
                            <div class="footer-box">
                                <h3 class="footer-title">
                                    Menu
                                </h3>
                                <div class="footer-link">
                                    <ul>
                                        <li><a href="https://radiustheme.com/https://radiustheme.com/demo/html/cirkle/media/logo_dark.pngdemo/html/cirkle/index.html">Beranda</a></li>
                                        <li><a href="https://radiustheme.com/demo/html/cirkle/about-us.html">Statistik</a></li>
                                        <li><a href="https://radiustheme.com/demo/html/cirkle/about-us.html">Artikel</a></li>
                                        <li><a href="https://radiustheme.com/demo/html/cirkle/about-us.html">Penggumuman</a></li>
                                        <li><a href="https://radiustheme.com/demo/html/cirkle/shop.html">Kontak Kami</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-lg-center">
                            <div class="footer-box">
                                <h3 class="footer-title">
                                    Followers
                                </h3>
                                <div class="footer-link">
                                    <ul>
                                        <li><a href="https://www.facebook.com/">facebook</a></li>
                                        <li><a href="https://twitter.com/">twitter</a></li>
                                        <li><a href="https://www.instagram.com/">instagram</a></li>
                                        <li><a href="https://www.youtube.com/">Youtube</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-lg-center">
                            <div class="footer-box">
                                <h3 class="footer-title">
                                    Download Apps
                                </h3>
                                <a href="#" class="border border-primary px-3 py-2 rounded my-2">
                                    <div class="d-flex" style="gap: 20px">
                                        <div style="font-size: 30pt">
                                            <i class="icofont-brand-android-robot"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            Google Play
                                            <span>Coming Soon</span>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="border border-primary px-3 py-2 rounded my-2">
                                    <div class="d-flex" style="gap: 20px">
                                        <div style="font-size: 30pt">
                                            <i class="icofont-brand-apple"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            App Store
                                            <span>Coming Soon</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-copyright">Copy© siapsapa 2021. All Rights Reserved</div>
            </div>
        </footer>



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
    <script src="{{ asset('social') }}/dependencies/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/select2/js/select2.min.js"></script>
    <script src="{{ asset('social') }}/dependencies/elevate-zoom/jquery.elevatezoom.js"></script>
    <script src="{{ asset('social') }}/dependencies/bootstrap-validator/js/validator.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    {{-- <script src="{{ asset('dashboard') }}/dist/js/pages/datatable/custom-datatable.js"></script> --}}
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- Site Scripts -->
    <script src="{{ asset('social') }}/assets/js/app.js"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    @yield('script')
</body>

</html>
