@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <div class="col-md-5 align-self-center">
        <h3 class="page-title">Profile</h3>
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class=" col-md-7 justify-content-end align-self-center d-none d-md-flex ">
        <div class="d-flex">
            <div class="dropdown me-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                January 2021
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">February 2021</a></li>
                    <li><a class="dropdown-item" href="#">March 2021</a></li>
                    <li><a class="dropdown-item" href="#">April 2021</a></li>
                </ul>
            </div>
            <button class="btn btn-success">
                <i data-feather="plus" class="fill-white feather-sm"></i>
                Create
            </button>
        </div>
    </div>
</div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, doloremque? Alias cupiditate accusantium omnis tempora, similique nobis quam, aliquid quod eum voluptas expedita. Soluta esse vitae excepturi ipsum maxime ea.</p>
        </div>
    </div>
@endsection
