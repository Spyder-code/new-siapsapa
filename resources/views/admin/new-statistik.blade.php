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

        :title="$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Data statistik'.$kwartir.' '. ucfirst($title)"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">Total Anggota: <strong id="total-anggota">-</strong></li>
            @if($id_wilayah!='all')
                <li class="list-group-item">Total Admin: <strong id="total-admin">-</strong></li>
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
<style>
    td.table-pembina{
        background-color: #7f440860;
        vertical-align: middle;
    }
    td.table-pelatih{
        background-color: #2fb7cfab;
        vertical-align: middle;
    }
    td.table-siaga{
        background-color: #2fd94852;
        vertical-align: middle;
    }
    td.table-penggalang{
        background-color: #e21a1a8b;
        vertical-align: middle;
    }
    td.table-penegak{
        background-color: #e28b1a8b;
        vertical-align: middle;
    }
    td.table-pandega{
        background-color: #dbe21a8b;
        vertical-align: middle;
    }
    tr.td,tr{
        background-color: white;
    }
</style>
<div class="cards">
    <div class="row">
        <div class="col-8">

            {{-- Kwartir --}}
            <div class="card">
                <div class="card-body">
                    <h4>{{ $kwartir.' '.ucfirst(strtolower($title)) }}</h4>
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
                                        <p>TOTAL ANGGOTA AKTIF</p>
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
                                        <p>KWARTIR CABANG</p>
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
                                        <p>KWARTIR RANTING</p>
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
                                        <p>GUGUS DEPAN</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card accordion" id="accordionExample">
                <div class="accordion-item">
                    <h4 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Statistik Golongan Anggota
                        </button>
                    </h4>

                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body table-responsive bg-white">
                            <div class="card-header d-flex justify-content-between">
                                #
                                <div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                                    <button type="button" class="btn btn-sm btn-success" onclick="statistikAnggota()"><i class="fas fa-download"></i> Download</button>
                                </div>
                            </div>
                            <table class="table text-center table-bordered text-dark" id="tableData">
                                <thead>
                                    <tr>
                                        <th class="table-secondary" scope="col" colspan="2">Golongan</th>
                                        <th class="table-secondary" scope="col">Laki-laki</th>
                                        <th class="table-secondary" scope="col">Perempuan</th>
                                        <th class="table-secondary" scope="col">Jumlah</th>
                                        <th class="table-secondary" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $pramuka)
                                        @foreach ($pramuka->documentTypes as $item)
                                        <tr>
                                            @if ($loop->iteration==1)
                                            @php
                                                $lkk = $pramuka->anggotas()->where('jk','L')->count();
                                                $prr = $pramuka->anggotas()->where('jk','P')->count();
                                                $lk_count = 0;
                                                $pr_count = 0;
                                            @endphp
                                            <td scope="row" class="table-{{ strtolower($pramuka->name) }}" rowspan="{{ $pramuka->documentTypes->count() }}">
                                                {{ $pramuka->name }} <br><br>
                                                <span class="fw-normal" style="font-size: .7rem">L: {{ $lkk }}</span><br>
                                                <span class="fw-normal" style="font-size: .7rem">P: {{ $prr }}</span><br>
                                                <span class="fw-normal" style="font-size: .7rem">J: {{ $prr+$lkk }}</span>
                                            </td>
                                            @endif
                                            <td>{{ $item->name }}</td>
                                                @php
                                                    $lk = $item->documents()->whereHas('user', function($q){
                                                        $q->whereHas('anggota', function($q){
                                                            $q->where('jk', 'L');
                                                        });
                                                    })->count();
                                                    $pr = $item->documents()->whereHas('user', function($q){
                                                        $q->whereHas('anggota', function($q){
                                                            $q->where('jk', 'P');
                                                        });
                                                    })->count();
                                                @endphp
                                            <td>{{ $lk }}</td>
                                            <td>{{ $pr }}</td>
                                            <td>{{ $item->documents->count() }}</td>
                                            <td><a href="" class="btn btn-sm btn-info">Detail</a></td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card accordion" id="accordionDewasa">
                <div class="accordion-item">
                    <h4 class="accordion-header" id="headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Statistik SAKA
                        </button>
                    </h4>

                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionDewasa">
                        <div class="accordion-body table-responsive">
                            <div class="card-header d-flex justify-content-between">
                                #
                                <div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                                    <button type="button" class="btn btn-sm btn-success" onclick="statistikAnggota()"><i class="fas fa-download"></i> Download</button>
                                </div>
                            </div>
                            <table class="table text-center table-bordered text-dark" id="tableData">
                                <thead>
                                    <tr>
                                        <th class="table-secondary" scope="col">Golongan</th>
                                        <th class="table-secondary" scope="col">Laki-laki</th>
                                        <th class="table-secondary" scope="col">Perempuan</th>
                                        <th class="table-secondary" scope="col">Jumlah</th>
                                        <th class="table-secondary" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saka as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                                @php
                                                    $lk = $item->documents()->whereHas('user', function($q){
                                                        $q->whereHas('anggota', function($q){
                                                            $q->where('jk', 'L');
                                                        });
                                                    })->count();
                                                    $pr = $item->documents()->whereHas('user', function($q){
                                                        $q->whereHas('anggota', function($q){
                                                            $q->where('jk', 'P');
                                                        });
                                                    })->count();
                                                @endphp
                                            <td>{{ $lk }}</td>
                                            <td>{{ $pr }}</td>
                                            <td>{{ $item->documents->count() }}</td>
                                            <td><a href="" class="btn btn-sm btn-info">Detail</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Statistik Anggota
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="total-laporan">
                </div>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Jumlah Anggota
                    <button type="button" class="btn btn-sm btn-info" onclick="jumlahAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="insert-data"></div>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Statistik Golongan Darah
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikDarah()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="total-darah"></div>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Statistik Agama
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAgama()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="total-agama"></div>
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
                <h4 class="card-title mb-0">List Admin</h4>
                <hr>
                <ol class="list-group list-group-numbered" id="list-admin"></ol>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Fungsionaris Organisasi
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="organisasi" class="mt-2">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($organizations as $item)
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">{{ $item->name }}</li>
                            <li class="list-group-item">{{ $item->organizationUsers->count() }}</li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {{-- @include('components.dashboard',['id_wilayah' => $id_wilayah, 'gudep' => 0]) --}}
    <script src="{{ asset('js/excelexportjs.js') }}"></script>
    <script>
        // $("#tableData").excelexportjs({
        //     containerid: "tableData",
        //     datatype: 'table'
        // });
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

        let list_admin = () =>{
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
                                    <button onclick="deleteAdmin(${value.id})" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-trash-alt"></i></button>
                                </li>`
                            );
                        });
                    }
                });
        }

        let deleteAdmin = (anggota_id) => {
            $.ajax({
                url: {!! json_encode(url('api/delete-admin')) !!},
                type: 'PUT',
                data: {
                    anggota_id: anggota_id,
                },
                success: function(data) {
                    list_admin();
                    total_anggota();
                    table.ajax.reload();
                }
            });
        }

        let addAdmin = (anggota_id) => {
            $.ajax({
                url: {!! json_encode(url('api/add-admin')) !!},
                type: 'POST',
                data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                    anggota_id: anggota_id,
                },
                success: function(data) {
                    list_admin();
                    total_anggota();
                    table.ajax.reload();
                }
            });
        }
        list_admin();
    </script>
@endsection
