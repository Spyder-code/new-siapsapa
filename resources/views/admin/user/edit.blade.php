@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'User', 'url' => '#'],
            ['name' => 'Edit', 'url' => '#'],
        ]"

        :title="'Profile Akun'"
        :description="'Detail Akun'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Detail Akun</h4>
            </div>
            <form action="{{ route('user.update', $user) }}" method="post" class="card-body needs-validation" novalidate>
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <x-input :name="'old_password'" :type="'password'" :label="'Password Lama'" :col="12" :attr="['required']"/>
                <x-input :name="'password'" :type="'password'" :label="'Password Baru'" :col="12" :attr="['required']"/>
                <x-input :name="'password_confirmation'" :type="'password'" :label="'Konfirmasi Password'" :col="12" :attr="['required']"/>
                <div class="mb-3 btn-group my-3 ml-4" id="confirm">
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

