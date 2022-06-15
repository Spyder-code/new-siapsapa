<!DOCTYPE html>
<html dir="ltr" lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, monster admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, "
    />
    <meta name="description" content="Monster is powerful and clean admin dashboard template, inpired from Google's Material Design" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Dashboard Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logosiap.png') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('dashboard') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/dist/css/style.min.css" rel="stylesheet" />
    {{-- laravel token meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
                stroke="#009efb"
                stroke-width="2">
            </path>
            <path
                d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
                stroke="#009efb"
                stroke-width="2">
            </path>
            <path
                id="teabag"
                fill="#009efb"
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z">
            </path>
            <path
                id="steamL"
                d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke="#009efb">
            </path>
            <path
                id="steamR"
                d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13"
                stroke="#009efb"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
            </path>
        </svg>
    </div>

    <div class="loading-overlay" id="loading">
        <div class="loading">
            <img src="{{ asset('images/logosiap.png') }}" alt="siapsapa">
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-lg navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="/">
                        <!-- Logo icon -->
                        {{-- <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('dashboard/assets/images/sipap_logo.png') }}" alt="homepage" class="dark-logo"/>
                            <!-- Light Logo icon -->
                            <img src="{{ asset('dashboard/assets/images/sipap_logo.png') }}" alt="homepage" class="light-logo" />
                        </b> --}}
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="#" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="#" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="icon-arrow-left-circle"></i></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <div class="notify">
                                    <span class="heartbit"></span> <span class="point"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-start mailbox dropdown-menu-animate-up">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <div class="mb-0 font-weight-medium fs-4">
                                                Notifications
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications position-relative" style="height: 230px">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class=" message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-light-danger text-danger btn-circle">
                                                    <i data-feather="link" class="feather-sm fill-white"></i>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Luanch Admin</h5>
                                                    <span class=" fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">Just see the my new admin!</span>
                                                    <span class=" fs-2 text-nowrap d-block subtext text-muted">9:30 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);">
                                            <strong>Check all notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope"></i>
                                <div class="notify">
                                    <span class="heartbit"></span> <span class="point"></span>
                                </div>
                            </a>
                            <div class=" dropdown-menu mailbox dropdown-menu-start dropdown-menu-animate-up" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <div class="mb-0 font-weight-medium fs-4">
                                                You have 4 new messages
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);">
                                            <b>See all e-Mails</b> <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box d-none d-md-block">
                            <form class="app-search mt-3 me-2">
                                <input type="text" class="form-control rounded-pill border-0" placeholder="Search for..."/>
                                <a class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('dashboard') }}/assets/images/users/5.jpg" alt="user" width="30" class="profile-pic rounded-circle"/>
                            </a>
                            <div class=" dropdown-menu dropdown-menu-end user-dd animated flipInY">
                                <div class=" d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                                    <div class="">
                                        <img src="{{ asset('dashboard') }}/assets/images/users/5.jpg" alt="user" class="rounded-circle" width="60" />
                                    </div>
                                    <div class="ms-2">
                                        <h4 class="mb-0 text-white">{{ Auth::user()->name }}</h4>
                                        <p class="mb-0">{{ Auth::user()->username }}</p>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="" >
                                    <i data-feather="settings" class="feather-sm text-warning me-1 ms-1" ></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="" onclick="return confirm('Apa anda ingin keluar?')">
                                    <i data-feather="log-out" class="feather-sm text-danger me-1 ms-1" ></i>
                                    Keluar
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('components.menu')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            @yield('breadcrumb')
        </div>

        <div class="container-fluid">
            <div class="my-2">
                {{-- session success --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Yey!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- boostrap 5 session danger --}}
                @if (session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            @yield('content')
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">All right reserved by Monster Admin.</footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    @include('components.menu_customize')
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('dashboard') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="{{ asset('dashboard') }}/dist/js/app.min.js"></script>
    <script src="{{ asset('dashboard') }}/dist/js/app.init.horizontal.js"></script>
    <script src="{{ asset('dashboard') }}/dist/js/app-style-switcher.horizontal.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('dashboard') }}/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('dashboard') }}/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('dashboard') }}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dashboard') }}/dist/js/feather.min.js"></script>
    <script src="{{ asset('dashboard') }}/dist/js/custom.min.js"></script>
    <!--This page plugins -->
    <script src="{{ asset('dashboard') }}/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('dashboard') }}/dist/js/pages/datatable/custom-datatable.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    {{-- <script src="{{ asset('dashboard') }}/dist/js/pages/datatable/datatable-advanced.init.js"></script> --}}
    <script>
        // window.ajax_loading = false;
        // $.hasAjaxRunning = function() {
        //     return window.ajax_loading;
        // };
        // $(document).ajaxStart(function(){
        //     window.ajax_loading = true;
        //     $('#loading').show();
        // }).ajaxStop(function(){
        //     window.ajax_loading = false;
        //     $('#loading').hide();
        // });
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
