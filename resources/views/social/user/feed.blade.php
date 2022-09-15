@extends('social.user-timeline')
@section('content-user')
<div class="row">
    <div class="col-lg-8">
        @if (Auth::id()==$user->id)
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
        @endif
        <div class="block-box user-timeline-header">
            <ul class="menu-list d-none d-md-block">
                <li><a href="user-timeline.html#" class="active">Postingan</a></li>
                <li><a href="#">Tersimpan <i class="icofont-lock"></i></a></li>
                <li><a href="#">Ditandai <i class="icofont-lock"></i></a></li>
            </ul>
            <div class="header-dropdown d-md-none">
                <label>Tipe:</label>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Postingan
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Postingan</a>
                        <a class="dropdown-item" href="user-timeline.html#">Tersimpan</a>
                        <a class="dropdown-item" href="user-timeline.html#">Ditandai</a>
                    </div>
                </div>
            </div>
            <div class="header-dropdown">
                <label>Filter:</label>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Semua
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="user-timeline.html#">Semua</a>
                        <a class="dropdown-item" href="user-timeline.html#">Photo</a>
                        <a class="dropdown-item" href="user-timeline.html#">Video</a>
                        <a class="dropdown-item" href="user-timeline.html#">Artikel</a>
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
        @include('layouts.social-component.widget.banner')
    </div>
</div>
@endsection