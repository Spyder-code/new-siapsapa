@extends('layouts.newuser')
@section('content')
    <!--=====================================-->
        <!--=          Header Menu Start       	=-->
        <!--=====================================-->
        <header class="header">
            <div id="rt-sticky-placeholder"></div>
            <div id="header-menu" class="header-menu menu-layout1">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="temp-logo">
                                <a href="https://radiustheme.com/demo/html/cirkle/index.html"><img src="https://radiustheme.com/demo/html/cirkle/media/logo.png" alt="Logo"></a>
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
                                    <a href="https://radiustheme.com/demo/html/cirkle/index.html">
                                        <img src="https://radiustheme.com/demo/html/cirkle/media/mobile_logo.png" alt="Logo">
                                    </a>
                                </div>
                            </div>
                            <nav id="dropdown" class="template-main-menu">
                                <button type="button" class="mobile-menu-toggle mobile-toggle-close">
                                    <i class="icofont-close"></i>
                                </button>
                                <ul class="menu-content">
                                    <li class="header-nav-item">
                                        <a href="https://radiustheme.com/demo/html/cirkle/index.html" class="menu-link active">Home</a>
                                    </li>
                                    <li class="hide-on-mobile-menu">
                                        <a href="index.html#" class="menu-link have-sub">Community</a>
                                        <ul class="mega-menu mega-menu-col-2">
                                            <li>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/newsfeed.html">NewsFeed</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Profile Timeline</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/user-about.html">Profile About</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">Profile Friends</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/user-groups.html">Profile Group</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/user-photo.html">Profile Photo</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/user-video.html">Profile Video</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/user-badges.html">Profile Badges</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/forums.html">Forums</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/forums-forum.html">Forums Topic</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/forums-timeline.html">Forums Timeline</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/forums-info.html">Forums Info</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/forums-members.html">Forums Members</a>
                                                    </li>
                                                    <li>
                                                        <a href="https://radiustheme.com/demo/html/cirkle/forums-media.html">Forums Media</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-nav-item hide-on-desktop-menu">
                                        <a href="index.html#" class="menu-link have-sub">Community</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/newsfeed.html">NewsFeed</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Profile Timeline</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-about.html">Profile About</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">Profile Friends</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-groups.html">Profile Group</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-photo.html">Profile Photo</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-video.html">Profile Video</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-badges.html">Profile Badges</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/forums.html">Forums</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/forums-forum.html">Forums Topic</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/forums-timeline.html">Forums Timeline</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/forums-info.html">Forums Info</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/forums-members.html">Forums Members</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/forums-media.html">Forums Media</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-nav-item">
                                        <a href="index.html#" class="menu-link have-sub">Blog</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/user-blog.html">Blog Grid</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/single-blog.html">Blog Details</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-nav-item">
                                        <a href="index.html#" class="menu-link have-sub">Pages</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/about-us.html">About</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/contact.html">Contact Us</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-nav-item">
                                        <a href="index.html#" class="menu-link have-sub">Shop</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/shop.html">Shop</a>
                                            </li>
                                            <li>
                                                <a href="https://radiustheme.com/demo/html/cirkle/single-shop.html">Shop Details</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-nav-item">
                                        <a href="https://radiustheme.com/demo/html/cirkle/contact.html" class="menu-link">Contact Us</a>
                                    </li>
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
                                        <a href="index.html#header-search" title="Search"><i class="icofont-search"></i></a>
                                    </li>
                                    <li class="login-btn">
                                        <a href="https://radiustheme.com/demo/html/cirkle/login.html" class="item-btn"><i class="fas fa-user"></i>Login</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--=====================================-->
        <!--=          Banner Start       		=-->
        <!--=====================================-->
        <section class="hero-banner">
            <div class="container">
                <div class="hero-content" data-sal="zoom-out" data-sal-duration="1000">
                    <h1 class="item-title">Cirkle Community</h1>
                    <p>Having real social contacts can sometimes be difficult FUN, everything becomes much simpler!</p>
                    <div class="item-number">10,95,219</div>
                    <div class="conn-people">Connected People</div>
                    <a href="https://radiustheme.com/demo/html/cirkle/newsfeed.html" class="button-slide">
                        <span class="btn-text">Discover Now</span>
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
                            <div class="item-subtitle">What We Do</div>
                            <h2 class="item-title"><span>Why Join Our</span> Cirkle from Social Network ?</h2>
                            <p>Social hen an unknown printer took a galley of type and scrambled make type specimen book. It has survived not only five centuries but also the leap into electronic typesetting, remaining essentialunchanged they popularised with release.</p>
                            <a href="https://radiustheme.com/demo/html/cirkle/login.html" class="button-slide">
                                <span class="btn-text">Join Our Community</span>
                                <span class="btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                    </svg>
                                </span>
                            </a>
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
                                            <h3 class="item-title">Meet Great People</h3>
                                            <p>when an unknown printer took a galley of scrambled it to make a type specimen It has survived not only.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="icofont-users"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="item-title">Forum Discussion</h3>
                                            <p>when an unknown printer took a galley of scrambled it to make a type specimen It has survived not only.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="icofont-paper"></i>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="item-title">Active Groups</h3>
                                            <p>when an unknown printer took a galley of scrambled it to make a type specimen It has survived not only.</p>
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
                            <h2 class="item-title">129 Countries We Build Our Largest Community in <span>Cirkle Network</span></h2>
                            <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also leap electronic typesetting, remaining essentially.</p>
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
                    <h2 class="item-title">Our Active Members</h2>
                    <p>when an unknown printer took a galley of type and meeting fari scrambled it to make a type specimen book.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-11">
                        <div class="row no-gutters">
                            <div class="col-lg-4 col-sm-6">
                                <ul class="nav nav-tabs nav-tabs-left" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="index.html#team1" role="tab" aria-selected="true">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_1.jpg" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="index.html#team2" role="tab" aria-selected="false">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_5.jpg" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="index.html#team3" role="tab" aria-selected="false">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_6.jpg" alt="team">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4 col-sm-6 order-lg-3">
                                <ul class="nav nav-tabs nav-tabs-right" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="index.html#team4" role="tab" aria-selected="false">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_3.jpg" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="index.html#team5" role="tab" aria-selected="false">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_4.jpg" alt="team">
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="index.html#team6" role="tab" aria-selected="false">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_7.jpg" alt="team">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4 order-lg-2">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="team1" role="tabpanel">
                                        <div class="team-box">
                                            <div class="item-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_1.jpg" alt="team">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Ketty Rio</a></h3>
                                                <div class="group-count"><span>25</span> - Fashion</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="team2" role="tabpanel">
                                        <div class="team-box">
                                            <div class="item-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_5.jpg" alt="team">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Johnson John</a></h3>
                                                <div class="group-count"><span>25</span> - Fashion</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="team3" role="tabpanel">
                                        <div class="team-box">
                                            <div class="item-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_6.jpg" alt="team">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Fahim Rahman</a></h3>
                                                <div class="group-count"><span>25</span> - Fashion</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="team4" role="tabpanel">
                                        <div class="team-box">
                                            <div class="item-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_3.jpg" alt="team">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Mamunur Rashid</a></h3>
                                                <div class="group-count"><span>25</span> - Fashion</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="team5" role="tabpanel">
                                        <div class="team-box">
                                            <div class="item-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_4.jpg" alt="team">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Ketty Rio</a></h3>
                                                <div class="group-count"><span>25</span> - Fashion</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="team6" role="tabpanel">
                                        <div class="team-box">
                                            <div class="item-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/team/team_7.jpg" alt="team">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-timeline.html">Ketty Rio</a></h3>
                                                <div class="group-count"><span>25</span> - Fashion</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="shape-wrap">
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_9.png" alt="shape"></li>
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/team/shape_1.png" alt="shape"></li>
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/team/shape_2.png" alt="shape"></li>
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/team/shape_circle_1.png" alt="shape"></li>
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/team/shape_circle_2.png" alt="shape"></li>
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/team/shape_circle_3.png" alt="shape"></li>
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/team/shape_3.png" alt="shape"></li>
                            <li><img src="https://radiustheme.com/demo/html/cirkle/media/team/shape_4.png" alt="shape"></li>
                        </ul>
                    </div>
                </div>
                <div class="see-all-btn">
                    <a href="https://radiustheme.com/demo/html/cirkle/forums-members.html" class="button-slide">
                        <span class="btn-text">Discover All Member</span>
                        <span class="btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Why Choose  Start       	=-->
        <!--=====================================-->
        <section class="why-choose-fluid">
            <div class="container-fluid full-width">
                <div class="row no-gutters">
                    <div class="col-lg-6">
                        <div class="why-choose-content">
                            <div class="content-box">
                                <h2 class="item-title">Cirkle Makes Your Life Easier &amp; Simple</h2>
                                <p>Aliquam lorem ante dapibus in viverra quis feugiat atellu Peaselus vierra nullaut metus varius laoreet unknown printer took scrambled make.</p>
                                <a href="https://radiustheme.com/demo/html/cirkle/about-us.html" class="button-slide">
                                    <span class="btn-text">Read More</span>
                                    <span class="btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                            <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="why-choose-img">
                            <div class="image-box">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/why_choose_1.jpg" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Location Find Start       =-->
        <!--=====================================-->
        <section class="section location-find">
            <div class="container">
                <div class="section-heading">
                    <h2 class="heading-title">Find People Near You</h2>
                    <p>when an unknown printer took a galley of type and meeting fari scrambled it to make a type specimen book. </p>
                </div>
                <div class="row gutters-20">
                    <div class="col-lg-6">
                        <div class="location-box">
                            <div class="item-img">
                                <a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/location/location_1.jpg" alt="Newyork City">
                                </a>
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">Newyork City</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row gutters-20">
                            <div class="col-sm-6">
                                <div class="location-box">
                                    <div class="item-img">
                                        <a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/location/location_2.jpg" alt="Newyork City">
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">Boston</a></h3>
                                    </div>
                                </div>
                                <div class="location-box">
                                    <div class="item-img">
                                        <a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/location/location_3.jpg" alt="Newyork City">
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">California</a></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="location-box">
                                    <div class="item-img">
                                        <a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/location/location_2.jpg" alt="Newyork City">
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">Kancas City</a></h3>
                                    </div>
                                </div>
                                <div class="location-box">
                                    <div class="item-img">
                                        <a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">
                                            <img src="https://radiustheme.com/demo/html/cirkle/media/location/location_4.jpg" alt="Newyork City">
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-friends.html">Los Angeles</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Banner Apps  Start       	=-->
        <!--=====================================-->
        <section class="banner-apps">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="banner-content">
                            <h2 class="item-title">Fully Responsive Cirkle WordPress Theme</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                            <a href="https://themeforest.net/user/radiustheme/portfolio" class="button-slide">
                                <span class="btn-text">Purchase Now</span>
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
                                <img src="https://radiustheme.com/demo/html/cirkle/media/banner/apps.png" alt="Apps">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Groups Area  Start       	=-->
        <!--=====================================-->
        <section class="section groups-popular">
            <div class="container">
                <div class="section-heading">
                    <h2 class="heading-title">Most Popular Groups</h2>
                    <p>when an unknown printer took a galley of type and meeting fari scrambled it to make a type specimen book. </p>
                </div>
                <div class="row gutters-15 justify-content-center">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_1.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Photography</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_2.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Break Fast</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_3.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Adventrue</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_4.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Restaurant</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_5.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Gaming</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_6.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Tatoo</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_7.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Music</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="groups-box">
                            <div class="item-img">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_8.jpg" alt="Groups">
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="https://radiustheme.com/demo/html/cirkle/user-single-group.html">Sports</a></h3>
                                <div class="groups-member">11,250 Members</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="see-all-btn">
                    <a href="https://radiustheme.com/demo/html/cirkle/user-groups.html" class="button-slide">
                        <span class="btn-text">See All Groups</span>
                        <span class="btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=         Testimonial Start       	=-->
        <!--=====================================-->
        <section class="testimonial-carousel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="testimonial-box">
                            <div class="slick-carousel slick-slider" data-slick='{"arrows": false, "slidesToShow": 1,  "fade": true, "asNavFor": ".slick-nav"}'>
                                <div class="slick-slide">
                                    <div class="testimonial-content">
                                        <h3 class="item-title">Zinia Jessy</h3>
                                        <div class="item-subtitle">CEO, Khadai R Ghumai</div>
                                        <p>" Lorem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmod tempor utlabore et dolore magna aliqua enim miniectetur adipisicing eliteiusmod dolore magna aliqua Ut enim ad minim veniam."</p>
                                    </div>
                                </div>
                                <div class="slick-slide">
                                    <div class="testimonial-content">
                                        <h3 class="item-title">Fahim Rahman</h3>
                                        <div class="item-subtitle">CEO, Khadai R Ghumai</div>
                                        <p>" Lorem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmod tempor utlabore et dolore magna aliqua enim miniectetur adipisicing eliteiusmod dolore magna aliqua Ut enim ad minim veniam."</p>
                                    </div>
                                </div>
                                <div class="slick-slide">
                                    <div class="testimonial-content">
                                        <h3 class="item-title">Tasfiq Al Rashid</h3>
                                        <div class="item-subtitle">CEO, Khadai R Ghumai</div>
                                        <p>" Lorem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmod tempor utlabore et dolore magna aliqua enim miniectetur adipisicing eliteiusmod dolore magna aliqua Ut enim ad minim veniam."</p>
                                    </div>
                                </div>
                                <div class="slick-slide">
                                    <div class="testimonial-content">
                                        <h3 class="item-title">Mamunur Rahman</h3>
                                        <div class="item-subtitle">CEO, Khadai R Ghumai</div>
                                        <p>" Lorem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmod tempor utlabore et dolore magna aliqua enim miniectetur adipisicing eliteiusmod dolore magna aliqua Ut enim ad minim veniam."</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-nav slick-carousel" data-slick='{"arrows": false, "slidesToShow": 3, "centerMode": true, "asNavFor": ".slick-slider", "focusOnSelect": true}'>
                                <div class="nav-item">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/testimonial/nav_1.jpg" alt="Product">
                                </div>
                                <div class="nav-item">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/testimonial/nav_2.jpg" alt="Product">
                                </div>
                                <div class="nav-item">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/testimonial/nav_3.jpg" alt="Product">
                                </div>
                                <div class="nav-item">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/testimonial/nav_1.jpg" alt="Product">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-wrap">
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_4.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_8.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_2.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_9.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_10.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_11.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_8.png" alt="shape"></li>
            </ul>
        </section>
        <!--=====================================-->
        <!--=         Blog Area Start       	=-->
        <!--=====================================-->
        <section class="section blog-grid">
            <div class="container">
                <div class="section-heading flex-heading">
                    <div class="row">
                        <div class="col-lg-5">
                            <h2 class="heading-title">Discover Our Awesome Blogs &amp; Stories</h2>
                        </div>
                        <div class="col-lg-7">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmod tempor utlabore et dolore magna aliqua enim miniectetur adipisicing eliteiusmod dolore magna aliqua Ut enim ad minim veniam.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="blog-img">
                                <a href="https://radiustheme.com/demo/html/cirkle/single-blog.html">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_1.jpg" alt="Blog">
                                </a>
                                <div class="blog-date"><i class="icofont-calendar"></i>24 Jun</div>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="https://radiustheme.com/demo/html/cirkle/single-blog.html">Our 10 Steps to successful video for blogging & Challanging</a></h3>
                                <ul class="entry-meta">
                                    <li><i class="icofont-ui-user"></i>by <a href="index.html#">Admin</a></li>
                                    <li><i class="icofont-tag"></i><a href="index.html#">Social</a>, <a href="index.html#">Live</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="blog-img">
                                <a href="https://radiustheme.com/demo/html/cirkle/single-blog.html">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_2.jpg" alt="Blog">
                                </a>
                                <div class="blog-date"><i class="icofont-calendar"></i>22 Jun</div>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="https://radiustheme.com/demo/html/cirkle/single-blog.html">Our 10 Steps to successful video for blogging & Challanging</a></h3>
                                <ul class="entry-meta">
                                    <li><i class="icofont-ui-user"></i>by <a href="index.html#">Admin</a></li>
                                    <li><i class="icofont-tag"></i><a href="index.html#">Social</a>, <a href="index.html#">Live</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="blog-img">
                                <a href="https://radiustheme.com/demo/html/cirkle/single-blog.html">
                                    <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_3.jpg" alt="Blog">
                                </a>
                                <div class="blog-date"><i class="icofont-calendar"></i>20 Jun</div>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="https://radiustheme.com/demo/html/cirkle/single-blog.html">Our 10 Steps to successful video for blogging & Challanging</a></h3>
                                <ul class="entry-meta">
                                    <li><i class="icofont-ui-user"></i>by <a href="index.html#">Admin</a></li>
                                    <li><i class="icofont-tag"></i><a href="index.html#">Social</a>, <a href="index.html#">Live</a></li>
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
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/cloud_1.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/cloud_2.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/cloud_2.png" alt="shape"></li>
                <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/cloud_1.png" alt="shape"></li>
            </ul>
            <div class="container">
                <ul class="section-shape">
                    <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_1.png" alt="shape"></li>
                    <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_2.png" alt="shape"></li>
                    <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_3.png" alt="shape"></li>
                    <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_4.png" alt="shape"></li>
                    <li><img src="https://radiustheme.com/demo/html/cirkle/media/figure/shape_5.png" alt="shape"></li>
                </ul>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="newsletter-box">
                            <h2 class="item-title">Subscribe Cirkle Newsletter</h2>
                            <p>Subscribe to be the first one to know about updates, new features and much more! Enter your email</p>
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
