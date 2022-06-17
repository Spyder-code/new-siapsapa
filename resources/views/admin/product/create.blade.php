@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Produk', 'url' => '#'],
            ['name' => 'Create', 'url' => '#'],
        ]"

        :title="'Tambah Produk'"
        :description="'Form Pendaftaran Produk'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Form</h4>
            </div>
            <form action="{{ route('product.store') }}" method="post" class="card-body needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="status" value="0">
                @include('admin.product.form')
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

