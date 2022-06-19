@extends('layouts.user')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="height:500px; background:linear-gradient(rgba(184, 89, 34, 0),rgba(128, 28, 28, 0.514)),url('{{ asset('user/img/ban1.png') }}') no-repeat; background-size:cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="text-white">Pramuka Indonesia</h2>
                        <p>Kepramukaan memberikan kesempatan kepada kaum muda untuk berpartisipasi dalam program, acara, kegiatan, dan proyek yang berkontribusi pada pertumbuhan mereka sebagai warga negara yang aktif. Melalui inisiatif ini, kaum muda menjadi agen perubahan positif yang menginspirasi orang lain untuk mengambil tindakan.</p>
                    </div>
                </div>
                <div class="carousel-item" style="height:500px; background:linear-gradient(rgba(184, 89, 34, 0),rgba(128, 28, 28, 0.514)),url('{{ asset('user/img/ban2.png') }}') no-repeat; background-size:cover;">
                    <div class="carousel-caption d-none d-md-block">
                    <p>Pramuka menciptakan dunia yang lebih baik untuk komunitas mereka melalui Program Kepanduan Kepramukaan.</p>
                    </div>
                </div>
                <div class="carousel-item" style="height:500px; background:linear-gradient(rgba(184, 89, 34, 0),rgba(128, 28, 28, 0.514)),url('{{ asset('user/img/ban3.jpg') }}') no-repeat; background-size:cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <p>Bagian penting dari Kepramukaan adalah bertemu dan berinteraksi dengan orang-orang muda dari seluruh wilayah. Kepramukaan menyatukan Pramuka melalui acara Nasional, jangan lewatkan acara yang diadakan</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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
                        <h1 class="fs-2 text-primary mb-0" data-toggle="counter-up">{{ $data['siaga'] }}</h1>
                    </div>
                    <h5>Siaga</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0" data-toggle="counter-up">{{ $data['penggalang'] }}</h1>
                    </div>
                    <h5>Penggalang</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0" data-toggle="counter-up">{{ $data['penegak'] }}</h1>
                    </div>
                    <h5>Penegak</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0" data-toggle="counter-up">{{ $data['pandega'] }}</h1>
                    </div>
                    <h5>Pandega</h5>
                </div>
                <div class="col-6 col-md-6 col-lg wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                            <i class="fa fa-user fa-2x text-primary"></i>
                        </div>
                        <h1 class="fs-2 text-primary mb-0" data-toggle="counter-up">{{ $data['dewasa'] }}</h1>
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
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">{{ $data['total'] }}</h2>
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
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">542</h2>
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
    {{-- <div class="container-xxl py-5">
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
    </div> --}}
    <!-- Service End -->
@endsection
