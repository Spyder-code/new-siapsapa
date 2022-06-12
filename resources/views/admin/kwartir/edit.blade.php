@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Kwartir', 'url' => route('kwartir.index', ['id_wilayah'=>$id_wilayah])],
            ['name' => 'Edit', 'url' => '#'],
        ]"

        :title="'Edit Wilayah '.$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Edit wilayah '.$kwartir.' '. ucfirst(strtolower($title))"
    />
</div>
@endsection
@section('content')
@php
    $len = strlen($id_wilayah);
    if ($len==2) {
        $name = 'no_prov';
    }elseif($len==4){
        $name = 'no_kab';
    }else{
        $name = 'no_kec';
    }
@endphp
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Edit</h4>
            </div>
            <form action="{{ route('kwartir.update', $id_wilayah) }}" method="post" class="card-body row">
                @csrf
                @method('PUT')
                <input type="hidden" name="code" id="code">
                <x-input :name="$name" :id="'code_name'" :col="12" :value="$data->code" :label="'Kode Wilayah'" :type="'text'" :attr="['required']" />
                <x-input :name="'name'" :col="12" :value="$data->name" :label="'Nama Wilayah'" :type="'text'" :attr="['required']" />
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

