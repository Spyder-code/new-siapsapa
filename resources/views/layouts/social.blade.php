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
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logosiap_mini.png') }}">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/icofont/icofont.min.css">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/slick-carousel/css/slick.css">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/slick-carousel/css/slick-theme.css">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/magnific-popup/css/magnific-popup.css">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/sal.js/sal.css">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/mcustomscrollbar/jquery.mCustomScrollbar.min.css">
   <link rel="stylesheet" href="{{ asset('social') }}/dependencies/select2/css/select2.min.css">

   <!-- Site Stylesheet -->
   <link rel="stylesheet" href="{{ asset('social') }}/assets/css/app.css">
   <!-- Google Web Fonts -->
   <link
      href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,400&display=swap"
      rel="stylesheet">

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

        .count-react{
            top: -0.5rem;
            color: gray;
            font-weight: bold;
            font-size: .9rem;
            margin-left: 5px;
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
   @yield('custom-head')
   @yield('style')
</head>

<body class="bg-link-water">
    <a href="https://t.me/siapsapa" style="position: fixed; bottom:0px; right:0px; z-index:999; ">
        <img src="{{ asset('berkas/chat.png') }}" alt="customer service" class="img-fluid blink" style="border-radius:100%; height:70px; margin: 10px">
    </a>
   <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
   {{-- <a href="#wrapper" data-type="section-switch" class="scrollup">
      <i class="icofont-bubble-up"></i>
   </a> --}}
   <!-- Preloader Start Here -->
   <div class="loading-overlay" id="loading">
        <div class="loading">
            <img src="{{ asset('images/logosiap.png') }}" alt="siapsapa">
        </div>
    </div>
   {{-- <div id="preloader"></div> --}}
   <!-- Preloader End Here -->
   <div id="wrapper" class="wrapper">
      <!-- Top Header -->
      <header class="fixed-header">
         <div class="header-menu">
            <div class="navbar">
               <div class="nav-item d-none d-sm-block">
                  <div class="header-logo">
                     <a href="{{ route('social.home') }}"><img src="{{ asset('images/logo.png') }}" alt="Cirkle"></a>
                  </div>
               </div>
               <div class="nav-item nav-top-menu">
                  <nav id="dropdown" class="template-main-menu">
                     <ul class="menu-content">
                        <li class="header-nav-item">
                           <a href="{{ route('social.home') }}" class="menu-link">Home</a>
                        </li>
                        <li class="header-nav-item">
                           <a href="{{ route('social.userFeed',Auth::user()->anggota->id) }}"
                              class="menu-link">Profile</a>
                        </li>
                        <li class="header-nav-item">
                           <a href="#" class="menu-link have-sub">Halaman</a>
                           <ul class="sub-menu">
                              <li>
                                 <a href="{{ url('/') }}">Global Area</a>
                              </li>
                              @if (Auth::user()->role != 'anggota')
                              <li>
                                <a href="{{ route('statistik.index') }}">Admin Area</a>
                             </li>
                              @endif
                           </ul>
                        </li>
                     </ul>
                  </nav>
               </div>
               <div class="nav-item header-control">
                  <div class="inline-item d-none d-md-block">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search here.......">
                        <div class="input-group-append">
                           <button class="submit-btn" type="button"><i class="icofont-search"></i></button>
                        </div>
                     </div>
                  </div>
                  <div class="inline-item d-flex align-items-center">
                     {{-- @include('layouts.social-component.cart')
                            @include('layouts.social-component.friend')
                            @include('layouts.social-component.message')
                            @include('layouts.social-component.notification') --}}
                        @include('layouts.social-component.header.cart')
                        <a href="#" title="Search"><i class="icofont-qr-code text-white"></i></a>
                  </div>
                  <div class="inline-item">
                     <div class="dropdown dropdown-admin">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                           <span class="media">
                              <span class="item-img">
                                 <img src="{{ asset('berkas/anggota/'.Auth::user()->anggota->foto) }}" alt="Chat" style="height: 44px; width:44px;">
                                 @if (Auth::user()->anggota->cetak)
                                       @if (Auth::user()->anggota->cetak->transactionDetail->payment_status < 4 )
                                          <span class="acc-verified"><i class="icofont-check"></i></span>
                                       @endif
                                 @endif
                              </span>
                              <span class="media-body">
                                 <span class="item-title">{{ Auth::user()->name }}</span>
                              </span>
                           </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                           <ul class="admin-options">
                              <li><a href="{{ route('social.profile') }}">Profile</a></li>
                              @if (Auth::user()->role!='anggota')
                              <li><a href="{{ route('statistik.index') }}">Admin Area</a></li>
                              @endif
                              <li><a href="{{ url('/') }}">Global Area</a></li>
                              <li><a href="{{ route('social.transaction') }}">Pesanan Saya</a></li>
                              <li><a href="{{ route('logout') }}">Log Out</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- Sidebar Left -->
      <div class="fixed-sidebar">
         <div class="fixed-sidebar-left small-sidebar">
            <div class="sidebar-toggle">
               <button class="toggle-btn toggler-open">
                  <span></span>
                  <span></span>
                  <span></span>
               </button>
            </div>
            <div class="sidebar-menu-wrap">
               <div class="mCustomScrollbar" data-mcs-theme="dark" data-mcs-axis="y">
                  <ul class="side-menu">
                     <li><a href="{{ route('social.news') }}" class="menu-link" data-toggle="tooltip"
                           data-placement="right" title="BERITA"><i class="icofont-newspaper"></i></a></li>
                     <li><a href="{{ route('social.event') }}" class="menu-link" data-toggle="tooltip"
                           data-placement="right" title="AGENDA"><i class="icofont-list"></i></a></li>
                     <li><a href="{{ route('social.announcement') }}" class="menu-link" data-toggle="tooltip"
                           data-placement="right" title="PENGGUMUMAN"><i class="icofont-users-alt-2"></i></a></li>
                     {{-- <li><a href="user-friends.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="MEMBERS FRIENDS"><i class="icofont-users-alt-4"></i></a></li> --}}
                     <li><a href="{{ route('social.photo') }}" class="menu-link" data-toggle="tooltip"
                           data-placement="right" title="FOTO"><i class="icofont-photobucket"></i></a></li>
                     <li><a href="{{ route('social.video') }}" class="menu-link" data-toggle="tooltip"
                           data-placement="right" title="VIDEOS"><i class="icofont-play-alt-1"></i></a></li>
                     {{-- <li><a href="#" class="menu-link" data-toggle="tooltip" data-placement="right" title="EVENT SCHEDULE"><i class="icofont-calendar"></i></a></li> --}}
                     {{-- <li><a href="forums-timeline.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="FORUM"><i class="icofont-ui-text-chat"></i></a></li> --}}
                     <li><a href="{{ route('social.shop') }}" class="menu-link" data-toggle="tooltip"
                           data-placement="right" title="SHOP"><i class="icofont-shopping-cart"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="fixed-sidebar-left large-sidebar">
            <div class="sidebar-toggle">
               <div class="sidebar-logo">
                  <a href="{{ route('social.home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
               </div>
               <button class="toggle-btn toggler-close">
                  <span></span>
                  <span></span>
                  <span></span>
               </button>
            </div>
            <div class="sidebar-menu-wrap">
               <div class="mCustomScrollbar" data-mcs-theme="dark" data-mcs-axis="y">
                  <ul class="side-menu">
                     <li><a href="{{ route('social.news') }}" class="menu-link"><i class="icofont-newspaper"></i><span
                              class="menu-title">Berita</span></a></li>
                     <li><a href="{{ route('social.event') }}" class="menu-link"><i class="icofont-list"></i><span
                              class="menu-title">Agenda</span></a></li>
                     <li><a href="{{ route('social.announcement') }}" class="menu-link"><i class="icofont-users-alt-2"></i><span
                              class="menu-title">Penggumuman</span></a></li>
                     {{-- <li><a href="user-friends.html" class="menu-link"><i class="icofont-users-alt-4"></i><span class="menu-title">Members Friends</span></a></li> --}}
                     <li><a href="{{ route('social.photo') }}" class="menu-link"><i class="icofont-photobucket"></i><span
                              class="menu-title">Gallery</span></a></li>
                     <li><a href="{{ route('social.video') }}" class="menu-link"><i class="icofont-play-alt-1"></i><span
                              class="menu-title">Videos</span></a></li>
                     {{-- <li><a href="#" class="menu-link"><i class="icofont-calendar"></i><span class="menu-title">Event Schedule</span></a></li> --}}
                     {{-- <li><a href="forums-timeline.html" class="menu-link"><i class="icofont-ui-text-chat"></i><span class="menu-title">Forum</span></a></li> --}}
                     <li><a href="{{ route('social.shop') }}" class="menu-link"><i class="icofont-shopping-cart"></i><span
                              class="menu-title">Shop</span></a></li>
                  </ul>
                  <ul class="top-menu-mobile">
                     <li class="menu-label">Halaman</li>
                     <li>
                        <a href="{{ url('/') }}" class="menu-link">Global Area</a>
                     </li>
                     @if (Auth::user()->role!='anggota')
                     <li>
                        <a href="{{ route('statistik.index') }}" class="menu-link">Admin Area</a>
                     </li>
                     @endif
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- Sidebar Right -->
      {{-- <div class="fixed-sidebar right">
            <div class="fixed-sidebar-right small-sidebar">
                <div class="sidebar-toggle" id="chat-head-toggle">
                    <button class="chat-icon">
                        <i class="icofont-speech-comments"></i>
                    </button>
                </div>
                <div class="sidebar-menu-wrap">
                    <div class="mCustomScrollbar" data-mcs-theme="dark" data-mcs-axis="y">
                        <ul class="user-chat-list">
                            <li class="chat-item chat-open">
                                <div class="author-img">
                                    <img src="{{ asset('social') }}/media/figure/chat_1.jpg" alt="chat">
      <span class="chat-status offline"></span>
   </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_2.jpg" alt="chat">
         <span class="chat-status offline"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_3.jpg" alt="chat">
         <span class="chat-status offline"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_4.jpg" alt="chat">
         <span class="chat-status online"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_5.jpg" alt="chat">
         <span class="chat-status online"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_6.jpg" alt="chat">
         <span class="chat-status online"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_7.jpg" alt="chat">
         <span class="chat-status offline"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_8.jpg" alt="chat">
         <span class="chat-status offline"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_9.jpg" alt="chat">
         <span class="chat-status offline"></span>
      </div>
   </li>
   <li class="chat-item chat-open">
      <div class="author-img">
         <img src="{{ asset('social') }}/media/figure/chat_10.jpg" alt="chat">
         <span class="chat-status offline"></span>
      </div>
   </li>
   </ul>
   </div>
   </div>
   </div>
   </div> --}}
   <!-- Page Content -->
   <div class="page-content">

      <!--=====================================-->
      <!--=        Newsfeed  Area Start       =-->
      <!--=====================================-->
      <div class="container">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        {{-- boostrap 5 session danger --}}
        @if (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
        @endif
         @yield('content')
      </div>
      <!--=====================================-->
      <!--=        Footer Area Start       	=-->
      <!--=====================================-->



   </div>
   <footer class="footer-wrap footer-dashboard">
    <div class="main-footer">
       <div class="container">
          <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
             <div class="col">
                <div class="footer-box">
                   <div class="footer-logo">
                      <a href="#"><img
                            src="{{ asset('images/logosiap.png') }}" alt="SIAPSAPA" style="width: 200px"></a>
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
                         <li><a
                               href="{{ url('/') }}">Beranda</a>
                         </li>
                         <li><a href="{{ route('page.statistik') }}">Statistik</a></li>
                         <li><a href="#">Artikel</a></li>
                         <li><a href="#">Penggumuman</a></li>
                         <li><a href="#">Kontak Kami</a></li>
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
   <!-- Chat Modal Here -->
   <div class="chat-conversion-box" id="chat-box-modal" tabindex="-1" aria-labelledby="chat-modal-label"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h6 class="modal-title" id="chat-modal-label">Fahim Rahman <span class="online"></span></h6>
               <div class="action-icon">
                  <button class="chat-shrink"><i class="icofont-minus"></i></button>
                  <button type="button" class="close chat-close chat-open" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            </div>
            <div class="modal-body">
               <ul class="chat-conversion">
                  <li class="chat-others">
                     <div class="author-img">
                        <img src="{{ asset('social') }}/media/figure/chat_12.jpg" alt="Chat">
                     </div>
                     <div class="author-text">
                        <span>How are you Fahim vai ? Tommorow office will be your last day of Bachelor life.</span>
                     </div>
                  </li>
                  <li class="chat-you">
                     <div class="author-img">
                        <img src="{{ asset('social') }}/media/figure/chat_11.jpg" alt="Chat">
                     </div>
                     <div class="author-text">
                        <span>hmm That's great</span>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="modal-footer">
               <form>
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Write your text here.....">
                     <div class="chat-plus-icon"><i class="icofont-plus-circle"></i></div>
                     <div class="file-attach-icon">
                        <a href="#"><i class="icofont-slightly-smile"></i></a>
                        <a href="#"><i class="icofont-camera"></i></a>
                        <a href="#"><i class="icofont-image"></i></a>
                        <a href="#"><i class="icofont-mic"></i></a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
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
   <script defer src="https://unpkg.com/alpinejs@3.10.4/dist/cdn.min.js"></script>
   <!-- Site Scripts -->
   <script src="{{ asset('social') }}/assets/js/app.js"></script>
   <script src="{{ asset('js/site.js') }}"></script>
   @yield('script')
   @stack('scripts')
   <script>
    $('.image-link').magnificPopup({
        type:'image',
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
            // openerElement is the element on which popup was initialized, in this case its <a> tag
            // you don't need to add "opener" option if this code matches your needs, it's defailt one.
            return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
   </script>
</body>

</html>
