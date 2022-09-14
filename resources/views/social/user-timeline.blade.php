@extends('layouts.social')
@section('content')
<div class="banner-user">
    <div class="banner-content">
        <div class="media">
            <div class="item-img">
                <img src="https://radiustheme.com/demo/html/cirkle/media/banner/user_1.jpg" alt="User">
            </div>
            <div class="media-body">
                <h3 class="item-title">{{ $anggota->nama }}l</h3>
                <div class="item-subtitle">Kwartir Ranting {{ ucfirst($anggota->district->name )}}</div>
                <ul class="item-social">
                    <li><a href="user-timeline.html#" class="bg-fb"><i class="icofont-facebook"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-twitter"><i class="icofont-twitter"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-dribble"><i class="icofont-dribbble"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-youtube"><i class="icofont-brand-youtube"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-behance"><i class="icofont-behance"></i></a></li>
                </ul>
                <ul class="user-meta">
                    <li>Posts: <span>30</span></li>
                    <li>Comments: <span>12</span></li>
                    <li>Views: <span>1.2k</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="block-box user-top-header">
    <ul class="menu-list">
        <li class="active"><a href="user-timeline.html#">Timeline</a></li>
        <li><a href="user-timeline.html#">About</a></li>
        <li><a href="user-timeline.html#">Friends</a></li>
        <li><a href="user-timeline.html#">Groups</a></li>
        <li><a href="user-timeline.html#">Photos</a></li>
        <li><a href="user-timeline.html#">Videos</a></li>
        <li><a href="user-timeline.html#">Badges</a></li>
        <li><a href="user-timeline.html#">Blogs</a></li>
        <li><a href="user-timeline.html#">Forums</a></li>
        <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user-timeline.html#">Shop</a>
                    <a class="dropdown-item" href="user-timeline.html#">Blog</a>
                    <a class="dropdown-item" href="user-timeline.html#">Others</a>
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
                    <a class="nav-link active" data-toggle="tab" href="user-timeline.html#post-status" role="tab" aria-selected="true"><i class="icofont-copy"></i>Status</a>
                </li>
                <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="MEDIA">
                    <a class="nav-link" data-toggle="tab" href="user-timeline.html#post-media" role="tab" aria-selected="false"><i class="icofont-image"></i>Photo/ Video Album</a>
                </li>
                <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="BLOG">
                    <a class="nav-link" data-toggle="tab" href="user-timeline.html#post-blog" role="tab" aria-selected="false"><i class="icofont-list"></i>Blog</a>
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
                    <a href="user-timeline.html#"><i class="icofont-photobucket"></i></a>
                    <a href="user-timeline.html#"><i class="icofont-tags"></i></a>
                    <a href="user-timeline.html#"><i class="icofont-location-pin"></i></a>
                </div>
                <div class="submit-btn">
                    <a href="user-timeline.html#">Post Submit</a>
                </div>
            </div>
        </div>
        <div class="block-box user-timeline-header">
            <ul class="menu-list d-none d-md-block">
                <li><a href="user-timeline.html#" class="active">All Updates</a></li>
                <li><a href="user-timeline.html#">Mentions</a></li>
                <li><a href="user-timeline.html#">Favorities</a></li>
                <li><a href="user-timeline.html#">Friends</a></li>
                <li><a href="user-timeline.html#">Groups</a></li>
            </ul>
            <div class="header-dropdown d-md-none">
                <label>Show:</label>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        All Updates
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">All Updates</a>
                        <a class="dropdown-item" href="user-timeline.html#">Mentions</a>
                        <a class="dropdown-item" href="user-timeline.html#">Favorities</a>
                        <a class="dropdown-item" href="user-timeline.html#">Friends</a>
                        <a class="dropdown-item" href="user-timeline.html#">Groups</a>
                    </div>
                </div>
            </div>
            <div class="header-dropdown">
                <label>Show:</label>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Everything
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Everything</a>
                        <a class="dropdown-item" href="user-timeline.html#">Status</a>
                        <a class="dropdown-item" href="user-timeline.html#">Photo</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-box post-view">
            <div class="post-header">
                <div class="media">
                    <div class="user-img">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_5.jpg" alt="Aahat">
                    </div>
                    <div class="media-body">
                        <div class="user-title"><a href="user-timeline.html">Rebeca Powel</a></div>
                        <ul class="entry-meta">
                            <li class="meta-privacy"><i class="icofont-world"></i>Public</li>
                            <li class="meta-time">2 mins ago</li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="post-body">
                <p>Dhaka is wonderful no matter what! <i class="icofont-wink-smile"></i></p>
                <div class="post-img">
                    <img src="https://radiustheme.com/demo/html/cirkle/media/figure/post_10.jpg" alt="Post">
                </div>
                <div class="post-meta-wrap">
                    <div class="post-meta">
                        <div class="post-reaction">
                            <div class="reaction-icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
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
                        <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                        <ul class="react-list">
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                        </ul>
                    </li>
                    <li><a href="user-timeline.html#"><i class="icofont-comment"></i>Comment</a></li>
                    <li class="post-share">
                        <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                        <ul class="share-list">
                            <li><a href="user-timeline.html#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="block-box post-view">
            <div class="post-header">
                <div class="media">
                    <div class="user-img">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_5.jpg" alt="Aahat">
                    </div>
                    <div class="media-body">
                        <div class="user-title"><a href="user-timeline.html">Rebeca Powel</a></div>
                        <ul class="entry-meta">
                            <li class="meta-privacy"><i class="icofont-users-alt-4"></i>Friends</li>
                            <li class="meta-time">2 mins ago</li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="post-body">
                <div class="post-no-thumbnail">
                    <p>I have great news to share with you all! I've been officially made a game streaming verified partner by Streamy http://radiustheme.com/ What does this mean? I'll be uploading new content every day, improving the quality and I'm gonna have access to games a month before the official release.</p>
                    <p>This is a dream come true, thanks to all for the support!!!</p>
                </div>
                <div class="post-meta-wrap">
                    <div class="post-meta">
                        <div class="post-reaction">
                            <div class="reaction-icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
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
                        <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                        <ul class="react-list">
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                        </ul>
                    </li>
                    <li><a href="user-timeline.html#"><i class="icofont-comment"></i>Comment</a></li>
                    <li class="post-share">
                        <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                        <ul class="share-list">
                            <li><a href="user-timeline.html#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="post-comment">
                <ul class="comment-list">
                    <li class="main-comments">
                        <div class="each-comment">
                            <div class="post-header">
                                <div class="media">
                                    <div class="user-img">
                                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_14.jpg" alt="Aahat">
                                    </div>
                                    <div class="media-body">
                                        <div class="user-title"><a href="user-timeline.html">Aahat Akter</a></div>
                                        <ul class="entry-meta">
                                            <li class="meta-privacy"><i class="icofont-world"></i>Friends</li>
                                            <li class="meta-time">5 mins ago</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-body">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium der doloremque laudantiumSed ut perspicia tisery..</p>
                            </div>
                            <div class="post-footer">
                                <ul>
                                    <li class="react-icon">
                                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                    </li>
                                    <li class="post-react">
                                        <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                                        <ul class="react-list">
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="user-timeline.html#"><i class="icofont-reply"></i>Reply</a></li>
                                </ul>
                            </div>
                        </div>
                        <ul class="children">
                            <li class="main-comments">
                                <div class="each-comment">
                                    <div class="post-header">
                                        <div class="media">
                                            <div class="user-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/notifiy_1.png" alt="Aahat">
                                            </div>
                                            <div class="media-body">
                                                <div class="user-title"><a href="user-timeline.html">Neko Bebo</a></div>
                                                <ul class="entry-meta">
                                                    <li class="meta-time">5 mins ago</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                ...
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="user-timeline.html#">Close</a>
                                                <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                                                <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-body">
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem..</p>
                                    </div>
                                    <div class="post-footer">
                                        <ul>
                                            <li class="react-icon">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
                                            </li>
                                            <li class="post-react">
                                                <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                                                <ul class="react-list">
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="user-timeline.html#"><i class="icofont-reply"></i>Reply</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="main-comments">
                                <div class="each-comment">
                                    <div class="post-header">
                                        <div class="media">
                                            <div class="user-img">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/notifiy_1.png" alt="Aahat">
                                            </div>
                                            <div class="media-body">
                                                <div class="user-title"><a href="user-timeline.html">Neko Bebo</a></div>
                                                <ul class="entry-meta">
                                                    <li class="meta-time">5 mins ago</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                ...
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="user-timeline.html#">Close</a>
                                                <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                                                <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-body">
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium der doloremque..</p>
                                    </div>
                                    <div class="post-footer">
                                        <ul>
                                            <li class="react-icon">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                            </li>
                                            <li class="post-react">
                                                <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                                                <ul class="react-list">
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                                                    <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="user-timeline.html#"><i class="icofont-reply"></i>Reply</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="main-comments">
                        <div class="each-comment">
                            <div class="post-header">
                                <div class="media">
                                    <div class="user-img">
                                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_14.jpg" alt="Aahat">
                                    </div>
                                    <div class="media-body">
                                        <div class="user-title"><a href="user-timeline.html#">Rebeca Powel</a></div>
                                        <ul class="entry-meta">
                                            <li class="meta-privacy"><i class="icofont-world"></i>Friends</li>
                                            <li class="meta-time">5 minutes ago</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-body">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium der doloremque laudantiumSed ..</p>
                            </div>
                            <div class="post-footer">
                                <ul>
                                    <li class="react-icon">
                                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                    </li>
                                    <li class="post-react">
                                        <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                                        <ul class="react-list">
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="user-timeline.html#"><i class="icofont-reply"></i>Reply</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="load-more-btn">
                    <a href="user-timeline.html#" class="item-btn">Load More Comments <span>4+</span></a>
                </div>
                <div class="comment-reply">
                    <div class="user-img">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_15.jpg" alt="Aahat">
                    </div>
                    <div class="input-box">
                        <input type="text" name="comment" class="form-control" placeholder="Your Reply....">
                    </div>
                </div>
            </div>
        </div>
        <div class="block-box post-view">
            <div class="post-header">
                <div class="media">
                    <div class="user-img">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_5.jpg" alt="Aahat">
                    </div>
                    <div class="media-body">
                        <div class="user-title"><a href="user-timeline.html">Rebeca Powel</a></div>
                        <ul class="entry-meta">
                            <li class="meta-privacy"><i class="icofont-user-alt-3"></i>Personal</li>
                            <li class="meta-time">8 mins ago</li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="post-body">
                <div class="post-no-thumbnail">
                    <p>I have great news to share with you all! I've been officially made a game streaming verified partner by Streamy http://radiustheme.com/ What does this mean? I'll be uploading new content every day, improving the quality and I'm gonna have access to games a month before the official release.</p>
                    <p>This is a dream come true, thanks to all for the support!!!</p>
                </div>
                <div class="post-meta-wrap">
                    <div class="post-meta">
                        <div class="post-reaction">
                            <div class="reaction-icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
                            </div>
                            <div class="meta-text">35</div>
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
                        <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                        <ul class="react-list">
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                        </ul>
                    </li>
                    <li><a href="user-timeline.html#"><i class="icofont-comment"></i>Comment</a></li>
                    <li class="post-share">
                        <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                        <ul class="share-list">
                            <li><a href="user-timeline.html#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="block-box post-view">
            <div class="post-header">
                <div class="media">
                    <div class="user-img">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_5.jpg" alt="Aahat">
                    </div>
                    <div class="media-body">
                        <div class="user-title"><a href="user-timeline.html">Rebeca Powel</a></div>
                        <ul class="entry-meta">
                            <li class="meta-privacy"><i class="icofont-world"></i>Public</li>
                            <li class="meta-time">10 mins ago</li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="post-body">
                <p>This is a dream come true, thanks to all for the support!!!</p>
                <div class="post-video">
                    <img src="https://radiustheme.com/demo/html/cirkle/media/figure/post_11.jpg" alt="Post">
                    <a href="user-timeline.html#" class="video-btn"><i class="icofont-ui-play"></i></a>
                </div>
                <div class="post-meta-wrap">
                    <div class="post-meta">
                        <div class="post-reaction">
                            <div class="reaction-icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
                            </div>
                            <div class="meta-text">55</div>
                        </div>
                    </div>
                    <div class="post-meta">
                        <div class="meta-text">05 Comments</div>
                        <div class="meta-text">02 Share</div>
                    </div>
                </div>
            </div>
            <div class="post-footer">
                <ul>
                    <li class="post-react">
                        <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                        <ul class="react-list">
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a></li>
                            <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a></li>
                        </ul>
                    </li>
                    <li><a href="user-timeline.html#"><i class="icofont-comment"></i>Comment</a></li>
                    <li class="post-share">
                        <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                        <ul class="share-list">
                            <li><a href="user-timeline.html#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                            <li><a href="user-timeline.html#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="block-box load-more-btn">
            <a href="user-timeline.html#" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
        </div>
    </div>
    <div class="col-lg-4 widget-block widget-break-lg">
        <div class="widget widget-user-about">
            <div class="widget-heading">
                <h3 class="widget-title">About Me</h3>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="user-info">
                <p>Hi! My name is Rebeca Powel but some people may know me asserty GamePagla! I have a Newbike channel where I stream.</p>
                <ul class="info-list">
                    <li><span>Joined:</span>24/12/2020</li>
                    <li><span>E-mail:</span>info@gmail.com</li>
                    <li><span>Address:</span>59 Street Neworkcity</li>
                    <li><span>Phone:</span>+123 9856836</li>
                    <li><span>Country:</span>USA</li>
                    <li><span>Web:</span><a href="user-timeline.html#">www.rebeca.com</a></li>
                    <li class="social-share"><span>Social:</span>
                        <div class="social-icon">
                            <a href="user-timeline.html#"><i class="icofont-facebook"></i></a>
                            <a href="user-timeline.html#"><i class="icofont-twitter"></i></a>
                            <a href="user-timeline.html#"><i class="icofont-dribbble"></i></a>
                            <a href="user-timeline.html#"><i class="icofont-whatsapp"></i></a>
                            <a href="user-timeline.html#"><i class="icofont-instagram"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="widget widget-gallery">
            <div class="widget-heading">
                <h3 class="widget-title">Photo Gallery</h3>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <ul class="photo-list">
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery1.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery2.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery3.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery4.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery5.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery6.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery2.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery4.jpg" alt="Gallery"></a></li>
                <li><a href="user-timeline.html#" data-photo="20+"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_gallery1.jpg" alt="Gallery"></a></li>
            </ul>
        </div>
        <div class="widget widget-badges">
            <div class="widget-heading">
                <h3 class="widget-title">My Badges</h3>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <ul class="badge-list">
                <li><a href="user-timeline.html#" class="bg-tagerine-gradient"><i class="icofont-crown-queen"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-amethyst-gradient"><i class="icofont-ui-play"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-picton-gradient"><i class="icofont-simple-smile"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-dodger-gradient"><i class="icofont-fire-burn"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-pink-gradient"><i class="icofont-dart"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-spring-gradient"><i class="icofont-flash"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-gray-gradient"><i class="icofont-panda-face"></i></a></li>
                <li><a href="user-timeline.html#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>

            </ul>
        </div>
        <div class="widget widget-memebers">
            <div class="widget-heading">
                <h3 class="widget-title">My Friends</h3>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="members-list">
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_1.jpg" alt="Chat">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">Aahat Akter</a></h4>
                        <div class="item-username">@Aahat </div>
                        <div class="member-status online"><i class="icofont-check"></i></div>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_2.jpg" alt="Chat">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">Kazi Rahman</a></h4>
                        <div class="item-username">@Rahman</div>
                        <div class="member-status online"><i class="icofont-check"></i></div>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_3.jpg" alt="Chat">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">Alia Karon</a></h4>
                        <div class="item-username">@Alia</div>
                        <div class="member-status online"><i class="icofont-check"></i></div>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/chat_4.jpg" alt="Chat">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">Masterero</a></h4>
                        <div class="item-username">@Master</div>
                        <div class="member-status offline"><i class="icofont-check"></i></div>
                    </div>
                </div>
            </div>
            <div class="see-all-btn">
                <a href="user-timeline.html#" class="item-btn">See All Friends</a>
            </div>
        </div>
        <div class="widget widget-groups">
            <div class="widget-heading">
                <h3 class="widget-title">My Groups</h3>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="group-list">
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_9.jpg" alt="group">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">Kito Development</a></h4>
                        <div class="item-member">265 Members</div>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_10.jpg" alt="group">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">Chef Express</a></h4>
                        <div class="item-member">4,265 Members</div>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_11.jpg" alt="group">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">Photo Contest</a></h4>
                        <div class="item-member">1,265 Members</div>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/groups/groups_12.jpg" alt="group">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="item-title"><a href="user-timeline.html#">WP Developers</a></h4>
                        <div class="item-member">265 Members</div>
                    </div>
                </div>
            </div>
            <div class="see-all-btn">
                <a href="user-timeline.html#" class="item-btn">See All Groups</a>
            </div>
        </div>
        <div class="widget widget-comment">
            <div class="widget-heading">
                <h3 class="widget-title">Recent Comments</h3>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Close</a>
                        <a class="dropdown-item" href="user-timeline.html#">Edit</a>
                        <a class="dropdown-item" href="user-timeline.html#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="group-list">
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_comment1.jpg" alt="post">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="post-date">JULY 24, 2020</div>
                        <h4 class="item-title"><a href="user-timeline.html#">Seohen anunown printer took.</a></h4>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_comment2.jpg" alt="post">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="post-date">JULY 24, 2020</div>
                        <h4 class="item-title"><a href="user-timeline.html#">Seohen anunown printer took.</a></h4>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_comment3.jpg" alt="post">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="post-date">JULY 24, 2020</div>
                        <h4 class="item-title"><a href="user-timeline.html#">Seohen anunown printer took.</a></h4>
                    </div>
                </div>
                <div class="media">
                    <div class="item-img">
                        <a href="user-timeline.html#">
                            <img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_comment4.jpg" alt="post">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="post-date">JULY 24, 2020</div>
                        <h4 class="item-title"><a href="user-timeline.html#">Seohen anunown printer took.</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget widget-banner">
            <h3 class="item-title">Most Popular</h3>
            <div class="item-subtitle">Circle Application</div>
            <a href="user-timeline.html#" class="item-btn">
                <span class="btn-text">Register Now</span>
                <span class="btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                        <path fill-rule="evenodd" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                    </svg>
                </span>
            </a>
            <div class="item-img">
                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/widget_banner_1.png" alt="banner">
            </div>
        </div>
    </div>
</div>
@endsection
