@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Anggota', 'url' => '#'],
            ['name' => 'Edit', 'url' => '#'],
        ]"

        :title="'Edit Anggota '. $anggota->nama"
        :description="'Form Edit Anggota'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Edit Data</h4>
            </div>
            <form action="{{ route('anggota.update',['anggotum' => $anggota]) }}" method="post" enctype="multipart/form-data" class="card-body needs-validation" novalidate>
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $anggota->id }}">
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
                @include('admin.anggota.form', ['anggota' => $anggota])
                <div class="mb-3 btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $('select[name="provinsi"]').change(function(){
            var provinsi = $(this).val();
            $.ajax({
                url: "{{ url('/api/get-kabupaten') }}"+'/'+provinsi,
                type: "GET",
                success: function(data){
                    $('select[name="kabupaten"]').empty();
                    var html = '<option value="">Pilih Kabupaten</option>';
                    $.each(data, function (idx, item) {
                        html += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    $('select[name="kabupaten"]').html(html);
                }
            });
        });
        $('select[name="kabupaten"]').change(function(){
            var kabupaten = $(this).val();
            $.ajax({
                url: "{{ url('/api/get-kecamatan') }}"+'/'+kabupaten,
                type: "GET",
                success: function(data){
                    $('select[name="kecamatan"]').empty();
                    var html = '<option value="">Pilih Kecamatan</option>';
                    $.each(data, function (idx, item) {
                        html += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    $('select[name="kecamatan"]').html(html);
                }
            });
        });
        $('select[name="kecamatan"]').change(function(){
            var kecamatan = $(this).val();
            $.ajax({
                url: "{{ url('/api/get-gudep') }}"+'/'+kecamatan,
                type: "GET",
                success: function(data){
                    console.log(data);
                    $('select[name="gudep"]').empty();
                    var html = '<option value="">Pilih Gudep</option>';
                    $.each(data, function (idx, item) {
                        html += '<option value="'+item.id+'">'+item.nama_sekolah+'</option>';
                    });
                    $('select[name="gudep"]').html(html);
                }
            });
        });
        var tgl_lahir = flatpickr('#tgl_lahir',{
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: 'Y-m-d',
        });

        $('#nik').keyup(function (e) {
            var $input = $(this);
            $input.val($input.val().replace(/[^\d]+/g,''));
        });

        $('#alamat').attr('maxlength', 64);
        $('#nik').attr('maxlength', 16);
        $('#foto').attr('accept', 'accept="image/jpeg, image/png, image/jpg"');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#foto").change(function(){
            readURL(this);
        });
</script>
@endsection

