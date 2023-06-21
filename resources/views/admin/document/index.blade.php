@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/magnific.css') }}">
    <link rel="stylesheet" href="{{ asset('css/imageuploader.css') }}">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Dokumen', 'url' => '#'],
        ]"

        :title="'Upload Dokumen'"
        :description="'Dokumen Saya'"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">Status Anggota: <strong>{{ $cek->document_type->name ?? $cek->golongan->name }}</strong></li>
        </ul>
    </div>
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mydocument-tab" data-bs-toggle="tab" data-bs-target="#mydocument" type="button" role="tab" aria-controls="mydocument" aria-selected="true">Dokumen {{ request('anggota_id') ? $cek->nama : 'Saya'}}</button>
            </li>
            @if (Auth::user()->role != 'anggota' && empty(request('anggota_id')))
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="validatedocument-tab" data-bs-toggle="tab" data-bs-target="#validatedocument" type="button" role="tab" aria-controls="validatedocument" aria-selected="false">Validasi Dokumen
                    @if ($data->count() > 0)
                    <div class="notify" style="position: relative; top:-15px">
                        <span class="heartbit"></span> <span class="point"></span>
                    </div>
                    @endif
                </button>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="mydocument" role="tabpanel" aria-labelledby="mydocument-tab">
                @include('admin.document.my_document', ['documents' => $mydocument])
            </div>
            <div class="tab-pane fade" id="validatedocument" role="tabpanel" aria-labelledby="validatedocument-tab">
                <div class="card p-3">
                    @include('admin.document.validate_document', ['data' => $data])
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <form action="{{ route('dokumen.store') }}" method="post" class="card p-3 needs-validation" novalidate enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="{{ $cek->user_id }}">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Upload Dokumen</h4>
            </div>
            @csrf
            <div class="row card-body">
                {{-- error validation --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <x-input :name="'test'" :type="'text'" :label="'Anggota'" :value="$cek->nama" :attr="['required','disabled']" />
                <x-input :name="'pramuka'" :type="'select'" :label="'Kepramukaan'" :options="$pramuka" :attr="['required']" />
                <x-input :name="'document_type_id'" :type="'select'" :label="'Jenis Dokumen'" :options="[]" :attr="['required']" />
                <x-input :name="'sertif'" :type="'file'" :label="'File (.jpg/jpeg/png)'" :attr="['required']" />
                {{-- <div class="col-12">
                    <label for="file">File (.jpg/jpeg/png)</label>
                    <div class="input-images"></div>
                </div> --}}
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('dashboard/dist/js/magnific.js') }}"></script>
    <script src="{{ asset('dashboard/dist/js/magnific.init.js') }}"></script>
    <script src="{{ asset('js/imageuploader.js') }}"></script>
    <script>
        var table = $(".file-export").DataTable({
            scrollY: '500px',
        });
        $('.input-images').imageUploader({
            label:'Klik atau Drop Sertifikat',
            imagesInputName: 'sertif',
        });
        $('#pramuka').change(function (e) {
            var val = $(this).val();
            $.ajax({
                url: '{{ url("api/get-document") }}'+'/'+val,
                type: 'GET',
                success: function (data) {
                    $('select[name="document_type_id"]').empty();
                    var html = '<option value="">Pilih Jenis Dokumen</option>';
                    $.each(data, function (idx, item) {
                        html += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    $('select[name="document_type_id"]').html(html);
                }
            });
        });

        const deleteDocument = (id) =>{
            console.log(id);
            if(confirm('are you sure?')){
                $.ajax({
                    url: '{{ url("api/delete-document") }}',
                    type: 'DELETE',
                    data: {
                        user_id: '{{ Auth::user()->id }}',
                        document_id: id
                    },
                    success: function (data) {
                        // reload
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection

