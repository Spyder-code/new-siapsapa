@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Anggota', 'url' => '#'],
        ]"

        :title="strtoupper($gudep->nama_sekolah)"
        :description="'List Anggota '"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex gap-2">
        @if (Auth::user()->role == 'gudep')
        <a href="{{ route('anggota.import') }}" class="btn btn-info">Import Anggota Gudep</a>
        @endif
        <a href="{{ route('anggota.create') }}" class="btn btn-success">
            <i data-feather="plus" class="fill-white feather-sm"></i>
            Tambah Data
        </a>
    </div>
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
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
                                <th>nik</th>
                                <th>Nomor Anggota</th>
                                <th>Nama Lengkap</th>
                                <th>Tgl Lahir</th>
                                <th>Gender</th>
                                <th>Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Status</th>
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
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">List Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ol class="list-group list-group-numbered" id="list-admin"></ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            keyboard: false
        })
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            scrollY: '500px',
            ajax: {
            url: '{!! route('datatable.gudep.anggota') !!}',
            type: 'GET',
            data: {
                    gudep: {!! json_encode($gudep->id) !!},
                    active: @json($active)
                },
            },
            columns: [
                {data: 'foto', name: 'foto'},
                {data: 'nik', name: 'nik', visible: false},
                {data: 'kode', name: 'kode'},
                {data: 'nama', name: 'nama'},
                {data: 'tgl_lahir', name: 'tgl_lahir'},
                {data: 'jk', name: 'jk'},
                {data: 'kabupaten', name: 'kabupaten'},
                {data: 'kecamatan', name: 'kecamatan'},
                {data: 'status', name: 'status'},
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

        let showAdmin = (id_wilayah, type = null) => {
            if(type==null){
                var url = {!! json_encode(url('api/get-admin')) !!}+'/'+id_wilayah;
            }else{
                var url = {!! json_encode(url('api/get-admin-gudep')) !!}+'/'+id_wilayah;
            }
            $.ajax({
                url: url,
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
                                <button onclick="deleteAdmin(${value.id})" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-trash-alt"></i></button>
                            </li>`
                        );
                    });
                    myModal.show();
                }
            });
        }

        let deleteAdmin = (anggota_id) => {
            myModal.hide();
            $.ajax({
                url: {!! json_encode(url('api/delete-admin')) !!},
                type: 'PUT',
                data: {
                    anggota_id: anggota_id,
                },
                success: function(data) {
                    table.ajax.reload();
                }
            });
        }

        let deleteGudep = (gudep) => {
            if(confirm('Are you sure?')){
                $.ajax({
                    url: {!! json_encode(url('api/delete-gudep')) !!},
                    type: 'DELETE',
                    data: {
                        gudep: gudep,
                    },
                    success: function(data) {
                        table.ajax.reload();
                    }
                });
            }
        }

        let deleteAnggota = (id_anggota) => {
            if(confirm('Are you sure?')){
                $.ajax({
                    url: {!! json_encode(url('api/anggota-delete')) !!},
                    type: 'DELETE',
                    data: {
                        id_anggota: id_anggota,
                    },
                    success: function(data) {
                        table.ajax.reload();
                    }
                });
            }
        }

        let validasi = (id) => {
            if(confirm('Apakah anda yakin?')){
                $.ajax({
                    url: {!! json_encode(url('api/anggota-validate')) !!},
                    type: 'PUT',
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // alert
                        alert('Anggota berhasil divalidasi');
                        table.ajax.reload();
                    }
                });
            }
        }
    </script>
@endsection
