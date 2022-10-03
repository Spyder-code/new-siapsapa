@extends('social.user-timeline')

@section('style')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('content-user')
@if (Auth::id() == $user->id)
<div id="divForm">
    <form action="{{ route('post.media.store') }}" class="dropzone" id="dropzoneForm">
        @csrf
    </form>
    <div class="row my-3">
        <div class="col-md-2 mb-2">
            <button id="btnRemovePreview" class="btn btn-danger" style="width: 100%">Hapus Preview</button>
        </div>
        <div class="col-md-10">
            <button id="btnSubmitGaleri" class="btn btn-primary" style="width: 100%">Submit Galeri</button>
        </div>
    </div>
</div>
@endif

<div class="row gutters-20 zoom-gallery">
    @foreach ($postMedia as $item)
    @if ($item->type == 'image')
    <div class="col-lg-3 col-md-4 col-6">
        <div class="user-group-photo">
            <a href="{{ asset($item->path) }}" class="popup-zoom">
                <img src="{{ asset($item->path) }}" alt="Gallery">
            </a>
        </div>
    </div>
    @else
    <video width="320" height="240" controls>
        <source src="{{ asset($item->path) }}" type="video/mp4">
    </video>
    @endif
    @endforeach

</div>

{{-- <div class="load-more-post">
    <a href="user-photo.html#" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
</div> --}}
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
</script>
@endsection
