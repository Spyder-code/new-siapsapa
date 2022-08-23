@extends('layouts.admin')
@section('breadcrumb')
@php
    $title = $kwartir.' '.ucfirst(strtolower($title));
    if(Auth::user()->role=='gudep'){
        $title = Auth::user()->anggota->gudepInfo->nama_sekolah;
    }
@endphp
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Anggota', 'url' => '#'],
        ]"

        :title="$title"
        :description="'Daftar Anggota '.$title"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <div class="d-flex">
            {{-- <div class="dropdown me-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                January 2021
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">February 2021</a></li>
                    <li><a class="dropdown-item" href="#">March 2021</a></li>
                    <li><a class="dropdown-item" href="#">April 2021</a></li>
                </ul>
            </div> --}}
            {{-- <a href="{{ route('anggota.create') }}" class="btn btn-success">
                <i data-feather="plus" class="fill-white feather-sm"></i>
                Tambah Data
            </a> --}}
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Anggota Belum di validasi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nik</th>
                                <th>Nomor Anggota</th>
                                <th>Nama Lengkap</th>
                                <th>Tgl Lahir</th>
                                <th>Gender</th>
                                <th>Kabupaten</th>
                                <th>Kecamatan</th>
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
@endsection

@section('script')
    <script>
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            scrollY: '500px',
            ajax: {
            url: '{!! route('datatable.anggota.non_validate') !!}',
            type: 'GET',
            data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
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

        let tolak = (id) => {
            if(confirm('Apakah anda yakin?')){
                $.ajax({
                    url: {!! json_encode(url('api/anggota-reject')) !!},
                    type: 'PUT',
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // alert
                        alert('Validasi anggota berhasil ditolak');
                        table.ajax.reload();
                    }
                });
            }
        }
    </script>
@endsection
