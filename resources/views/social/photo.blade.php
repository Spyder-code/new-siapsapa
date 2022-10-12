@extends('layouts.social')
@section('content')
{{-- <div class="block-box user-top-header">
    <ul class="menu-list">
        <li class="active"><a href="user-photo.html#">Timeline</a></li>
        <li><a href="user-photo.html#">About</a></li>
        <li><a href="user-photo.html#">Friends</a></li>
        <li><a href="user-photo.html#">Groups</a></li>
        <li><a href="user-photo.html#">Photos</a></li>
        <li><a href="user-photo.html#">Videos</a></li>
        <li><a href="user-photo.html#">Badges</a></li>
        <li><a href="user-photo.html#">Blogs</a></li>
        <li><a href="user-photo.html#">Forums</a></li>
        <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user-photo.html#">Shop</a>
                    <a class="dropdown-item" href="user-photo.html#">Blog</a>
                    <a class="dropdown-item" href="user-photo.html#">Others</a>
                </div>
            </div>
        </li>
    </ul>
</div> --}}
<div class="row gutters-20 zoom-gallery" id="post-data">
    @include('data.photoList')
</div>
<div class="load-more-post">
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
            var url =  '?page=' + page;
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
