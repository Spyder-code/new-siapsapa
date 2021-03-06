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
            {{-- success message--}}
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            {{-- error validation --}}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-horizontal mt-3 form-material" id="loginform" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <div class="col-xs-12">
                        <input class="form-control" type="email" name="email" required placeholder="Email"/>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" required placeholder="Password" id="password"/><span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex">
                        <div class="checkbox checkbox-info pt-0">
                            <input id="checkbox-signup" type="checkbox" name="remember" value="true" class="material-inputs chk-col-indigo" />
                            <label for="checkbox-signup"> Remember me </label>
                        </div>
                        <div class="ms-auto">
                            <a href="javascript:void(0)" id="to-recover" class="link font-weight-medium" >
                                <i class="fa fa-lock me-1"></i> Forgot pwd?
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center my-3">
                    <div class="col-xs-12">
                        <button class=" btn btn-info d-block w-100 waves-effect waves-light " type="submit">
                            Log In
                        </button>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="col-sm-12 justify-content-center d-flex">
                        <p>Belum memiliki akun? <a href="{{ route('register') }}" class="text-info font-weight-medium ms-1" >Register</a ></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="recoverform">
    <div class="logo">
        <h3 class="font-weight-medium mb-3">Recover Password</h3>
        <span>Enter your Email and instructions will be sent to you!</span>
    </div>
    <div class="row mt-3">
    <!-- Form -->
        <form class="col-12 form-material" method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- email -->
            <div class="form-group row">
                <div class="col-12">
                    <input class="form-control" type="email" name="email" placeholder="Email" />
                </div>
            </div>
            <!-- pwd -->
            <div class="row mt-3">
                <div class="col-12">
                    <button class="btn d-block w-100 btn-primary text-uppercase" type="submit" name="action" > Reset </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
