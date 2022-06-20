@extends('layouts.error')
@section('title', '404')
@section('content')
<div class="error-box">
    <div class="error-body text-center">
        <h1 class="error-title text-info">403</h1>
        <h3 class="text-uppercase error-subtitle">
        FORBIDDON ERROR!
        </h3>
        <p class="text-muted mt-4 mb-4">YOU DON'T HAVE PERMISSION TO ACCESS ON THIS SERVER.</p>
        <a
            href="{{ url('/') }}"
            class="btn btn-danger btn-rounded waves-effect waves-light mb-5"
        >
        Back to home
        </a>
    </div>
</div>
@endsection
