@extends('layouts.profile')
@section('content-user')
    <div class="card">
        <form action="{{ route('user.update', $user) }}" method="post" class="card-body needs-validation" novalidate>
            @csrf
            @method('PUT')
            <x-input :name="'old_password'" :type="'password'" :label="'Password Lama'" :col="12" :attr="['required']"/>
            <x-input :name="'password'" :type="'password'" :label="'Password Baru'" :col="12" :attr="['required']"/>
            <x-input :name="'password_confirmation'" :type="'password'" :label="'Konfirmasi Password'" :col="12" :attr="['required']"/>
            <div class="mb-3 btn-group my-3 ml-4" id="confirm">
                <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
