@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Agenda', 'url' => route('agenda.index')],
            ['name' => 'Upload File', 'url' => '#'],
        ]"

        :title="'Agenda'"
        :description="'Upload File'"
    />
</div>
@endsection
@section('style')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    .dz-image img {
        width: 100%;
        height: 100%;
    }
    .dropzone.dz-started .dz-message {
        display: block !important;
    }
    .dropzone {
        border: 2px dashed #028AF4 !important;;
    }
    .dropzone .dz-preview.dz-complete .dz-success-mark {
        opacity: 1;
    }
    .dropzone .dz-preview.dz-error .dz-success-mark {
        opacity: 0;
    }
    .dropzone .dz-preview .dz-error-message{
        top: 144px;
    }
</style>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="dropzone" id="my-dropzone"></div>

        @if ($file)
            <div class="mt-3">
                <div id="playerContainer"></div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/indigo-player@1/lib/indigo-player.js"></script>
<script>
    let file = @json($file);
    let name = '';
    Dropzone.autoDiscover = false;
        var myDropzoneBefore = new Dropzone("#my-dropzone", {
            url: "{{ route('agenda.fileStore') }}",
            params: {
                agenda_id: @json($agenda->id),
            },
            addRemoveLinks: true,
            dictRemoveFile: 'Hapus',
            uploadMultiple: false,
            maxFiles:1,
            acceptedFiles:'video/*',
            dictDefaultMessage: '<span class="text-center"><span class="font-lg"><i class="fas fa-upload"></i></span> <br> Klik atau Drop Video disini</span>',
            maxfilesexceeded: function(file) {
                this.removeAllFiles();
                this.addFile(file);
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, resp) {
                location.reload()
            },
            error: function(file, response) {
                $('#my-dropzone').removeClass('dz-started');
                $('#my-dropzone').addClass('dz-error');
                $('#my-dropzone').find('.dz-message').html(response.message);
                $('#my-dropzone').find('.dz-message').addClass('text-danger');
                $('#my-dropzone').find('.dz-message').removeClass('text-success');
            },
            removedfile: function(file) {
                var name = file.name;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route('agenda.file.delete') }}',
                    data: {file: name, agenda_id: @json($agenda->id)},
                    success: function (data) {
                        location.reload()
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            init: function(){
                if (file!=null) {
                    let size = file.size;
                    var mockFile = { name: file.file_name, size: parseInt(size), type: file.mime };
                    this.emit("addedfile", mockFile);
                    this.createThumbnailFromUrl(mockFile, 'https://cdn-icons-png.flaticon.com/512/4404/4404094.png');
                }
            }
        });

        if (file!=null) {
            const config = {
                sources: [
                    {
                        type: 'mp4',
                        src: @json(asset($file->file_path ?? '')),
                    }
                ],
            };

            const element = document.getElementById('playerContainer');
            const player = IndigoPlayer.init(element, config);
        }
</script>
@endsection


