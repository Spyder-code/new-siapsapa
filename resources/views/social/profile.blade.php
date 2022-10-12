@extends('layouts.social')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
<style>
    .form-inline{
        width: 100%;
        border:none;
        border-bottom: 1px solid #1890ff;
        outline: none;
        padding: 0 10px;
        margin-left: 10px;
    }
</style>

<div class="banner-user">
    <div class="banner-content">
        <div class="media">
            <div class="item-img">
                <img src="{{ asset('berkas/anggota/'.$anggota->foto) }}" alt="User" style="width: 90px; height:90px">
            </div>
            <div class="media-body">
                <h3 class="item-title">{{ $anggota->nama }}</h3>
                <div class="item-subtitle">{{ ucfirst($user->role) }} Kwartir Ranting {{ ucwords(strtolower($anggota->district->name))}}</div>
                <ul class="item-social">
                    <li><a href="user-timeline.html#" class="bg-fb"><i class="icofont-facebook"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-twitter"><i class="icofont-twitter"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-dribble"><i class="icofont-instagram"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-success"><i class="icofont-whatsapp"></i></a></li>
                </ul>
                <ul class="user-meta">
                    <li>Posts: <span>30</span></li>
                    <li>Pengikut: <span>12</span></li>
                    <li>Diikuti: <span>12</span></li>
                    <li>Views: <span>1.2k</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="block-box user-top-header">
    <ul class="menu-list">
        <li class="{{ request()->is('anggota/*/feed') ? 'active' : '' }}"><a href="{{ route('social.userFeed', $anggota->id) }}">Feed</a></li>
        <li class="{{ request()->is('anggota/*/sertifikat') ? 'active' : '' }}"><a href="{{ route('social.userSertification', $anggota->id) }}">Sertifikat</a></li>
        <li class="{{ request()->is('anggota/*/teman') ? 'active' : '' }}"><a href="{{ route('social.userFriend', $anggota->id) }}">Teman</a></li>
        <li class="{{ request()->is('anggota/*/galeri') ? 'active' : '' }}"><a href="{{ route('social.userGallery', $anggota->id) }}">Galeri</a></li>
        {{-- <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user-timeline.html#">Pengikut</a>
                    <a class="dropdown-item" href="user-timeline.html#">Mengikuti</a>
                </div>
            </div>
        </li> --}}
    </ul>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="block-box forum-info">
            <div class="widget-heading">
                <h3 class="widget-title">Biodata</h3>
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
            <form action="{{ route('page.profile.store') }}" method="POST" class="card-body needs-validation" novalidate enctype="multipart/form-data">
                @if (!empty($anggota))
                    <input type="hidden" name="id" value="{{ $anggota->id }}">
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
                        <input type="hidden" name="kode" value="{{ $anggota->kode }}">
                        <button type="submit" name="type" class="btn btn-primary" value="update">Ubah Data</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-4 widget-block widget-break-lg">
        @include('layouts.social-component.widget.banner')
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
                url: "{{ url('/api/get-gudep-wilayah') }}"+'/'+kecamatan,
                type: "GET",
                success: function(data){
                    // console.log(data);
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


