@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Gudep', 'url' => '#'],
            ['name' => 'Create', 'url' => '#'],
        ]"

        :title="'Registrasi Gudep'"
        :description="'Form Pendaftaran Gudep'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Registrasi Gudep</h4>
            </div>
            <form action="{{ route('gudep.store') }}" method="post" class="card-body needs-validation" novalidate>
                @csrf
                <input type="hidden" name="status" value="1">
                @include('admin.gudep.form',['wilayah'=>$data])
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
<script>
    $(document).ready(function(){
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
    });
</script>
@endsection

