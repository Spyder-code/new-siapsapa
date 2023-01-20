@extends('layouts.social')
@section('content')
<h3>Agenda Kegiatan</h3>
{{-- <div class="block-box user-top-header mt-5">
    <ul class="menu-list">
        <li class="active"><a href="user-blog.html#">Timeline</a></li>
        <li><a href="user-blog.html#">About</a></li>
        <li><a href="user-blog.html#">Friends</a></li>
        <li><a href="user-blog.html#">Groups</a></li>
        <li><a href="user-blog.html#">Photos</a></li>
        <li><a href="user-blog.html#">Videos</a></li>
        <li><a href="user-blog.html#">Badges</a></li>
        <li><a href="user-blog.html#">Blogs</a></li>
        <li><a href="user-blog.html#">Forums</a></li>
        <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user-blog.html#">Shop</a>
                    <a class="dropdown-item" href="user-blog.html#">Blog</a>
                    <a class="dropdown-item" href="user-blog.html#">Others</a>
                </div>
            </div>
        </li>
    </ul>
</div> --}}
<div class="block-box user-search-bar justify-content-between">
    <div class="box-item">
        <div class="item-show-title">Total {{ $agenda->count() }} Agenda</div>
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


<div class="row gutters-20">
    <div class="col-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Agenda Baru ({{ $agenda->where('is_finish',0)->count() }})</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Agenda Selesai ({{ $agenda->where('is_finish',1)->count() }})</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    @forelse ($agenda->where('is_finish',0) as $item)
                        <x-agenda_card_2 :item="$item"/>
                    @empty
                        <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    @forelse ($agenda->where('is_finish',1) as $item)
                        <x-agenda_card_2 :item="$item"/>
                    @empty
                        <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="load-more-post">
    <a href="user-blog.html#" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
</div> --}}

@endsection
