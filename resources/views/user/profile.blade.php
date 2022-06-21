@extends('layouts.profile')
@section('style-user')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content-user')
    <div class="card">
        <form action="{{ route('page.profile.store') }}" method="POST" class="card-body needs-validation" novalidate enctype="multipart/form-data">
            @if (!empty($anggota))
                @if ($anggota->status==2)
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        Data anggota ini sedang dalam proses verifikasi.
                    </div>
                @elseif ($anggota->status==3)
                    <div class="alert alert-danger">
                        <i class="fa fa-info-circle"></i>
                        Data anggota tidak valid, silahkan perbarui data dengan benar.
                    </div>
                @endif
            @endif
            @csrf
            @include('user.anggota.form')
            <div class="row">
                <div class="col-12">
                    @if (empty($anggota))
                    <input type="hidden" name="status" value="2">
                    <button type="submit" name="type" class="btn btn-primary" value="create">SImpan Data</button>
                    @else
                    <input type="hidden" name="anggota_id" value="{{ $anggota->id }}">
                    <button type="submit" name="type" class="btn btn-primary" value="update">Ubah Data</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script-user')
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
