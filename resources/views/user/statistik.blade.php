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
                    <ul class="list-group list-group-horizontal justify-content-center">
                        <li class="list-group-item">Total Siaga: <strong id="total-siaga">-</strong></li>
                        <li class="list-group-item">Total Penggalang: <strong id="total-penggalang">-</strong></li>
                        <li class="list-group-item">Total Penegak: <strong id="total-penegak">-</strong></li>
                        <li class="list-group-item">Total Pandega: <strong id="total-pandega">-</strong></li>
                        <li class="list-group-item">Total Dewasa: <strong id="total-dewasa">-</strong></li>
                        <li class="list-group-item">Total pelatih: <strong id="total-pelatih">-</strong></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped file-export" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Kode {{ $len>4 ? 'Sekolah' : '' }}</th>
                                            <th>Nama {{ $len>4 ? 'Gudep' : '' }}</th>
                                            <th>Jumlah Admin</th>
                                            <th>Jumlah Anggota</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
    <script>
        var column;
        if(@json($len>4)){
            column = [
                {data: 'npsn', name: 'npsn'},
                {data: 'nama_sekolah', name: 'nama_sekolah'},
                {data: 'admin', name: 'admin', searchable: false,},
                {data: 'anggota', name: 'anggota', searchable: false,},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        }else{
            column = [
                {data: 'code', name: 'code', searchable: false,},
                {data: 'name', name: 'name'},
                {data: 'admin', name: 'admin', searchable: false,},
                {data: 'anggota', name: 'anggota', searchable: false,},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        }
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: '{!! route('datatable.kwartir.statistik') !!}',
            type: 'GET',
            data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                },
            },
            columns: column,
            dom: "Bfrtip",
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: ["pageLength","copy", "csv", "excel", "pdf", "print"],
            "bLengthChange": true,
        });

        $(".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-collection ")
        .addClass("btn btn-primary");
        $(".buttons-collection ").addClass("btn btn-info m-1");

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

        $.ajax({
            url: {!! json_encode(url('api/get-number-of-pramuka')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            success: function(data) {
                $('#total-siaga').html(data.siaga);
                $('#total-penggalang').html(data.penggalang);
                $('#total-penegak').html(data.penegak);
                $('#total-pandega').html(data.pandega);
                $('#total-dewasa').html(data.dewasa);
                $('#total-pelatih').html(data.pelatih);
            }
        });
    </script>
@endsection
