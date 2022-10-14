@extends('layouts.newuser')
@section('content')
    <!--=====================================-->
        <!--=          Header Menu Start       	=-->
        <!--=====================================-->

        <!--=====================================-->
        <!--=          Banner Start       		=-->
        <!--=====================================-->
        <section class="hero-banner">
            <div class="container">
                <div class="hero-content" data-sal="zoom-out" data-sal-duration="1000">
                    <h1 class="item-title">Pramuka Indonesia</h1>
                    <p>Pramuka isection-herotu tangguh, menjadi teladan, tangguh menghadapi setiap tantangan, menggalang kepedulian kepada sesama, bersedia berkorban, suka menolong dan selalu semangat pantang menyerah</p>
                    <div class="item-number" data-sal="counter-up">{{ number_format($data['total']) }}</div>
                    <div class="conn-people">Anggota Pramuka</div>
                    <a href="{{ route('login') }}" class="button-slide">
                        <span class="btn-text">Daftar Anggota</span>
                        <span class="btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
            <div class="leftside-image">
                <div class="cartoon-image" data-sal="slide-down" data-sal-duration="1000" data-sal-delay="100">
                    <img src="https://radiustheme.com/demo/html/cirkle/media/banner/people_1.png" alt="People">
                </div>
                <div class="shape-image" data-sal="slide-down" data-sal-duration="500" data-sal-delay="700">
                    <img src="https://radiustheme.com/demo/html/cirkle/media/banner/shape_1.png" alt="shape">
                </div>
            </div>
            <div class="map-line">
                <img src="https://radiustheme.com/demo/html/cirkle/media/banner/map_line.png" alt="map" data-sal="slide-up" data-sal-duration="500" data-sal-delay="800">
                <ul class="map-marker">
                    <li data-sal="slide-up" data-sal-duration="700" data-sal-delay="1000"><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_1.png" alt="marker"></li>
                    <li data-sal="slide-up" data-sal-duration="800" data-sal-delay="1000"><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_2.png" alt="marker"></li>
                    <li data-sal="slide-up" data-sal-duration="900" data-sal-delay="1000"><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_3.png" alt="marker"></li>
                    <li data-sal="slide-up" data-sal-duration="1000" data-sal-delay="1000"><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_4.png" alt="marker"></li>
                </ul>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Why Choose Start       	=-->
        <!--=====================================-->
        <section class="why-choose-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="why-choose-box">
                            <div class="item-subtitle">SIAPSAPA</div>
                            <h2 class="item-title"><span>Gabung Jadi Anggota</span> Dapatkan Kartu Anggota Dan Keseruan Lainya</h2>
                            <p>Dengan bergabung jadi anggota anda akan dapat kartu anggota dan dapat menggunakan fitur-fitur siapsapa lainya.</p>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <img src="{{ asset('berkas/kta/belakang.png') }}" alt="KTA" class="img-fluid" style="height:200px;">
                                    <a href="{{ route('login') }}" class="button-slide mt-2">
                                        <span class="btn-text">Daftar Anggota</span>
                                        <span class="btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="why-choose-box">
                            <ul class="features-list">
                                <li>
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="icofont-wechat"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="item-title">Bertemu Orang-Orang Hebat</h3>
                                            <p>Bertemu dan berinteraksi dengan orang-orang hebat dari seluruh wilayah.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="icofont-users"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="item-title">Forum Diskusi</h3>
                                            <p>Sharing informasi dan diskusi dengan banyak orang di berbagai wilayah.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="icofont-paper"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="item-title">Buat Karya</h3>
                                            <p>Buat karya terbaik kemudian publish karya dan dapat apresiasi</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Community Start       	=-->
        <!--=====================================-->
        <section class="community-network">
            <ul class="map-marker">
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_1.png" alt="marker"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_2.png" alt="marker"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_3.png" alt="marker"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_4.png" alt="marker"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/banner/marker_5.png" alt="marker"></li>
            </ul>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6">
                        <div class="community-content">
                            <h2 class="item-title">345 Kwartir telah bergabung di <span>SIAPSAPA</span></h2>
                            <p>Pramuka menciptakan dunia yang lebih baik untuk komunitas melalui Sistem Informasi Kepanduan Kepramukaan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-shape" data-sal="slide-left" data-sal-duration="500" data-sal-delay="500">
                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_7.png" alt="bg">
            </div>
        </section>
        <!--=====================================-->
        <!--=         Team Area  Start       	=-->
        <!--=====================================-->
        <section class="section team-circle">
            <div class="container position-relative">
                <div class="section-heading">
                    <h2 class="item-title">Anggota Aktif Siapsapa</h2>
                    <p>Menuju perubahan positif yang menginspirasi orang lain untuk mengambil tindakan.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-11">
                        <div class="row no-gutters">
                            <div class="col-lg-4 col-sm-6">
                                <ul class="nav nav-tabs nav-tabs-left" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="{{ route('social.userFeed',$anggota[0]->anggota->id) }}" role="tab" aria-selected="true">
                                            <img src="{{  asset('berkas/anggota/'.$anggota[0]->anggota->foto) }}" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="{{ route('social.userFeed',$anggota[1]->anggota->id) }}" role="tab" aria-selected="false">
                                            <img src="{{  asset('berkas/anggota/'.$anggota[1]->anggota->foto) }}" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="{{ route('social.userFeed',$anggota[2]->anggota->id) }}" role="tab" aria-selected="false">
                                            <img src="{{  asset('berkas/anggota/'.$anggota[2]->anggota->foto) }}" alt="team">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4 col-sm-6 order-lg-3">
                                <ul class="nav nav-tabs nav-tabs-right" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="{{ route('social.userFeed',$anggota[3]->anggota->id) }}" role="tab" aria-selected="false">
                                            <img src="{{  asset('berkas/anggota/'.$anggota[3]->anggota->foto) }}" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="{{ route('social.userFeed',$anggota[4]->anggota->id) }}" role="tab" aria-selected="false">
                                            <img src="{{  asset('berkas/anggota/'.$anggota[4]->anggota->foto) }}" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="{{ route('social.userFeed',$anggota[5]->anggota->id) }}" role="tab" aria-selected="false">
                                            <img src="{{  asset('berkas/anggota/'.$anggota[5]->anggota->foto) }}" alt="team">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4 order-lg-2">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="team1" role="tabpanel">
                                        <div class="team-box">
                                            <div class="item-img">
                                                <img src="{{ asset('berkas/anggota/'.$anggota[0]->anggota->foto) }}" alt="{{ $anggota[0]->anggota->name }}">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title"><a href="{{ route('social.userFeed',$anggota[0]->anggota->id) }}">{{ $anggota[0]->anggota->name }}</a></h3>
                                                <div class="group-count"><span></span> - ADMIN {{ strtoupper($anggota[0]->role) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="shape-wrap">
                            <li><img src="{{ asset('social') }}/media/figure/shape_9.png" alt="shape"></li>
                            <li><img src="{{ asset('social') }}/media/team/shape_1.png" alt="shape"></li>
                            <li><img src="{{ asset('social') }}/media/team/shape_2.png" alt="shape"></li>
                            <li><img src="{{ asset('social') }}/media/team/shape_circle_1.png" alt="shape"></li>
                            <li><img src="{{ asset('social') }}/media/team/shape_circle_2.png" alt="shape"></li>
                            <li><img src="{{ asset('social') }}/media/team/shape_circle_3.png" alt="shape"></li>
                            <li><img src="{{ asset('social') }}/media/team/shape_3.png" alt="shape"></li>
                            <li><img src="{{ asset('social') }}/media/team/shape_4.png" alt="shape"></li>
                        </ul>
                    </div>
                </div>
                <div class="see-all-btn">
                    <a href="{{ route('login') }}" class="button-slide">
                        <span class="btn-text">Lihat Semua Anggota</span>
                        <span class="btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </section>
        <!--=         Banner Apps  Start       	=-->
        <!--=====================================-->
        <section class="banner-apps">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="banner-content">
                            <h2 class="item-title">Download Aplikasi Mobile</h2>
                            <p>Akses lebih mudah dan dapatkan segala manfaatnya</p>
                            <a href="#" class="button-slide">
                                <span class="btn-text">Download Android</span>
                                <span class="btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                    </svg>
                                </span>
                            </a>
                            <a href="#" class="button-slide">
                                <span class="btn-text">Download IOS</span>
                                <span class="btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner-img">
                            <div class="apps-view">
                                <img src="{{ asset('images/apps.png') }}" alt="Apps">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Blog Area Start       	=-->
        <!--=====================================-->
        <section class="section blog-grid">
            <div class="container">
                <div class="section-heading flex-heading">
                    <div class="row">
                        <div class="col-lg-5">
                            <h2 class="heading-title">Informasi-informasi dan berita baru </h2>
                        </div>
                        <div class="col-lg-7">
                            <p>Dapatkan semua informasi-informasi diberbagai wilayah dan acara-acara yang dapat diikuti.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="blog-img">
                                <a href="#">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_1.jpg" alt="Blog">
                                </a>
                                <div class="blog-date"><i class="icofont-calendar"></i>24 Jun</div>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="#">Our 10 Steps to successful video for blogging & Challanging</a></h3>
                                <ul class="entry-meta">
                                    <li><i class="icofont-ui-user"></i>by <a href="#">Admin</a></li>
                                    <li><i class="icofont-tag"></i><a href="#">Social</a>, <a href="#">Live</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="blog-img">
                                <a href="#">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_2.jpg" alt="Blog">
                                </a>
                                <div class="blog-date"><i class="icofont-calendar"></i>22 Jun</div>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="#">Our 10 Steps to successful video for blogging & Challanging</a></h3>
                                <ul class="entry-meta">
                                    <li><i class="icofont-ui-user"></i>by <a href="#">Admin</a></li>
                                    <li><i class="icofont-tag"></i><a href="#">Social</a>, <a href="#">Live</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="blog-img">
                                <a href="#">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_3.jpg" alt="Blog">
                                </a>
                                <div class="blog-date"><i class="icofont-calendar"></i>20 Jun</div>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="#">Our 10 Steps to successful video for blogging & Challanging</a></h3>
                                <ul class="entry-meta">
                                    <li><i class="icofont-ui-user"></i>by <a href="#">Admin</a></li>
                                    <li><i class="icofont-tag"></i><a href="#">Social</a>, <a href="#">Live</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=          NewsLetter Start       		=-->
        <!--=====================================-->
        <section class="banner-newsletter">
            <ul class="section-cloud">
                <li><img src="{{ asset('social') }}/media/figure/cloud_1.png" alt="shape"></li>
                <li><img src="{{ asset('social') }}/media/figure/cloud_2.png" alt="shape"></li>
                <li><img src="{{ asset('social') }}/media/figure/cloud_2.png" alt="shape"></li>
                <li><img src="{{ asset('social') }}/media/figure/cloud_1.png" alt="shape"></li>
            </ul>
            <div class="container">
                <ul class="section-shape">
                    <li><img src="{{ asset('social') }}/media/figure/shape_1.png" alt="shape"></li>
                    <li><img src="{{ asset('social') }}/media/figure/shape_2.png" alt="shape"></li>
                    <li><img src="{{ asset('social') }}/media/figure/shape_3.png" alt="shape"></li>
                    <li><img src="{{ asset('social') }}/media/figure/shape_4.png" alt="shape"></li>
                    <li><img src="{{ asset('social') }}/media/figure/shape_5.png" alt="shape"></li>
                </ul>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="newsletter-box">
                            <h2 class="item-title">Dapatkan Berita dan Informasi Kami</h2>
                            <p>Tuliskan email anda untuk menjadi yang pertama mengetahui tentang pembaruan, fitur baru, dan banyak lagi</p>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter your e-mail">
                                <div class="input-group-append">
                                    <button class="button-slide" type="button">
                                        <span class="btn-text">Subscribe Now</span>
                                        <span class="btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                                <path fill-rule="evenodd" fill="#ffffff" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
