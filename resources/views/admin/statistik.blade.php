@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/libs/apexcharts/dist/apexcharts.css" />
@endsection
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
                    <a href="{{ route('kwartir.anggota',$id_wilayah) }}" style="font-size: .8rem" class="btn btn-sm btn-outline-success">
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
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <h4>Anggota Muda</h4>
                <hr>
                <div class="row row-cols-1 row-cols-md-4 row-cols-xl-4">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header bg-success">
                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center"><strong id="total-siaga">-</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>SIAGA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header bg-danger">
                                <div class="text-white text-center"><strong id="total-penggalang">-</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>PENGGALANG</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header bg-warning">
                                <div class="text-white text-center"><strong id="total-penegak">-</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>PENEGAK</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header" style="background-color: #e67300;">
                                <div class="text-white text-center"><strong id="total-pandega">-</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>PANDEGA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body">
                <h4>Anggota Dewasa</h4>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                        <div class="card-header" style="background-color: #804000;">
                            <div class="text-white text-center"><strong id="total-dewasa">-</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>DEWASA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                        <div class="card-header" style="background-color: #9900ff;">
                            <div class="text-white text-center"><strong id="total-pelatih">-</strong>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>PELATIH</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cards">
    <div class="row">
        <div class="col-8">
            <div class="card p-3 my-3">
                <div id="total-laporan" style="height: 300px"></div>
            </div>
            <div class="card p-3 my-3">
                <div id="insert-data" style="height: 300px"></div>
            </div>
            <div class="card p-3 my-3">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">List Anggota</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped file-export" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
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
        <div class="col-4">
            <div class="card my-3 p-3">
                <div id="siaga"></div>
            </div>
            <div class="card my-3 p-3">
                <div id="penggalang"></div>
            </div>
            <div class="card my-3 p-3">
                <div id="penegak"></div>
            </div>
            <div class="card my-3 p-3">
                <div id="pandega"></div>
            </div>
            <div class="card my-3 p-3">
                <div id="dewasa"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @include('components.dashboard',['id_wilayah' => $id_wilayah])
    <script>
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            scrollY: '300px',
            ajax: {
            url: '{!! route('datatable.kwartir.anggota') !!}',
            type: 'GET',
            data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                },
            },
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'email', name: 'email'},
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
    </script>
@endsection
