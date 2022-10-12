@forelse ($post as $item)
<div class="block-box post-view">
    <div class="post-header">
        <div class="media">
            <div class="user-img">
                <img src="{{ asset('berkas/anggota/'.$item->user->anggota->foto) }}" alt="{{ $item->user->name }}" style="width:44px; height:44px">
            </div>
            <div class="media-body">
                <div class="user-title">{{ $item->user->name }}</div>
                <ul class="entry-meta">
                    <li class="meta-privacy"><i class="icofont-user-alt-3"></i>Personal</li>
                    <li class="meta-time">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post-body">
        <div class="mt-3">
            <a href="{{ route('social.news.detail', $item->id) }}">
                <h5 class="blog-title" style="text-transform: capitalize;">
                    {{(strlen($item->title) >= 50) ? substr($item->title, 0, 50) . '...' : $item->title}}
                </h5>
            </a>
        </div>
        <div class="post-no-thumbnail">
            <p>{{(strlen($item->content) >= 300) ? substr($item->content, 0, 300) . '...' : $item->content}}</p>
            @if (strlen($item->content) > 300)
            <p><a href="{{ route('social.news.detail', $item->id) }}">Baca lebih lanjut</a></p>
            @endif
        </div>
        {{-- <div class="post-meta-wrap">
            <div class="post-meta">
                <div class="post-reaction">
                    <div class="reaction-icon">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png"
                            alt="icon">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png"
                            alt="icon">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png"
                            alt="icon">
                    </div>
                    <div class="meta-text">35</div>
                </div>
            </div>
            <div class="post-meta">
                <div class="meta-text">2 Comments</div>
                <div class="meta-text">05 Share</div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="post-footer">
        <ul>
            <li class="post-react">
                <a href="user-timeline.html#"><i class="icofont-thumbs-up"></i>React!</a>
                <ul class="react-list">
                    <li><a href="user-timeline.html#"><img
                                src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png"
                                alt="Like"></a>
                    </li>
                    <li><a href="user-timeline.html#"><img
                                src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png"
                                alt="Like"></a>
                    </li>
                    <li><a href="user-timeline.html#"><img
                                src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_4.png"
                                alt="Like"></a>
                    </li>
                    <li><a href="user-timeline.html#"><img
                                src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png"
                                alt="Like"></a>
                    </li>
                    <li><a href="user-timeline.html#"><img
                                src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png"
                                alt="Like"></a>
                    </li>
                    <li><a href="user-timeline.html#"><img
                                src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png"
                                alt="Like"></a>
                    </li>
                    <li><a href="user-timeline.html#"><img
                                src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png"
                                alt="Like"></a>
                    </li>
                </ul>
            </li>
            <li><a href="user-timeline.html#"><i class="icofont-comment"></i>Comment</a></li>
            <li class="post-share">
                <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                <ul class="share-list">
                    <li><a href="user-timeline.html#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                    <li><a href="user-timeline.html#" class="color-messenger"><i
                                class="icofont-facebook-messenger"></i></a></li>
                    <li><a href="user-timeline.html#" class="color-instagram"><i
                                class="icofont-instagram"></i></a>
                    </li>
                    <li><a href="user-timeline.html#" class="color-whatsapp"><i
                                class="icofont-brand-whatsapp"></i></a>
                    </li>
                    <li><a href="user-timeline.html#" class="color-twitter"><i class="icofont-twitter"></i></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div> --}}
</div>
@empty
<img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
@endforelse
