@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Kwartir '.ucfirst(strtolower($title)), 'url' => route('kwartir.index', ['id_wilayah'=>$id_wilayah])],
            ['name' => 'Anggota', 'url' => '#'],
        ]"

        :title="'Wilayah '.$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Data Anggota wilayah '.$kwartir.' '. ucfirst(strtolower($title))"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">Total Anggota: <strong id="total-anggota">-</strong></li>
            <li class="list-group-item">Total Admin: <strong id="total-admin">-</strong></li>
        </ul>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Anggota</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Email</th>
                                <th>Nama Lengkap</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <h4 class="card-title mb-0">List Admin</h4>
        <hr>
        <ol class="list-group list-group-numbered" id="list-admin"></ol>
    </div>
</div>
@endsection

@section('script')
    <script>
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: '{!! route('datatable.kwartir.anggota') !!}',
            type: 'GET',
            data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                },
            },
            columns: [
                {data: 'foto', name: 'foto', searchable: false},
                {data: 'email', name: 'email'},
                {data: 'nama', name: 'nama'},
                {data: 'action', name: 'action', searchable: false, orderable: false},
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

            $.ajax({
                url: {!! json_encode(url('api/get-admin')) !!}+'/'+{!! json_encode($id_wilayah) !!},
                type: 'GET',
                success: function(data) {
                    var data = data.data;
                    $('#list-admin').html('');
                    $.each(data, function(index, value) {
                        $('#list-admin').append(
                            `<li class="list-group-item d-flex justify-content-between align-items-start">
                                <div div class="ms-2 me-auto">
                                    <div class="fw-bold">${value.nama}</div>
                                    ${value.email}
                                </div>
                                <span class="badge bg-danger rounded-pill">Hapus Role</span>
                            </li>`
                        );
                    });
                }
            });
        });
    </script>
@endsection
