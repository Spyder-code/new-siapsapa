@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Kwartir', 'url' => route('kwartir.index', ['id_wilayah'=>$id_wilayah])],
        ]"

        :title="'Wilayah '.$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Data statistik wilayah '.$kwartir.' '. ucfirst(strtolower($title))"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">Total Anggota: <strong id="total-anggota">-</strong></li>
            <li class="list-group-item">Total Admin: <strong id="total-admin">-</strong></li>
            @if($id_wilayah!='all')
                <li class="list-group-item">
                    <a href="" style="font-size: .8rem" class="btn btn-sm btn-outline-success">
                        <i class="fa fa-plus-circle"></i> Tambah admin
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <ul class="list-group list-group-horizontal">
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
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Wilayah</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jumlah Admin</th>
                                <th>Jumlah Anggota</th>
                                <th>Detail</th>
                                <th>Tool</th>
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
@endsection

@section('script')
    <script>
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: '{!! route('datatable.kwartir') !!}',
            type: 'GET',
            data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                },
            },
            columns: [
                {data: 'code', name: 'code', searchable: false,},
                {data: 'name', name: 'name'},
                {data: 'admin', name: 'admin', searchable: false,},
                {data: 'anggota', name: 'anggota', searchable: false,},
                {data: 'action', name: 'action', searchable: false, orderable: false},
                {data: 'tools', name: 'tools', searchable: false, orderable: false},
            ],
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

        $(document).ready(function() {
            $.ajax({
                url: {!! json_encode(url('api/get-number-of-member')) !!}+'/'+{!! json_encode($id_wilayah) !!},
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#total-anggota').html(data.anggota);
                    $('#total-admin').html(data.admin);
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                url: {!! json_encode(url('api/get-number-of-pramuka')) !!}+'/'+{!! json_encode($id_wilayah) !!},
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#total-siaga').html(data.siaga);
                    $('#total-penggalang').html(data.penggalang);
                    $('#total-penegak').html(data.penegak);
                    $('#total-pandega').html(data.pandega);
                    $('#total-dewasa').html(data.dewasa);
                    $('#total-pelatih').html(data.pelatih);
                }
            });
        });
    </script>
@endsection
