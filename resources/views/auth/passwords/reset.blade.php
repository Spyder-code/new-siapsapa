@extends('layouts.auth')
@section('content')
<div id="loginform">
    <div class="logo text-center">
        <span class="db">
            <img src="{{ asset('images/logo.png') }}" alt="logo" /><br />
            <span class="rainbow-text">SIAPSAPA</span>
        </span>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal mt-3 form-material" id="loginform" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group mb-3">
                    <div class="col-xs-12">
                        <input class="form-control" type="email" value="{{ $email ?? old('email') }}" name="email" required placeholder="Email"/>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" required placeholder="Password" id="password"/><span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password_confirmation" required placeholder="Konfirmasi Password"/>
                    </div>
                </div>
                <div class="form-group text-center my-3">
                    <div class="col-xs-12">
                        <button class=" btn btn-info d-block w-100 waves-effect waves-light " type="submit">
                            Reset Password
                        </button>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="col-sm-12 justify-content-center d-flex">
                        <p>Sudah memiliki akun? <a href="{{ route('login') }}" class="text-info font-weight-medium ms-1" >Login</a ></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

