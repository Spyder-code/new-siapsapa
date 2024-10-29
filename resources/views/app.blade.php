@extends('layouts.newuser')
@section('content')
<style>
    .card-sistem{
        border-radius: 10px;
        /* height: 200px; */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .card-sistem:hover{
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        transform: scale(1.01);
        transition: 0.3s;
    }
</style>
 <section class="hero-banner">
     <div class="container">
         <div class="login-page-wrap">
             <div class="content-wrap">
                 <div class="row text-center" style="position:fixed; top:50%; left:50%; transform:translate(-50%,-50%);">
                     <div class="col-12 col-md-6">
                         <a href="{{ route('login') }}" class="bg-white p-3 card-sistem">
                             <img src="{{ asset('images/pramuka.jpg') }}" alt="">
                             <h4 class="mt-4 text-primary">Sistem Pramuka</h4>
                         </a>
                     </div>
                     <div class="col-12 col-md-6">
                         <a href="{{ env('URL_SEKOLAH') }}" class="bg-white p-3 card-sistem">
                             <img src="{{ asset('images/sekolah.jpg') }}" alt="">
                             <h4 class="mt-4 text-primary">Sistem Sekolah</h4>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
@endsection
