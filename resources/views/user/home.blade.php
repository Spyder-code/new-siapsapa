@extends('layouts.user')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('user/img/ban1.png') }}" alt="" style="max-height:700px">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 text-center">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">PRAMUKA</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Indonesia</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Kepramukaan memberikan kesempatan kepada kaum muda untuk berpartisipasi dalam program, acara, kegiatan, dan proyek yang berkontribusi pada pertumbuhan mereka sebagai warga negara yang aktif. Melalui inisiatif ini, kaum muda menjadi agen perubahan positif yang menginspirasi orang lain untuk mengambil tindakan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('user/img/ban2.png') }}" alt="" style="max-height:700px">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 text-center">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">PRAMUKA</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Kita</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Pramuka menciptakan dunia yang lebih baik untuk komunitas mereka melalui Program Pramuka Pramuka kami, Mari bergabung dengan mereka.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('user/img/ban3.jpg') }}" alt="" style="max-height:700px">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 text-center">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">PRAMUKA</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Saya</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Bagian penting dari Kepramukaan adalah bertemu dan berinteraksi dengan orang-orang muda dari seluruh wilayah. Kepanduan wilayah menyatukan Pramuka melalui acara nasional, selalu ikuti terus acaranya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0">01</h1>
                    </div>
                    <h5>Siaga</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0">02</h1>
                    </div>
                    <h5>Penggalang</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0">03</h1>
                    </div>
                    <h5>Penegak</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0">04</h1>
                    </div>
                    <h5>Pandega</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0">04</h1>
                    </div>
                    <h5>Dewasa</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->



    <!-- About Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('user/img/ban4.jpg') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="section-title text-start">
                            <h2 class="display-5 mb-4">SATYAKU KUDARMAKAN, DARMAKU KUBAKTIKAN</h2>
                        </div>
                        <p class="mb-4 pb-2">Pramuka itu tangguh, menjadi teladan, tangguh menghadapi setiap tantangan, menggalang kepedulian kepada sesama, bersedia berkorban, suka menolong dan selalu semangat pantang menyerah</p>
                        <div class="row g-4 mb-4 pb-2">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                                        <i class="fa fa-users fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">98000</h2>
                                        <p class="fw-medium mb-0">Anggota</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                                        <i class="fa fa-check fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">1234</h2>
                                        <p class="fw-medium mb-0">Pelatih</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Agenda</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('user') }}/img/service-1.jpg" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">General Carpentry</h4>
                            <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                            <a class="fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('user') }}/img/service-2.jpg" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Furniture Manufacturing</h4>
                            <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                            <a class="fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('user') }}/img/service-3.jpg" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Furniture Remodeling</h4>
                            <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                            <a class="fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('user') }}/img/service-4.jpg" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Wooden Floor</h4>
                            <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                            <a class="fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('user') }}/img/service-5.jpg" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Wooden Furniture</h4>
                            <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                            <a class="fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('user') }}/img/service-6.jpg" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Custom Work</h4>
                            <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                            <a class="fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
