@extends('layouts.newuser')
@section('content')
    <section class="hero-banner">
        <div class="container text-center">
            <h1 class="text-white">{{ $kwartir.' '.ucfirst($title) }}</h1>
            <h3>Data Statistik {{ strtolower($kwartir).' '. ucfirst($title) }}</h3>
            <ul class="list-group list-group-horizontal justify-content-center">
                <li class="list-group-item">Total Anggota: <strong id="total-anggota">-</strong></li>
                <li class="list-group-item">Total Admin: <strong id="total-admin">-</strong></li>
            </ul>
        </div>
    </section>
    <section class="why-choose-us">
        <div class="container mb-5">
            @php
                $len = strlen($id_wilayah);
            @endphp
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="response"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
    <script>
            var url = @json(url('api/get-table-anggota-muda'));
            $.ajax({
                type: "GET",
                url: url,
                data: {id_wilayah:@json($id_wilayah),role:@json($role)},
                success: function (response) {
                    $('#response').html(response);
                }
            });
            $.ajax({
            url: {!! json_encode(url('api/get-number-of-member')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            success: function(data) {
                $('#total-anggota').html(data.anggota);
                $('#total-admin').html(data.admin);
            },error:function(data){
                console.log(data);
            }
        });
    </script>
@endsection
