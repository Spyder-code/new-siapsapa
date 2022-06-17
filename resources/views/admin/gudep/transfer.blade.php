@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Gudep', 'url' => '#'],
            ['name' => 'Transfer', 'url' => '#'],
        ]"

        :title="'Transfer Anggota di '. $gudep->nama_sekolah"
        :description="'Anggota Transfer'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-7">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Form</h4>
            </div>
            <form action="{{ route('gudep.transfer.store') }}" method="post" class="card-body needs-validation" novalidate>
                @csrf
                @method('PUT')
                <input type="hidden" name="gudep" value="{{ $gudep->id }}">
                <div class="row">
                    <x-input :type="'email'" :name="'email'" :label="'Email Anggota'" :attr="['required']"/>
                    <x-input :type="'password'" :name="'password'" :label="'Password Anggota'" :attr="['required']"/>
                </div>
                <div class="mb-3 btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-outline-primary">Transfer Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection

