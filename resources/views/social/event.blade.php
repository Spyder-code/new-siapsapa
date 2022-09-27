@extends('layouts.social')
@section('content')
<h3>Agenda Kegiatan</h3>
<div class="block-box user-top-header mt-5">
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
</div>
<div class="block-box user-search-bar justify-content-between">
   <div class="box-item">
      <div class="item-show-title">Total {{ $agenda->count() }} Posts</div>
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


   @foreach ($agenda as $item)
   <div class="col-lg-4 col-md-4">
      <div class="block-box user-blog">
         <div class="blog-img">
            <a href="user-blog.html#"><img src="{{ asset($item->foto) }}"></a>
         </div>
         <div class="blog-content">
            <div class="blog-category">
               <a href="user-blog.html#">{{ $item->kategori }}</a>
            </div>
            <h3 class="blog-title"><a href="{{ route('agenda.detail', $item->id) }}">{{ $item->nama }}</a></h3>
            <div class="blog-date"><i class="icofont-calendar"></i>{{ date("jS F, Y",
               strtotime($item->created_at)) }}</div>
            <p>{{ substr($item->deskripsi, 0, 100) . '...' }}</p>
            <p style="text-transform: capitalize; font-size: .8rem">{{ Str::lower($item->kecamatan->name) }}, {{
               Str::lower($item->kabupaten->name) }}, Provinsi {{ Str::lower($item->provinsi->name) }}</p>
            <p class="font-weight-bold" style="text-transform: capitalize; font-size: 1rem">Tanggal mulai: {{
               date('d/m/Y', strtotime($item->tanggal_mulai)) }}</p>
            <p class="font-weight-bold" style="text-transform: capitalize; font-size: 1rem">Tanggal selesai: {{
               date('d/m/Y', strtotime($item->tanggal_selesai)) }}</p>
         </div>
         <div class="blog-meta">
            <li class="d-flex btn-group">
               <a href="{{ route('agenda.detail', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
               <a href="{{ route('agenda.peserta', $item) }}" class="btn btn-sm btn-success">Peserta</a>
               @if (Auth::id() == $item->created_by || Auth::user()->role=='admin')
               <a href="{{ route('agenda.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
               <button type="button" onclick="deleteAgenda({{ $item->id }})"
                  class="btn btn-sm btn-danger">Hapus</button>
               @endif
            </li>
         </div>
      </div>
   </div>
   @endforeach





</div>
<div class="load-more-post">
   <a href="user-blog.html#" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
</div>
@endsection