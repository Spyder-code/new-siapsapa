@extends('layouts.social')
@section('content')
<h3>Berita & Artikel</h3>
<div class="block-box user-top-header mt-5">
    <ul class="menu-list justify-content-around">

        <li class="active"><a href="user-blog.html#">All</a></li>
        @foreach ($postCategory->slice(0, 5) as $item)
        <li><a href="user-blog.html#">{{ $item->name }}</a></li>
        @endforeach

        {{-- <li><a href="user-blog.html#">About</a></li>
        <li><a href="user-blog.html#">Friends</a></li>
        <li><a href="user-blog.html#">Menjadi jadi</a></li>
        <li><a href="user-blog.html#">asdsd asas</a></li>
        <li><a href="user-blog.html#">Videos asas</a></li>
        <li><a href="user-blog.html#">Badges asas </a></li>
        <li><a href="user-blog.html#">Desainasass_ass asas</a></li>
        <li><a href="user-blog.html#">Forums</a></li> --}}

        <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach ($postCategory->slice(5) as $item)
                    <a class="dropdown-item" href="user-blog.html#">{{ $item->name }}</a>
                    @endforeach
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="block-box user-search-bar justify-content-between">
    <div class="box-item">
        <div class="item-show-title">Total {{ $post->count() }} Posts</div>
    </div>
    <div class="box-item search-filter">
        <div class="dropdown">
            <label>Order By:</label>
            <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Newest Post</button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="user-blog.html#">All Post</a>
                <a class="dropdown-item" href="user-blog.html#">Newest Post</a>
                <a class="dropdown-item" href="user-blog.html#">Oldest Post</a>
            </div>
        </div>
    </div>
</div>
<div class="row gutters-20">
    @foreach ($post as $item)
    <div class="col-lg-4 col-md-6">
        <div class="block-box user-blog">
            <div class="blog-img">
                {{-- <a href="user-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_4.jpg" alt="Blog"></a> --}}
                <a href="{{ route('social.news.detail', $item->id) }}"><img style="max-width:100%; max-height:100%; object-fit: cover;" src="{{ $item->cover_image }}" alt="Blog"></a>
            </div>
            <div class="blog-content">
                <div class="blog-category">
                    <a href="#">{{ $item->name }}</a>
                </div>
                <h3 class="blog-title" style="text-transform: capitalize;"><a href="{{ route('social.news.detail', $item->id) }}">{{ substr($item->title, 0, 75) . '...' }}</a></h3>
                <div class="blog-date"><i class="icofont-calendar"></i>{{ date("j F, Y", strtotime($item->created_at)) }}</div>
                <p>{{ substr($item->content, 0, 150) . '...' }}</p>
            </div>
        </div>
    </div>
    @endforeach



</div>
@endsection
