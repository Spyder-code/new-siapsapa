@extends('layouts.social')

@section('style')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    #file-upload-1 {
        display: none;
    }

    #file-upload-2 {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 3px 12px;
        cursor: pointer;
    }

    .select2-selection--multiple {
        overflow: hidden !important;
        height: auto !important;
    }

    .show-grid {
        border: 1px solid rgba(0, 0, 0, 0.3) !important;
    }
</style>
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">

        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <div><b>Error, gagal upload:</b></div>
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <div class="block-box post-input-tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="STATUS">
                    <a class="nav-link active" data-toggle="tab" href="#status-tab" role="tab" aria-selected="true"><i
                            class="icofont-copy"></i>Status</a>
                </li>
                <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="MEDIA">
                    <a class="nav-link" data-toggle="tab" href="#image-tab" role="tab" aria-selected="false"><i
                            class="icofont-image"></i>Photo/ Video Album</a>
                </li>
                <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="BLOG">
                    <a class="nav-link" data-toggle="tab" href="#blog-tab" role="tab" aria-selected="false"><i
                            class="icofont-list"></i>Blog</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active mx-3 my-2" id="status-tab" role="tabpanel">
                    <form action="{{ route('story.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-3">
                            {{-- <label class="font-weight-bold">Isi Konten</label> --}}
                            <textarea class="show-grid form-control border-opacity-0" placeholder="Tulis cerita" cols="30" rows="3" name="caption" required></textarea>
                        </div>
                        {{-- <div class="mx-3 py-3">
                            <label class="font-weight-bold">Pilih Tags</label>
                            <select class="js-example-basic-multiple" name="tag_id[]" style="width: 100%;" multiple
                                required>
                                @foreach ($tags as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="container px-3 py-2">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    {{-- <label for="file-upload-2" class="custom-file-upload">
                                    </label> --}}
                                    {{-- <i class="icofont-file-alt"></i> Foto/Video --}}
                                    <input type="file" name="file" accept="video/*, image/*">
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <input class="btn btn-primary" type="submit" value="Submit" style="float: right;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade mx-3 my-3" id="image-tab" role="tabpanel">
                    <div id="divForm">
                        <form action="{{ route('post.media.store') }}" class="dropzone" id="dropzoneForm">
                            @csrf
                        </form>
                        <div class="row my-3">
                            <div class="col-md-4 mb-2">
                                <button id="btnRemovePreview" class="btn btn-danger" style="width: 100%">Hapus
                                    Preview</button>
                            </div>
                            <div class="col-md-8">
                                <button id="btnSubmitGaleri" class="btn btn-primary" style="width: 100%">Submit
                                    Galeri</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade mx-3" id="blog-tab" role="tabpanel">
                    <form action="{{ route('social.post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-3">
                            <div class="row mt-3 mb-3">
                                <div class="col-lg-9 col-md-9">
                                    <label class="font-weight-bold">Judul</label>
                                    <input type="text" class="show-grid form-control border-opacity-25" name="title"
                                        placeholder="Masukan judul" required>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <label class="font-weight-bold">Kategori</label>
                                    <select class="form-select d-block" name="post_category_id" required>
                                        <option selected disabled>- pilih kategori -</option>
                                        @foreach ($kategori as $item)
                                        <option value={{$item->id}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label class="font-weight-bold">Isi Konten</label>
                            <textarea class="show-grid form-control border-opacity-0" placeholder="Masukan isi konten"
                                cols="30" rows="6" name="content" required></textarea>
                        </div>
                        <div class="mx-3 py-3">
                            <label class="font-weight-bold">Pilih Tags</label>
                            <select class="js-example-basic-multiple" name="tag_id[]" style="width: 100%;" multiple
                                required>
                                @foreach ($tags as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container px-3 py-2">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <label for="file-upload-1" class="custom-file-upload">
                                        <i class="icofont-image"></i> Cover Gambar
                                    </label>
                                    <input id="file-upload-1" type="file" name="cover_image" accept="image/*" required>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <label for="file-upload-2" class="custom-file-upload">
                                        <i class="icofont-file-alt"></i> Post Media
                                    </label>
                                    <input id="file-upload-2" type="file" name="post_media[]" accept="video/*, image/*"
                                        multiple>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <input class="btn btn-primary" type="submit" value="Submit" style="float: right;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

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
            {{-- <div class="header-dropdown">
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
            </div> --}}
        </div>

        @foreach ($stories as $item)
        <div class="block-box post-view" x-data="{ open: false }">
            <div class="post-header">
                <div class="media">
                    <div class="user-img">
                        <img src="{{ asset('berkas/anggota/'.$item->user->anggota->foto) }}" alt="{{ $item->user->name }}" style="width: 44px; height:44px">
                    </div>
                    <div class="media-body">
                        <div class="user-title"><a href="{{ route('social.userFeed', $item->user->anggota->id) }}">{{ $item->user->name }}</a> <i class="icofont-check"></i> posted in the story </div>
                        <ul class="entry-meta">
                            <li class="meta-privacy"><i class="icofont-world"></i> Public</li>
                            <li class="meta-time">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</li>
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
                <p>{{ $item->caption }}</p>
                @if ($item->file)
                <div class="post-img">
                    <a href="{{ asset($item->file) }}" class="image-link">
                        <img src="{{ asset($item->file) }}" alt="{{ $item->caption }}" class="img-fluid">
                    </a>
                </div>
                @endif
                <div class="post-meta-wrap">
                    <div class="post-meta d-flex" id="react-list-{{ $item->id }}">
                        @foreach ($item->reacts->groupBy('react_id') as $react)
                        <div class="post-reaction">
                            <div class="reaction-icon">
                                <img src="{{ asset($react->first()->react->path) }}" alt="{{ $react->first()->name }}">
                                <sup class="count-react">{{ $react->count() }}</sup>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="post-meta">
                        <div class="meta-text">{{ $item->comments->count() }} Comments</div>
                        {{-- <div class="meta-text">05 Share</div> --}}
                    </div>
                </div>
            </div>
            <div class="post-footer">
                <ul>
                    <li class="post-react">
                        <a><i class="icofont-thumbs-up"></i>React!</a>
                        <ul class="react-list" id="add-react-{{ $item->id }}">
                            @foreach ($reacts as $react)
                            <li><span><img onclick="addReact({{ $item->id }},'story',{{ $react->id }})" src="{{ asset($react->path) }}" alt="{{ $react->name }}"></span></li>
                            @endforeach
                        </ul>
                    </li>
                    <li @click="open = ! open"><a class="text-primary"><i class="icofont-comment"></i>Comment</a></li>
                    {{-- <li class="post-share">
                        <a href="javascript:void(0);" class="share-btn"><i class="icofont-share"></i>Share</a>
                        <ul class="share-list">
                            <li><a href="#" class="color-fb"><i class="icofont-facebook"></i></a></li>
                            <li><a href="#" class="color-messenger"><i class="icofont-facebook-messenger"></i></a></li>
                            <li><a href="#" class="color-instagram"><i class="icofont-instagram"></i></a></li>
                            <li><a href="#" class="color-whatsapp"><i class="icofont-brand-whatsapp"></i></a></li>
                            <li><a href="#" class="color-twitter"><i class="icofont-twitter"></i></a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
            <div class="post-comment" x-show="open" @click.outside="open = false">
                <ul class="comment-list" id="comment-list-{{ $item->id }}">
                    @foreach ($item->comments->sortByDesc('created_at') as $comment)
                    <li class="main-comments">
                        <div class="each-comment">
                            <div class="post-header">
                                <div class="media">
                                    <div class="user-img">
                                        <img src="{{ asset('berkas/anggota/'. $comment->user->anggota->foto) }}" alt="{{ $comment->user->name }}" style="width:40px;height:40px;">
                                    </div>
                                    <div class="media-body">
                                        <div class="user-title"><a href="#">{{ $comment->user->name }}</a></div>
                                        <ul class="entry-meta">
                                            <li class="meta-privacy"><i class="icofont-world"></i>Public</li>
                                            <li class="meta-time">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</li>
                                        </ul>
                                    </div>
                                </div>
                                @if (Auth::id()==$comment->user_id)
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
                                @endif
                            </div>
                            <div class="post-body">
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                {{-- <div class="load-more-btn">
                    <a href="#" class="item-btn">Load More Comments <span>4+</span></a>
                </div> --}}
                <div class="comment-reply">
                    <div class="user-img">
                        <img src="{{ asset('berkas/anggota/'.Auth::user()->anggota->foto) }}" alt="{{ Auth::user()->name }}" style="width:40px;height:40px;">
                    </div>
                    <div class="input-box d-flex" style="gap: 5px">
                        <input type="text" name="comment" class="form-control" id="comment-{{ $item->id }}" placeholder="Tulis komentar...." onkeypress="handle(event,{{ $item->id }},'story')">
                        <span style="font-size:2rem; margin-top:10px" onclick="addComment({{ $item->id }},'story')"><i class="icofont-paper-plane"></i></span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div id="post-data">
            @include('data.feedList',['post'=>$post])
        </div>

        {{-- <div class="block-box load-more-btn">
            <a href="user-timeline.html#" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
        </div> --}}
        <div class="load-more-post">
            <a href="#" id="load-more" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
        </div>


    </div>
    <div class="col-lg-4 widget-block widget-break-lg">
        @include('layouts.social-component.widget.banner')
    </div>
</div>
@endsection

@section('script')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.options.dropzoneForm = {
        paramName: "post_media",
        maxFilesize: 30, // MB
        uploadMultiple: "true",
        acceptedFiles: "image/jpeg,image/png,image/jpg,video/mpeg,video/quicktime,video/mp4",
        method: "post",
        autoProcessQueue: false,
        parallelUploads: 5,
        init: function() {
            const myDropzone = this;
            $("#btnRemovePreview").click(function() {
                myDropzone.removeAllFiles(true);
            });
            $("#btnSubmitGaleri").click(function() {
                myDropzone.processQueue();
            });
            myDropzone.on("complete", function() {
                if (myDropzone.getQueuedFiles().length == 0 && myDropzone.getUploadingFiles().length == 0) {
                    myDropzone.removeAllFiles(true);
                    setTimeout(function() {
                        location.reload();
                    }, 1800);
                }
            });
            myDropzone.on("error", function(file, response) {
                let alert = `<div class="alert alert-danger" role="alert"> ${response} </div>`
                $("#divForm").prepend(alert);
            });
        }
    };

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            width: 'resolve'
        });
    });

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

        function handle(e,post_id,type){
            if(e.keyCode === 13){
                e.preventDefault(); // Ensure it is only this code that runs
                addComment(post_id,type);
            }
        }

        function addComment(post_id,type) {
            let data = {
                user_id: @json(Auth::id()),
                comment: $('#comment-'+post_id).val()
            }
            if (type=='story') {
                data['story_id'] = post_id;
            } else if(type=='post') {
                data['post_id'] = post_id;
            }else if(type=='agenda') {
                data['agenda_id'] = post_id;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('api.comment.store') }}",
                data: data,
                success: function (response) {
                    $('#comment-'+post_id).val('');
                    $('#comment-list-'+post_id).append(response.html);
                }
            });
        }

        function addReact(post_id,type,react_id) {
            let data = {
                user_id: @json(Auth::id()),
                react_id: react_id
            }
            if (type=='story') {
                data['story_id'] = post_id;
            } else if(type=='post') {
                data['post_id'] = post_id;
            }else if(type=='agenda') {
                data['agenda_id'] = post_id;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('api.react.store') }}",
                data: data,
                success: function (response) {
                    console.log(response);
                    $('#react-list-'+post_id).html(response.html);
                }
            });
        }
</script>
@endsection
