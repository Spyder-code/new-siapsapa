@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- dropzone css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
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
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Anggota', 'url' => '#'],
            ['name' => 'Create', 'url' => '#'],
        ]"

        :title="'Import Anggota'"
        :description="'Form Import Anggota Dari Excel'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Import Anggota</h4>
            </div>
            <form action="{{ route('anggota.store') }}" method="post" enctype="multipart/form-data" class="card-body needs-validation" novalidate>
                @csrf
                {{-- Error Validation --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="alert alert-danger" id="error">
                    <ul id="error-item">
                    </ul>
                </div>
                @include('admin.anggota.form_import')
                {{-- <div class="mb-3 btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                </div> --}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- dropzone cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    $('#error').hide();
    $('#tab-2').hide();
    var data_arr = [];
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone-excel", {
        url: "{{ route('anggota.import') }}",
        maxFilesize: 5,
        maxFiles: 1,
        uploadMultiple: false,
        acceptedFiles: ".xlsx, .xls",
        addRemoveLinks: true,
        dictRemoveFile: 'Hapus',
        dictDefaultMessage: '<span class="text-center"><span class="font-lg"><i class="fa fa-upload"></i></span> <br> Klik atau Drop file Excel disini</span>',
        dictInvalidFileType: 'File harus berformat .xlsx atau .xls',
        dictMaxFilesExceeded: 'Maksimal 1 file',
        maxfilesexceeded: function(file) {
            $('#my-dropzone').find('.dz-message').html('Maksimal 1 file');
            this.removeAllFiles();
            this.addFile(file);
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            let error = response.error;
            let data = response.data;
            var html = '';
            if(error.length>0){
                $('#error').show();
                $.each(error, function (idx, item) {
                    html += '<li>'+item+' format tanggal lahir salah</li>';
                });
                $('#error-item').html(html);
            }else{
                $('#error').hide();
                $('#error-item').html('');
                // array push
                data_arr.push(data);
                $('#tab-1').hide();
                $('#tab-2').show();
            }
        },
        error: function(file, response) {
            $('#my-dropzone').removeClass('dz-started');
            $('#my-dropzone').addClass('dz-error');
            $('#my-dropzone').find('.dz-message').html(response.message);
            $('#my-dropzone').find('.dz-message').addClass('text-danger');
            $('#my-dropzone').find('.dz-message').removeClass('text-success');
        }
    });

    var myDropzone = new Dropzone("#my-dropzone-foto", {
        url: "{{ route('anggota.import') }}",
        maxFilesize: 5,
        acceptedFiles: ".jpg, .png, .jpeg",
        addRemoveLinks: true,
        dictRemoveFile: 'Hapus',
        dictDefaultMessage: '<span class="text-center"><span class="font-lg"><i class="fa fa-upload"></i></span> <br> Klik atau Drop Foto disini</span>',
        dictInvalidFileType: 'File harus berformat .xlsx atau .xls',
        dictMaxFilesExceeded: 'Maksimal 1 file',
        maxfilesexceeded: function(file) {
            $('#my-dropzone').find('.dz-message').html('Maksimal 1 file');
            this.removeAllFiles();
            this.addFile(file);
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            console.log(response);
            if(response.success){
                $('#my-dropzone').removeClass('dz-started');
                $('#my-dropzone').addClass('dz-success');
                $('#my-dropzone').find('.dz-message').html(response.message);
                $('#my-dropzone').find('.dz-message').addClass('text-success');
                $('#my-dropzone').find('.dz-message').removeClass('text-danger');
            }
            else{
                $('#my-dropzone').removeClass('dz-started');
                $('#my-dropzone').addClass('dz-error');
                $('#my-dropzone').find('.dz-message').html(response.message);
                $('#my-dropzone').find('.dz-message').addClass('text-danger');
                $('#my-dropzone').find('.dz-message').removeClass('text-success');
            }
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
                url: '{{ route('anggota.import.delete') }}',
                data: {file: name},
                success: function (data) {
                    console.log(data);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    });
</script>
@endsection

