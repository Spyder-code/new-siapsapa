<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SIAPSAPA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="siapsapa, pramuka indonesia, kwartir pramuka" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logosiap.png') }}" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('user') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('user') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user') }}/css/style.css" rel="stylesheet">

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
    @yield('style')
</head>

<body>
    <!-- Spinner Start -->
    <div class="loading-overlay" id="loading">
        <div class="loading">
            <img src="{{ asset('images/logosiap.png') }}" alt="siapsapa">
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>Indonesia</small>
                </div>
                {{-- <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>{{ date('d M Y') }}</small>
                </div> --}}
            </div>
            {{-- <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+012 345 6789</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="{{ asset('images/logosiap.png') }}" alt="siapsapa" style="width: 70px; height:60px">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link">Beranda</a>
                <a href="{{ route('page.agenda') }}" class="nav-item nav-link">Agenda</a>
                <a href="#" class="nav-item nav-link">Berita</a>
                <a href="#" class="nav-item nav-link">Penggumuman</a>
                <a href="#" class="nav-item nav-link">Tentang Kami</a>
                <a href="#" class="nav-item nav-link">Scan QR <i class="fas fa-qrcode"></i></a>
                <a href="#" class="nav-item nav-link">Produk</a>
                @if (Auth::check())
                <a href="{{ route('page.profile') }}" class="nav-item nav-link">Profile</a>
                @endif
                <a href="{{ Auth::check()?route('logout'):route('login') }}" class="nav-item nav-link">{{ Auth::check()?'Logout':'Member Area' }} <i class="fas {{ Auth::check()?'fa-sign-out-alt':'fa-arrow-right' }}"></i></a>
                {{-- <a href="service.html" class="nav-item nav-link">Service</a>
                <a href="project.html" class="nav-item nav-link">Project</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="feature.html" class="dropdown-item">Feature</a>
                        <a href="quote.html" class="dropdown-item">Free Quote</a>
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a> --}}
            </div>
            {{-- <a href="{{ Auth::check()?route('logout'):route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">{{ Auth::check()?'Logout':'Member' }}<i class="fas {{ Auth::check()?'fa-sign-out-alt':'fa-arrow-right' }} ms-3"></i></a> --}}
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8 col-md-6">
                    <h4 class="text-light mb-4">SIAPSAPA</h4>
                    <p class="mb-2">Satuan organisasi yang mengelola Gerakan Pramuka tingkat nasional.</p>
                    <p>”Gerakan Pramuka Wadah Utama Pembentukan Kader Pemimpin Bangsa"</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('images/logos.png') }}" alt="siapsapa" style="width: 220px; height:200px">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">siapsapa.id</a>, All Right Reserved.
                    </div>
                    {{-- <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('user') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('user') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('user') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('user') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('user') }}/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="{{ asset('user') }}/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user') }}/js/main.js"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <script>
        (function() {
            "use strict";
            window.addEventListener(
                "load",
                function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName("needs-validation");
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(
                        forms,
                        function(form) {
                            form.addEventListener(
                                "submit",
                                function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add("was-validated");
                                },
                                false
                            );
                        }
                    );
                },
                false
            );
        })();
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    @yield('script')
</body>

</html>
