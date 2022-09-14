@extends('layouts.social')
@section('content')
    <!-- Banner Area Start -->
    <div class="newsfeed-banner">
        <div class="media">
            <div class="item-icon">
                <i class="icofont-megaphone-alt"></i>
            </div>
            <div class="media-body">
                <h3 class="item-title">Members Newsfeed</h3>
                <p>Check what your friends have been up to!</p>
            </div>
        </div>
        <ul class="animation-img">
            <li data-sal="slide-down" data-sal-duration="800" data-sal-delay="400"><img src="{{ asset('social') }}/media/banner/shape_7.png" alt="shape"></li>
            <li data-sal="slide-up" data-sal-duration="500"><img src="{{ asset('social') }}/media/banner/people_2.png" alt="shape"></li>
        </ul>
    </div>
    <div class="newsfeed-search">
        <ul class="member-list">
            <li class="active-member">
                <a href="#">
                    <span class="member-icon">
                        <i class="icofont-users"></i>
                    </span>
                    <span class="member-text">
                        Total Members:
                    </span>
                    <span class="member-count">08</span>
                </a>
            </li>
        </ul>
        <ul class="search-list">
            <li class="search-filter">
                <button class="drop-btn" type="button">
                    <i class="icofont-abacus-alt"></i>
                </button>
                <div class="drop-menu">
                    <select class="select2">
                        <option>--Everything--</option>
                        <option>Status</option>
                        <option>Quotes</option>
                        <option>Photos</option>
                        <option>Videos</option>
                        <option>Audios</option>
                        <option>slideshows</option>
                        <option>files</option>
                        <option>Updates</option>
                        <option>New Members</option>
                        <option>Posts</option>
                        <option>New Groups</option>
                    </select>
                </div>
            </li>
            <li class="search-input">
                <button class="drop-btn" type="button">
                    <i class="icofont-search"></i>
                </button>
                <div class="drop-menu">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search....">
                        <div class="input-group-append">
                            <button class="search-btn" type="button"><i class="icofont-search-1"></i></button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="block-box post-input-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="STATUS">
                        <a class="nav-link active" data-toggle="tab" href="#post-status" role="tab" aria-selected="true"><i class="icofont-copy"></i>Cerita</a>
                    </li>
                    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="MEDIA">
                        <a class="nav-link" data-toggle="tab" href="#post-media" role="tab" aria-selected="false"><i class="icofont-image"></i>Photo/ Video Album</a>
                    </li>
                    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="BLOG">
                        <a class="nav-link" data-toggle="tab" href="#post-blog" role="tab" aria-selected="false"><i class="icofont-list"></i>Artikel</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="post-status" role="tabpanel">
                        <textarea name="status-input" id="status-input1" class="form-control textarea" placeholder="Share what are you thinking . . ." cols="30" rows="6"></textarea>
                    </div>
                    <div class="tab-pane fade" id="post-media" role="tabpanel">
                        <!-- <label>Media Gallery</label>
                        <a href="#" class="media-insert"><i class="icofont-upload-alt"></i>Upload</a> -->
                        <textarea name="status-input" id="status-input2" class="form-control textarea" placeholder="Share what are you thinking . . ." cols="30" rows="6"></textarea>
                    </div>
                    <div class="tab-pane fade" id="post-blog" role="tabpanel">
                        <textarea name="status-input" id="status-input3" class="form-control textarea" placeholder="Share what are you thinking . . ." cols="30" rows="6"></textarea>
                    </div>
                </div>
                <div class="post-footer">
                    <div class="insert-btn">
                        <a href="#"><i class="icofont-photobucket"></i></a>
                        <a href="#"><i class="icofont-tags"></i></a>
                        <a href="#"><i class="icofont-location-pin"></i></a>
                    </div>
                    <div class="submit-btn">
                        <a href="#">Post Submit</a>
                    </div>
                </div>
            </div>
            <div class="block-box post-view">
                <div class="post-header">
                    <div class="media">
                        <div class="user-img">
                            <img src="{{ asset('social') }}/media/figure/chat_10.jpg" alt="Aahat">
                        </div>
                        <div class="media-body">
                            <div class="user-title"><a href="user-timeline.html">Aahat Akter</a> <i class="icofont-check"></i> posted in the group <a href="#">Tourist Guide</a> </div>
                            <ul class="entry-meta">
                                <li class="meta-privacy"><i class="icofont-world"></i> Public</li>
                                <li class="meta-time">2 mins ago</li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Close</a>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="post-body">
                    <p>Dhaka is wonderful no matter what! <i class="icofont-wink-smile"></i></p>
                    <div class="post-img">
                        <img src="{{ asset('social') }}/media/figure/post_1.jpg" alt="Post">
                    </div>
                    <div class="post-meta-wrap">
                        <div class="post-meta">
                            <div class="post-reaction">
                                <div class="reaction-icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_1.png" alt="icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="icon">
                                </div>
                                <div class="meta-text">15</div>
                            </div>
                        </div>
                        <div class="post-meta">
                            <div class="meta-text">2 Comments</div>
                            <div class="meta-text">05 Share</div>
                        </div>
                    </div>
                </div>
                <div class="post-footer">
                    <ul>
                        <li class="post-react">
                            <a href="#"><i class="icofont-thumbs-up"></i>React!</a>
                            <ul class="react-list">
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_1.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_4.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_7.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_6.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_5.png" alt="Like"></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="icofont-comment"></i>Comment</a></li>
                        <li class="post-share">
                            <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                            <ul class="share-list">
                                <li><a href="#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                                <li><a href="#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                                <li><a href="#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                                <li><a href="#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                                <li><a href="#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="block-box post-view">
                <div class="post-header">
                    <div class="media">
                        <div class="user-img">
                            <img src="{{ asset('social') }}/media/figure/chat_5.jpg" alt="Aahat">
                        </div>
                        <div class="media-body">
                            <div class="user-title"><a href="user-timeline.html">Jessica Rose</a> <i class="icofont-check"></i> and <a href="user-timeline.html">Aahat Akter <i class="icofont-check"></i> </a> are now friends</div>
                            <ul class="entry-meta">
                                <li class="meta-privacy"><i class="icofont-world"></i> Public</li>
                                <li class="meta-time">3 Hrs ago</li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Close</a>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="post-body">
                    <div class="post-friends-view">
                        <div class="profile-thumb">
                            <div class="cover-img">
                                <img src="{{ asset('social') }}/media/figure/post_2.jpg" alt="cover-pic">
                            </div>
                            <div class="media">
                                <div class="profile-img">
                                    <a href="#"><img src="{{ asset('social') }}/media/figure/post_3.jpg" alt="profile"></a>
                                </div>
                                <div class="media-body">
                                    <div class="profile-name"><a href="#">Aahat Akter</a></div>
                                    <div class="user-name">@Aahat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-box post-view">
                <div class="post-header">
                    <div class="media">
                        <div class="user-img">
                            <img src="{{ asset('social') }}/media/figure/chat_13.jpg" alt="Aahat">
                        </div>
                        <div class="media-body">
                            <div class="user-title"><a href="user-timeline.html">Julia Zessy</a> <i class="icofont-check"></i> uploaded <a href="#">10 new photos</a> </div>
                            <ul class="entry-meta">
                                <li class="meta-privacy"><i class="icofont-world"></i> Public</li>
                                <li class="meta-time">10 mins ago</li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Close</a>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="post-body">
                    <p>Here are some of the photos from my last visit to Cox’s Bazar</p>
                    <ul class="post-img-list">
                        <li><a href="#"><img src="{{ asset('social') }}/media/figure/post_4.jpg" alt="Post"></a></li>
                        <li><a href="#"><img src="{{ asset('social') }}/media/figure/post_5.jpg" alt="Post"></a></li>
                        <li><a href="#"><img src="{{ asset('social') }}/media/figure/post_6.jpg" alt="Post"></a></li>
                        <li><a href="#"><img src="{{ asset('social') }}/media/figure/post_7.jpg" alt="Post"></a></li>
                        <li><a href="#" data-photo="+5"><img src="{{ asset('social') }}/media/figure/post_8.jpg" alt="Post"></a></li>
                    </ul>
                    <div class="post-meta-wrap">
                        <div class="post-meta">
                            <div class="post-reaction">
                                <div class="reaction-icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_1.png" alt="icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_3.png" alt="icon">
                                </div>
                                <div class="meta-text">25</div>
                            </div>
                        </div>
                        <div class="post-meta">
                            <div class="meta-text">2 Comments</div>
                            <div class="meta-text">05 Share</div>
                        </div>
                    </div>
                </div>
                <div class="post-footer">
                    <ul>
                        <li class="post-react">
                            <a href="#"><i class="icofont-thumbs-up"></i>React!</a>
                            <ul class="react-list">
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_1.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_4.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_7.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_6.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_5.png" alt="Like"></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="icofont-comment"></i>Comment</a></li>
                        <li class="post-share">
                            <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                            <ul class="share-list">
                                <li><a href="#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                                <li><a href="#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                                <li><a href="#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                                <li><a href="#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                                <li><a href="#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="block-box post-view">
                <div class="post-header">
                    <div class="media">
                        <div class="user-img">
                            <img src="{{ asset('social') }}/media/figure/chat_8.jpg" alt="Aahat">
                        </div>
                        <div class="media-body">
                            <div class="user-title"><a href="user-timeline.html">Abul Hassan</a> <i class="icofont-check"></i> posted in the group <a href="user-single-group.html">Kito Development</a> </div>
                            <ul class="entry-meta">
                                <li class="meta-privacy"><i class="icofont-world"></i> Public</li>
                                <li class="meta-time">10 mins ago</li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Close</a>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="post-body">
                    <p>This is a dream come true, thanks to all for the support!!!</p>
                    <div class="post-video">
                        <img src="{{ asset('social') }}/media/figure/post_9.jpg" alt="Post">
                        <a href="#" class="video-btn"><i class="icofont-ui-play"></i></a>
                    </div>
                    <div class="post-meta-wrap">
                        <div class="post-meta">
                            <div class="post-reaction">
                                <div class="reaction-icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_1.png" alt="icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="icon">
                                    <img src="{{ asset('social') }}/media/figure/reaction_3.png" alt="icon">
                                </div>
                                <div class="meta-text">50</div>
                            </div>
                        </div>
                        <div class="post-meta">
                            <div class="meta-text">5 Comments</div>
                            <div class="meta-text">02 Share</div>
                        </div>
                    </div>
                </div>
                <div class="post-footer">
                    <ul>
                        <li class="post-react">
                            <a href="#"><i class="icofont-thumbs-up"></i>React!</a>
                            <ul class="react-list">
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_1.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_4.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_2.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_7.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_6.png" alt="Like"></a></li>
                                <li><a href="#"><img src="{{ asset('social') }}/media/figure/reaction_5.png" alt="Like"></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="icofont-comment"></i>Comment</a></li>
                        <li class="post-share">
                            <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                            <ul class="share-list">
                                <li><a href="#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                                <li><a href="#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                                <li><a href="#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                                <li><a href="#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                                <li><a href="#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="block-box load-more-btn">
                <a href="#" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
            </div>
        </div>
        <div class="col-lg-4 widget-block widget-break-lg">
            @include('layouts.social-component.widget.author')
            @include('layouts.social-component.widget.member')
            {{-- @include('layouts.social-component.widget.group') --}}
            @include('layouts.social-component.widget.banner')
            {{-- @include('layouts.social-component.widget.activity') --}}
        </div>
    </div>
@endsection
