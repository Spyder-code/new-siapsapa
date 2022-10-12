@extends('layouts.social')
@section('style')
<style type="text/css">
    .ajax-load{
        background: #e1e1e1;
      padding: 10px 0px;
      width: 100%;
    }
</style>
@endsection
@section('content')
<h3>Berita & Artikel</h3>
<div class="block-box user-top-header mt-5">
    <ul class="menu-list">

        <li class="{{ !$category?'active':'' }}"><a href="{{ route('social.news') }}">All</a></li>
        @foreach ($postCategory->slice(0, 5) as $item)
        <li class="{{ $category==$item->id?'active':'' }}"><a href="{{ route('social.news',['category'=>$item->id]) }}">{{ $item->name }}</a></li>
        @endforeach

        <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach ($postCategory->slice(5) as $item)
                    <a class="dropdown-item" href="{{ route('social.news',['category'=>$item->id]) }}">{{ $item->name }}</a>
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
    {{-- <div class="box-item search-filter">
        <div class="dropdown">
            <label>Order By:</label>
            <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Newest
                Post</button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="user-blog.html#">All Post</a>
                <a class="dropdown-item" href="user-blog.html#">Newest Post</a>
                <a class="dropdown-item" href="user-blog.html#">Oldest Post</a>
            </div>
        </div>
    </div> --}}
</div>
<div class="row gutters-20" id="post-data">
    @include('data.postList')
</div>
<div class="load-more-post text-center">
    <a href="#" id="load-more" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
</div>
@endsection

@section('script')
    <script>
        var page = 1;
        // $(window).scroll(function() {
        //     if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        //         page++;
        //         loadMoreData(page);
        //     }
        // });

        $('#load-more').click(function (e) {
            e.preventDefault();
            page++;
            loadMoreData(page);
        });


        function loadMoreData(page){
            var type = @json($category);
            if (type>=1) {
                var url = '?category='+type+'&&page='+page;
            } else {
                var url =  '?page=' + page;
            }
            $.ajax(
                {
                    url: url,
                    type: "get",
                })
                .done(function(data)
                {
                    if(data.html == " "){
                        $('#load-more').hide();
                        return;
                    }
                    $("#post-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('server not responding...');
                });
        }
    </script>
@endsection
