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
            <label>Filter:</label>
            <button id="btnFilter" class="dropdown-toggle" type="button" data-toggle="dropdown"
                aria-expanded="false">Pilih Filter</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" id="btnFollower">Follower</a>
                <a class="dropdown-item" id="btnFollowing">Following</a>
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

    <div id="cardFollower" class="row gutters-20">
        @forelse ($follower as $item)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        <img src="{{ $item->userFollower->anggota->foto ?? 'media/figure/cover_1.jpg' }}" alt="cover">
                    </div>
                    {{-- <div class="profile-img">
                        <a href="#">
                            <img src="{{ $item->userFollower->anggota->foto ?? 'media/figure/cover_1.jpg' }}"
                                alt="author">
                        </a>
                    </div> --}}
                    <div class="profile-name mt-4">
                        <h4 class="author-name"><a href="{{ route('social.userFeed',$item->user_id) }}">{{ $item->userFollower->name }}</a></h4>
                        {{-- <div class="author-location">@ahat akter</div> --}}
                    </div>
                </div>
                <ul class="author-badge mt-3">
                    <li><a href="{{ route('social.userFeed',$item->following) }}" class="bg-salmon-gradient"><i class="icofont-search-user"></i></a></li>
                    {{-- <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-plus"></i></a></li> --}}
                    {{-- <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li> --}}
                    {{-- <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li> --}}
                </ul>
                {{-- <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul> --}}
            </div>
        </div>
        @empty
        <div class="container text-center">
            @if (Auth::id() == $user->id)
            <div class="alert alert-info" role="alert">
                <b>Kamu</b> belum mempunyai follower
            </div>
            @else
            <div class="alert alert-info" role="alert">
                <b>{{ $user->name }}</b> belum mempunyai follower
            </div>
            @endif
        </div>
        @endforelse
    </div>

    <div id="cardFollowing" class="row gutters-20" hidden>
        @forelse ($following as $item)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="widget-author">
                <div class="author-heading">
                    <div class="cover-img">
                        {{-- <img src="media/figure/cover_1.jpg" alt="cover"> --}}
                        <img src="{{ $item->userFollowing->anggota->foto ?? 'media/figure/cover_1.jpg' }}" alt="cover">
                    </div>
                    {{-- <div class="profile-img">
                        <a href="#">
                            <img src="{{ $item->userFollowing->anggota->foto ?? 'media/figure/cover_1.jpg' }}"
                                alt="author">
                        </a>
                    </div> --}}
                    <div class="profile-name mt-4">
                        <h4 class="author-name"><a href="{{ route('social.userFeed',$item->following) }}">{{ $item->userFollowing->name }}</a></h4>
                        {{-- <div class="author-location">@ahat akter</div> --}}
                    </div>
                </div>
                <ul class="author-badge mt-3">
                    <li><a href="{{ route('social.userFeed',$item->following) }}" class="bg-salmon-gradient"><i class="icofont-search-user"></i></a></li>
                    {{-- <li><a href="#" class="bg-amethyst-gradient"><i class="icofont-plus"></i></a></li> --}}
                    {{-- <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li> --}}
                    {{-- <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li> --}}
                </ul>
                {{-- <ul class="author-statistics">
                    <li>
                        <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
                    </li>
                </ul> --}}
            </div>
        </div>
        @empty
        <div class="container text-center">
            @if (Auth::id() == $user->id)
            <div class="alert alert-info" role="alert">
                <b>Kamu</b> belum memfollow siapapun
            </div>
            @else
            <div class="alert alert-info" role="alert">
                <b>{{ $user->name }}</b> belum memfollow siapapun
            </div>
            @endif
        </div>
        @endforelse
    </div>



    {{-- <div class="pagination">
        <ul>
            <li><a href="#" class="active">1</a></li>
            <li><a href="#">2</a></li>
        </ul>
    </div> --}}

</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#btnFollower").click(function() {
            $("#btnFilter").text("Follower");
            $("#cardFollowing").hide();
            $("#cardFollower").show();
        });

        $("#btnFollowing").click(function() {
            $("#btnFilter").text("Following");
            $("#cardFollowing").removeAttr("hidden");
            $("#cardFollower").hide();
            $("#cardFollowing").show();
        });
    });
</script>
@endsection
