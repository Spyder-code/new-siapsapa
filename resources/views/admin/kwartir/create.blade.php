@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Kwartir', 'url' => route('kwartir.index', ['id_wilayah'=>$id_wilayah])],
            ['name' => 'Edit', 'url' => '#'],
        ]"

        :title="'Tambah Wilayah '.$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Tambah wilayah '.$kwartir.' '. ucfirst(strtolower($title))"
    />
</div>
@endsection
@section('content')
@php
    $len = strlen($id_wilayah);
    if ($len==2) {
        $name = 'no_kab';
    }elseif($len==4){
        $name = 'no_kec';
    }
@endphp
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Tambah</h4>
            </div>
            <form action="{{ route('kwartir.store') }}" method="post" class="card-body row">
                @csrf
                <input type="hidden" name="code" id="code">
                <input type="hidden" name="id_wilayah" id="id_wilayah" value="{{ $id_wilayah }}">
                <x-input :name="$name" :id="'code_name'" :col="12" :label="'Kode Wilayah'" :type="'text'" :attr="['required']" />
                <x-input :name="'name'" :col="12" :label="'Nama Wilayah'" :type="'text'" :attr="['required']" />
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
        $('#code_name').keyup(function (e) {
            var val = $(this).val();
            $('#code').val(val);
        });
    </script>
@endsection

