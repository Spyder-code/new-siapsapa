@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        tr.selected{
            background-color: #34ff89ab;
        }
    </style>
@endsection
@section('breadcrumb')
@php
    $title = ' Dokumen '.ucfirst($documentType->name);
@endphp
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Anggota', 'url' => '#'],
        ]"

        :title="ucfirst($title)"
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
            {{-- <a href="{{ route('anggota.create',['type'=>$type]) }}" class="btn btn-success">
                <i data-feather="plus" class="fill-white feather-sm"></i>
                Tambah Data
            </a> --}}
        </div>
    </div>
</div>
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Anggota</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nik</th>
                                <th>Nama Lengkap</th>
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

@endsection

@section('script')
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            scrollY: '500px',
            ajax: {
            url: '{!! route('datatable.anggota.search_document') !!}',
            type: 'GET',
            data: {
                    document_type_id: @json($id),
                    user_id: @json(Auth::id())
                },
            },
            columns: [
                {data: 'foto', name: 'foto'},
                {data: 'nik', name: 'nik', visible: false},
                {data: 'nama', name: 'nama'},
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
    </script>
@endsection
