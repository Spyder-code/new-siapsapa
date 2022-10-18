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
                {{-- <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="STATUS">
                    <a class="nav-link active" data-toggle="tab" href="#status-tab" role="tab" aria-selected="true"><i
                            class="icofont-copy"></i>Status</a>
                </li> --}}
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
                {{-- <div class="tab-pane fade show active" id="status-tab" role="tabpanel">
                    status tab
                </div> --}}

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
</script>
@endsection
