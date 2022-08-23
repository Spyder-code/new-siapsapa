<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cirkle | NewsFeed</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('social') }}/media/favicon.png">
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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
</head>

<body class="bg-link-water">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <a href="#wrapper" data-type="section-switch" class="scrollup">
        <i class="icofont-bubble-up"></i>
    </a>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper">
        <!-- Top Header -->
        <header class="fixed-header">
            <div class="header-menu">
                <div class="navbar">
                    <div class="nav-item d-none d-sm-block">
                        <div class="header-logo">
                            <a href="index.html"><img src="{{ asset('social') }}/media/logo.png" alt="Cirkle"></a>
                        </div>
                    </div>
                    <div class="nav-item nav-top-menu">
                        <nav id="dropdown" class="template-main-menu">
                            <ul class="menu-content">
                                <li class="header-nav-item">
                                    <a href="index.html" class="menu-link active">Home</a>
                                </li>
                                <li class="header-nav-item">
                                    <a href="#" class="menu-link have-sub">Community</a>
                                    <ul class="mega-menu mega-menu-col-2">
                                        <li>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="newsfeed.html">NewsFeed</a>
                                                </li>
                                                <li>
                                                    <a href="user-timeline.html">Profile Timeline</a>
                                                </li>
                                                <li>
                                                    <a href="user-about.html">Profile About</a>
                                                </li>
                                                <li>
                                                    <a href="user-friends.html">Profile Friends</a>
                                                </li>
                                                <li>
                                                    <a href="user-groups.html">Profile Group</a>
                                                </li>
                                                <li>
                                                    <a href="user-photo.html">Profile Photo</a>
                                                </li>
                                                <li>
                                                    <a href="user-video.html">Profile Video</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="user-badges.html">Profile Badges</a>
                                                </li>
                                                <li>
                                                    <a href="forums.html">Forums</a>
                                                </li>
                                                <li>
                                                    <a href="forums-forum.html">Forums Topic</a>
                                                </li>
                                                <li>
                                                    <a href="forums-timeline.html">Forums Timeline</a>
                                                </li>
                                                <li>
                                                    <a href="forums-info.html">Forums Info</a>
                                                </li>
                                                <li>
                                                    <a href="forums-members.html">Forums Members</a>
                                                </li>
                                                <li>
                                                    <a href="forums-media.html">Forums Media</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="header-nav-item">
                                    <a href="#" class="menu-link have-sub">Pages</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="about-us.html">About</a>
                                        </li>
                                        <li>
                                            <a href="user-blog.html">Blog</a>
                                        </li>
                                        <li>
                                            <a href="shop.html">Shop</a>
                                        </li>
                                        <li>
                                            <a href="single-blog.html">Blog Details</a>
                                        </li>
                                        <li>
                                            <a href="single-shop.html">Shop Details</a>
                                        </li>
                                        <li>
                                            <a href="contact.html">Contact Us</a>
                                        </li>
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
                            <div class="dropdown dropdown-cart">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icofont-shopping-cart"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="item-heading">
                                        <h6 class="heading-title">Shopping Cart: <span>3</span></h6>
                                    </div>
                                    <div class="item-body">
                                        <div class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/cart_1.jpg" alt="Product">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title"><a href="#">Black Coffee Mug</a></h6>
                                                <div class="item-category">COFFEE MUGS</div>
                                                <div class="item-price">$29 x 1</div>
                                                <div class="btn-area">
                                                    <a href="#" class="close-btn"><i class="icofont-ui-close"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/cart_2.jpg" alt="Product">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title"><a href="#">Head Phone</a></h6>
                                                <div class="item-category">Assets</div>
                                                <div class="item-price">$15 x 1</div>
                                                <div class="btn-area">
                                                    <a href="#" class="close-btn"><i class="icofont-ui-close"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/cart_3.jpg" alt="Product">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title"><a href="#">Black Watch</a></h6>
                                                <div class="item-category">Watch</div>
                                                <div class="item-price">$59 x 1</div>
                                                <div class="btn-area">
                                                    <a href="#" class="close-btn"><i class="icofont-ui-close"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-footer">
                                        <a href="#" class="view-btn">View All Product</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown dropdown-friend">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icofont-users-alt-4"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="item-heading">
                                        <h6 class="heading-title">Friend Requests</h6>
                                        <div class="heading-btn">
                                            <a href="#">Settings</a>
                                            <a href="#">Mark all as Read</a>
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/chat_5.jpg" alt="Notify">
                                                <span class="chat-status offline"></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title"><a href="#">Lily Zaman</a></h6>
                                                <p>4 in mutual friends</p>
                                                <div class="btn-area">
                                                    <a href="#" class="item-btn"><i class="icofont-plus"></i></a>
                                                    <a href="#" class="item-btn"><i class="icofont-minus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/chat_1.jpg" alt="Notify">
                                                <span class="chat-status online"></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title"><a href="#">Ketty Rose</a></h6>
                                                <p>3 in mutual friends</p>
                                                <div class="btn-area">
                                                    <a href="#" class="item-btn"><i class="icofont-plus"></i></a>
                                                    <a href="#" class="item-btn"><i class="icofont-minus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/chat_8.jpg" alt="Notify">
                                                <span class="chat-status online"></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title"><a href="#">Rustom vai</a></h6>
                                                <p>6 in mutual friends</p>
                                                <div class="btn-area">
                                                    <a href="#" class="item-btn"><i class="icofont-plus"></i></a>
                                                    <a href="#" class="item-btn"><i class="icofont-minus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-footer">
                                        <a href="#" class="view-btn">View All Friend Request</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown dropdown-message">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icofont-speech-comments"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="item-heading">
                                        <h6 class="heading-title">Message</h6>
                                        <div class="heading-btn">
                                            <a href="#">Settings</a>
                                            <a href="#">Mark all as Read</a>
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <a href="#" class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/notifiy_1.png" alt="Notify">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title">Diana Jameson</h6>
                                                <div class="item-time">15 mins ago</div>
                                                <p>when are nknowen printer took galley of types ...</p>
                                            </div>
                                        </a>
                                        <a href="#" class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/notifiy_2.png" alt="Notify">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title">Quirty</h6>
                                                <div class="item-time">15 mins ago</div>
                                                <p>when are nknowen printer took galley of types ...</p>
                                            </div>
                                        </a>
                                        <a href="#" class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/notifiy_3.png" alt="Notify">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title">Zinia Jessy</h6>
                                                <div class="item-time">15 mins ago</div>
                                                <p>when are nknowen printer took galley of types ...</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="item-footer">
                                        <a href="#" class="view-btn">View All Messages</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown dropdown-notification">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icofont-notification"></i><span class="notify-count">3</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="item-heading">
                                        <h6 class="heading-title">Notifications</h6>
                                        <div class="heading-btn">
                                            <a href="#">Settings</a>
                                            <a href="#">Mark all as Read</a>
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <a href="#" class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/notifiy_1.png" alt="Notify">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title">Diana Jameson</h6>
                                                <div class="item-time">15 mins ago</div>
                                                <p>when are nknowen printer took galley of types ...</p>
                                            </div>
                                        </a>
                                        <a href="#" class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/notifiy_2.png" alt="Notify">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title">Quirty</h6>
                                                <div class="item-time">15 mins ago</div>
                                                <p>when are nknowen printer took galley of types ...</p>
                                            </div>
                                        </a>
                                        <a href="#" class="media">
                                            <div class="item-img">
                                                <img src="{{ asset('social') }}/media/figure/notifiy_3.png" alt="Notify">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="item-title">Zinia Jessy</h6>
                                                <div class="item-time">15 mins ago</div>
                                                <p>when are nknowen printer took galley of types ...</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="item-footer">
                                        <a href="#" class="view-btn">View All Notification</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inline-item">
                            <div class="dropdown dropdown-admin">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <span class="media">
                                        <span class="item-img">
                                            <img src="{{ asset('social') }}/media/figure/chat_5.jpg" alt="Chat">
                                            <span class="acc-verified"><i class="icofont-check"></i></span>
                                        </span>
                                        <span class="media-body">
                                            <span class="item-title">Rebeca</span>
                                        </span>
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="admin-options">
                                        <li><a href="#">Profile Settings</a></li>
                                        <li><a href="user-groups.html">Groups</a></li>
                                        <li><a href="forums.html">Forums</a></li>
                                        <li><a href="#">Settings</a></li>
                                        <li><a href="#">Terms and Conditions</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="login.html">Log Out</a></li>
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
                            <li><a href="newsfeed.html" class="menu-link" data-toggle="tooltip" data-placement="right" title=" NEWSFEED"><i class="icofont-newspaper"></i></a></li>
                            <li><a href="user-timeline.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="MEMBERS TIMELINE"><i class="icofont-list"></i></a></li>
                            <li><a href="user-groups.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="GROUPS"><i class="icofont-users-alt-2"></i></a></li>
                            <li><a href="user-friends.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="MEMBERS FRIENDS"><i class="icofont-users-alt-4"></i></a></li>
                            <li><a href="user-photo.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="GALLERY"><i class="icofont-photobucket"></i></a></li>
                            <li><a href="user-video.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="VIDEOS"><i class="icofont-play-alt-1"></i></a></li>
                            <li><a href="#" class="menu-link" data-toggle="tooltip" data-placement="right" title="EVENT SCHEDULE"><i class="icofont-calendar"></i></a></li>
                            <li><a href="forums-timeline.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="FORUM"><i class="icofont-ui-text-chat"></i></a></li>
                            <li><a href="shop.html" class="menu-link" data-toggle="tooltip" data-placement="right" title="SHOP"><i class="icofont-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="fixed-sidebar-left large-sidebar">
                <div class="sidebar-toggle">
                    <div class="sidebar-logo">
                        <a href="index.html"><img src="{{ asset('social') }}/media/logo2.png" alt="Logo"></a>
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
                            <li><a href="newsfeed.html" class="menu-link"><i class="icofont-newspaper"></i><span class="menu-title">Newsfeed</span></a></li>
                            <li><a href="user-timeline.html" class="menu-link"><i class="icofont-list"></i><span class="menu-title">Members Timeline</span></a></li>
                            <li><a href="user-groups.html" class="menu-link"><i class="icofont-users-alt-2"></i><span class="menu-title">Groups</span></a></li>
                            <li><a href="user-friends.html" class="menu-link"><i class="icofont-users-alt-4"></i><span class="menu-title">Members Friends</span></a></li>
                            <li><a href="user-photo.html" class="menu-link"><i class="icofont-photobucket"></i><span class="menu-title">Gallery</span></a></li>
                            <li><a href="user-video.html" class="menu-link"><i class="icofont-play-alt-1"></i><span class="menu-title">Videos</span></a></li>
                            <li><a href="#" class="menu-link"><i class="icofont-calendar"></i><span class="menu-title">Event Schedule</span></a></li>
                            <li><a href="forums-timeline.html" class="menu-link"><i class="icofont-ui-text-chat"></i><span class="menu-title">Forum</span></a></li>
                            <li><a href="shop.html" class="menu-link"><i class="icofont-shopping-cart"></i><span class="menu-title">Shop</span></a></li>
                        </ul>
                        <ul class="top-menu-mobile">
                            <li class="menu-label">Community</li>
                            <li>
                                <a href="user-about.html" class="menu-link">Profile About</a>
                            </li>
                            <li>
                                <a href="user-badges.html" class="menu-link">Profile Badges</a>
                            </li>
                            <li>
                                <a href="forums.html" class="menu-link">Forums</a>
                            </li>
                            <li>
                                <a href="forums-forum.html" class="menu-link">Forums Topic</a>
                            </li>
                            <li>
                                <a href="forums-info.html" class="menu-link">Forums Info</a>
                            </li>
                            <li>
                                <a href="forums-members.html" class="menu-link">Forums Members</a>
                            </li>
                            <li>
                                <a href="forums-media.html" class="menu-link">Forums Media</a>
                            </li>
                            <li class="menu-label">Pages</li>
                            <li>
                                <a href="about-us.html" class="menu-link">About</a>
                            </li>
                            <li>
                                <a href="user-blog.html" class="menu-link">Blog</a>
                            </li>
                            <li>
                                <a href="shop.html" class="menu-link">Shop</a>
                            </li>
                            <li>
                                <a href="single-blog.html" class="menu-link">Blog Details</a>
                            </li>
                            <li>
                                <a href="single-shop.html" class="menu-link">Shop Details</a>
                            </li>
                            <li>
                                <a href="contact.html" class="menu-link">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar Right -->
        <div class="fixed-sidebar right">
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
        </div>
        <!-- Page Content -->
        <div class="page-content">

            <!--=====================================-->
            <!--=        Newsfeed  Area Start       =-->
            <!--=====================================-->
            <div class="container">
                @yield('content')
            </div>
            <!--=====================================-->
            <!--=        Footer Area Start       	=-->
            <!--=====================================-->
            <footer class="footer-wrap footer-dashboard">
                <div class="main-footer">
                    <div class="container">
                        <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
                            <div class="col">
                                <div class="footer-box">
                                    <div class="footer-logo">
                                        <a href="index.html"><img src="{{ asset('social') }}/media/logo_dark.png" alt="Logo"></a>
                                    </div>
                                    <p>Dorem ipsum dolor sit amet consec adipisicing elit sed do eiusmod por incidiut labore et loreLorem ipsum kelly amieo dolorey.</p>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-lg-center">
                                <div class="footer-box">
                                    <h3 class="footer-title">
                                        Important Links
                                    </h3>
                                    <div class="footer-link">
                                        <ul>
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="about-us.html">About us</a></li>
                                            <li><a href="shop.html">Shop</a></li>
                                            <li><a href="contact.html">Contacts</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-lg-center">
                                <div class="footer-box">
                                    <h3 class="footer-title">
                                        Community
                                    </h3>
                                    <div class="footer-link">
                                        <ul>
                                            <li><a href="newsfeed.html">NewsFeed</a></li>
                                            <li><a href="user-timeline.html">Profile</a></li>
                                            <li><a href="user-friends.html">Friends</a></li>
                                            <li><a href="user-groups.html">Groups</a></li>
                                            <li><a href="forums.html">Forums</a></li>
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
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="footer-copyright">Copy© cirkle 2021. All Rights Reserved</div>
                </div>
            </footer>



        </div>
        <!-- Chat Modal Here -->
        <div class="chat-conversion-box" id="chat-box-modal" tabindex="-1" aria-labelledby="chat-modal-label" aria-hidden="true">
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

    <!-- Site Scripts -->
    <script src="{{ asset('social') }}/assets/js/app.js"></script>
</body>

</html>
