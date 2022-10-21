@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Gudep', 'url' => route('gudep.index')],
            ['name' => 'Detail', 'url' => '#'],
        ]"

        :title="$gudep->nama_sekolah"
        :description="'Detail Gudep'"
    />
    <div class="col-md-4 justify-content-end align-self-center d-none d-md-flex gap-2">
        <a href="{{ route('gudep.edit', $gudep) }}" class="btn btn-primary btn-sm">Edit Gudep</a>
        {{-- <form action="{{ route('anggota.export') }}" method="post">
            @csrf
            <button type="submit" name="gudep_id" value="{{ $gudep->id }}" class="btn btn-sm btn-success">Export Anggota</button>
        </form> --}}
        @if (Auth::user()->role == 'gudep')
            <a href="{{ route('anggota.import') }}" class="btn btn-info">Import Anggota Gudep</a>
        @endif
    </div>
    {{-- <div class="col-md-3">
        <div class="d-flex">
            <form action="{{ route('anggota.bulkUpdate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="gudep_id" value="{{ $gudep->id }}">
                <label for="file">Bulk Update Data Anggota (Excel) <br><small>*note: Export Anggota dahulu kemudian update data di excel</small></label>
                <input type="file" name="file" id="file" class="form-control">
                <button type="submit" class="btn btn-sm btn-success">Update</button>
            </form>
        </div>
    </div> --}}
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-lg-6 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-warning border-bottom ">
                <div class="d-flex align-items-center">
                    <div class="row align-items-center">
                        <div>
                            <h5 class="mb-0 text-light">{{ $gudep->nama_sekolah }}</h5>
                        </div>
                        <br><br>
                        <div>
                            <h6 class="mb-0 text-light">KODE NPSN : {{ $gudep->npsn }}</h6>
                        </div>
                    </div>

                    <div class="font-22 ms-auto">
                        {{-- <img src="https://siapsapa.id/assets/images/sekolah.jpg" class="rounded-circle" width="55" height="55"> --}}
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent">
                    <div class="d-flex align-items-center">
                        <a href="">
                            <div class="ms-3">
                                <h6 class="mb-0">Total Seluruh Anggota </h6>
                            </div>
                        </a>
                        <div class="ms-auto ">
                            <span class="badge bg-success"><strong id="total-anggota">-</strong></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item bg-transparent">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <h6 class="mb-0">Total Pengelola Gudep</h6>
                        </div>
                        <div class="ms-auto star">
                            <span class="badge bg-success lg"><strong id="total-admin">-</strong></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-6 d-flex">
        <div class="col radius-10 w-100 ">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body ">
                    <div class="d-flex align-items-center ">
                        <div>
                            <h6 class="mb-0">DANA WALET GUGUS DEPAN</h6>
                            <p></p>
                            <h5 class="mb-0">Rp. 0</h5>
                            <p></p>
                            <p></p>
                            <p></p>
                        </div>
                        <div class="ms-auto"> <i class="bx bx-wallet font-30"></i>
                        </div>

                    </div>
                    <div class="progress radius-10 mt-4" style="height:4.5px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        {{-- <div class="card">
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
        </div> --}}
        <div class="card p-3">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Anggota Kepramukaan
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table text-center table-bordered text-dark" id="tableGolongan">
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
                                            @foreach ($pramuka as $golongan)
                                                @foreach ($golongan->documentTypes as $item)
                                                <tr>
                                                    @php
                                                        $id = $gudep->id;
                                                        $lkk = $golongan->anggotas()->where('gudep',$id)->where('jk','L')->where('status',1)->count();
                                                        $prr = $golongan->anggotas()->where('gudep',$id)->where('jk','P')->where('status',1)->count();
                                                        $count = $item->documents()->whereHas('user', function($q) use($id,$item){
                                                            $q->whereHas('anggota', function($q) use($id,$item){
                                                                $q->where('gudep',$id);
                                                                $q->where('tingkat',$item->id);
                                                                $q->where('status',1);
                                                            });
                                                        })->count();
                                                        $lk = $item->documents()->whereHas('user', function($q) use($id,$item){
                                                            $q->whereHas('anggota', function($q) use($id,$item){
                                                                $q->where('jk', 'L');
                                                                $q->where('tingkat',$item->id);
                                                                $q->where('gudep',$id);
                                                                $q->where('status',1);
                                                            });
                                                        })->count();
                                                        $pr = $item->documents()->whereHas('user', function($q) use($id,$item){
                                                            $q->whereHas('anggota', function($q) use($id,$item){
                                                                $q->where('jk', 'P');
                                                                $q->where('tingkat',$item->id);
                                                                $q->where('gudep',$id);
                                                                $q->where('status',1);
                                                            });
                                                        })->count();
                                                    @endphp
                                                    @if ($loop->iteration==1)
                                                        <td scope="row" class="table-{{ strtolower($golongan->name) }}" rowspan="{{ $golongan->documentTypes->count() }}">
                                                            {{ $golongan->name }} <br><br>
                                                            <span class="fw-normal" style="font-size: .7rem">L: {{ $lkk }}</span><br>
                                                            <span class="fw-normal" style="font-size: .7rem">P: {{ $prr }}</span><br>
                                                            <span class="fw-normal" style="font-size: .7rem">J: {{ $prr+$lkk }}</span>
                                                        </td>
                                                    @endif
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ (int)$lk }}</td>
                                                    <td>{{ (int)$pr }}</td>
                                                    <td>{{ (int)$count }}</td>
                                                    <td><a href="{{ route('anggota.search_document',['id'=>$item->id,'id_wilayah'=>$gudep->id,'role'=>'gudep']) }}" class="btn btn-sm btn-info">Detail</a></td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                            <tr>
                                                <td scope="row">
                                                    Pembantu
                                                </td>
                                                <td>-</td>
                                                <td>{{ $plk }}</td>
                                                <td>{{ $ppr }}</td>
                                                <td>{{ $ppr+$plk }}</td>
                                                <td>-</td>
                                                {{-- <td><a href="{{ route('anggota.search_document',['id'=>$item->id,'id_wilayah'=>5]) }}" class="btn btn-sm btn-info">Detail</a></td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
    </div>
    <div class="col-4">
        {{-- <div class="card">
            <div class="card-body">
                <h4>Anggota Dewasa</h4>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                        <div class="card-header" style="background-color: #804000;">
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
                    <div class="col">
                        <div class="card shadow">
                        <div class="card-header" style="background-color: #9900ff;">
                            <div class="text-white text-center"><strong id="total-pembina">-</strong>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>PEMBINA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                        <div class="card-header" style="background-color: #2fb7cf;">
                            <div class="text-white text-center"><strong id="total-dewasa">-</strong>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <p>PEMBANTU</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-3 p-3">
            <div class="card-header">
                Siaga
            </div>
            <div id="siaga"></div>
            <div class="card-footer">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Putra: <strong id="total-siaga-lk">-</strong></li>
                    <li class="list-group-item">Putri: <strong id="total-siaga-pr">-</strong></li>
                </ul>
            </div>
        </div>
        <div class="card my-3 p-3">
            <div class="card-header">
                Penggalang
            </div>
            <div id="penggalang"></div>
            <div class="card-footer">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Putra: <strong id="total-penggalang-lk">-</strong></li>
                    <li class="list-group-item">Putri: <strong id="total-penggalang-pr">-</strong></li>
                </ul>
            </div>
        </div>
        <div class="card my-3 p-3">
            <div class="card-header">
                Penegak
            </div>
            <div id="penegak"></div>
            <div class="card-footer">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Putra: <strong id="total-penegak-lk">-</strong></li>
                    <li class="list-group-item">Putri: <strong id="total-penegak-pr">-</strong></li>
                </ul>
            </div>
        </div>
        <div class="card my-3 p-3">
            <div class="card-header">
                Pandega
            </div>
            <div id="pandega"></div>
            <div class="card-footer">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Putra: <strong id="total-pandega-lk">-</strong></li>
                    <li class="list-group-item">Putri: <strong id="total-pandega-pr">-</strong></li>
                </ul>
            </div>
        </div>
        <div class="card my-3 p-3">
            <div class="card-header">
                Pelatih
            </div>
            <div id="pelatih"></div>
            <div class="card-footer">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Putra: <strong id="total-pelatih-lk">-</strong></li>
                    <li class="list-group-item">Putri: <strong id="total-pelatih-pr">-</strong></li>
                </ul>
            </div>
        </div>
        <div class="card my-3 p-3">
            <div class="card-header">
                Pembina
            </div>
            <div id="pembina"></div>
            <div class="card-footer">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">Putra: <strong id="total-pembina-lk">-</strong></li>
                    <li class="list-group-item">Putri: <strong id="total-pembina-pr">-</strong></li>
                </ul>
            </div>
        </div> --}}
        <div class="card my-3 p-3">
            <h4 class="card-title mb-0">List Admin</h4>
            <hr>
            <ol class="list-group list-group-numbered" id="list-admin"></ol>
        </div>
    </div>
    <div class="col-12">
        <div class="card p-3 my-3">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Anggota</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
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
@include('components.dashboard-gudep',['id_wilayah' => $id_wilayah, 'gudep' => $gudep->id])
<script>
    var table = $(".file-export").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('datatable.gudep.anggota') !!}',
            type: 'GET',
            data: {
                gudep: {!! json_encode($gudep->id) !!},
                active: 'all'
            },
        },
        columns: [
            {data: 'foto', name: 'foto', searchable: false, orderable: false},
            {data: 'nik', name: 'tb_anggota.nik', visible: false},
            {data: 'nama', name: 'tb_anggota.nama'},
            {data: 'jk', name: 'jk', searchable: false, orderable: false},
            {data: 'kabupaten', name: 'kabupaten', searchable: false, orderable: false},
            {data: 'kecamatan', name: 'kecamatan', searchable: false, orderable: false},
            {data: 'status', name: 'status', searchable: false, orderable: false},
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

    // $.ajax({
    //     url: {!! json_encode(url('api/get-number-of-pramuka-gudep')) !!}+'/'+{!! json_encode($gudep->id) !!},
    //     type: 'GET',
    //     success: function(data) {
    //         $('#total-siaga').html(data.siaga);
    //         $('#total-penggalang').html(data.penggalang);
    //         $('#total-penegak').html(data.penegak);
    //         $('#total-pandega').html(data.pandega);
    //         $('#total-dewasa').html(data.dewasa);
    //         $('#total-pelatih').html(data.pelatih);
    //     }
    // });

    const number_of_member = () => {
        $.ajax({
            url: {!! json_encode(url('api/get-number-of-member')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            data:{gudep:@json($gudep->id)},
            success: function(data) {
                console.log(data);
                $('#total-anggota').html(data.anggota);
                $('#total-admin').html(data.admin);
            }
        });
    }

    const admin = () => {
        $.ajax({
            url: {!! json_encode(url('api/get-admin-gudep')) !!}+'/'+{!! json_encode($gudep->id) !!},
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

    admin();
    number_of_member();

    let addAdmin = (anggota_id) => {
        $.ajax({
            url: {!! json_encode(url('api/add-admin-gudep')) !!},
            type: 'POST',
            data: {
                anggota_id: anggota_id,
            },
            success: function(data) {
                number_of_member();
                admin();
                table.ajax.reload();
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
                number_of_member();
                admin();
                table.ajax.reload();
            }
        });
    }

</script>
@endsection

