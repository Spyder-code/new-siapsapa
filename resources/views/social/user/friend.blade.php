@extends('social.user-timeline')
@section('content-user')
<div class="block-box user-search-bar">
    <div class="box-item search-box">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Member">
            <div class="input-group-append">
                <button class="search-btn" type="button"><i class="icofont-search"></i></button>
            </div>
        </div>
    </div>
    <div class="box-item search-filter">
        <div class="dropdown">
            <label>Order By:</label>
            <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Newest Member</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">All Member</a>
                <a class="dropdown-item" href="#">Newest Member</a>
                <a class="dropdown-item" href="#">Oldest Member</a>
            </div>
        </div>
    </div>
    <div class="box-item search-switcher">
        <ul class="user-view-switcher">
            <li class="active">
                <a class="user-view-trigger" href="#" data-type="user-grid-view">
                    <i class="icofont-layout"></i>
                </a>
            </li>
            <li>
                <a class="user-view-trigger" href="#" data-type="user-list-view">
                    <i class="icofont-listine-dots"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div id="user-view" class="user-grid-view">
    <div class="row gutters-20">
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_1.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_1.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Rebeca Powel</a></h4>
                        <div class="author-location">@ahat akter</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_2.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_3.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Julia Zessy</a></h4>
                        <div class="author-location">@zessyr</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_3.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_4.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Fahim Rahman</a></h4>
                        <div class="author-location">@rahman</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_4.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_5.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Aahat Akter</a></h4>
                        <div class="author-location">@aahat</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_5.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_6.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Aahat Akter</a></h4>
                        <div class="author-location">@aahat</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_6.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_7.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Aahat Akter</a></h4>
                        <div class="author-location">@aahat</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_7.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_8.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Aahat Akter</a></h4>
                        <div class="author-location">@aahat</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="media/figure/cover_8.jpg" alt="cover">
                    </div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="media/figure/author_9.jpg" alt="author">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h4 class="author-name"><a href="user-timeline.html">Aahat Akter</a></h4>
                        <div class="author-location">@aahat</div>
                    </div>
                </div>
                <ul class="author-badge">
                    <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
                    <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                    <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                    <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                </ul>
                <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pagination">
        <ul>
            <li><a href="#" class="active">1</a></li>
            <li><a href="#">2</a></li>
        </ul>
    </div>
</div>
@endsection
