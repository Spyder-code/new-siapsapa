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
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <a href="{{ route('gudep.edit', $gudep) }}" class="btn btn-info">Edit Gudep</a>
    </div>
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
                            <h5 class="mb-0 text-light">SD Negeri 4 Dauh Peken</h5>
                        </div>
                        <br><br>
                        <div>
                            <h6 class="mb-0 text-light">KODE NPSN : &nbsp;50101090</h6>
                        </div>
                    </div>

                    <div class="font-22 ms-auto"><img src="https://siapsapa.id/assets/images/sekolah.jpg" class="rounded-circle" width="55" height="55">
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent">
                    <div class="d-flex align-items-center">
                        <a href="">
                            <div class="ms-3">
                                <h6 class="mb-0">Anggota </h6>
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
                            <h6 class="mb-0">Pengelola </h6>
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
        <div class="card my-3">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Anggota</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
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
        <div class="card p-3">
            <h4 class="card-title mb-0">List Pengelola</h4>
            <hr>
            <ol class="list-group list-group-numbered" id="list-admin"></ol>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var table = $(".file-export").DataTable({
        processing: true,
        serverSide: true,
        scrollY: '200px',
        ajax: {
            url: '{!! route('datatable.gudep.anggota') !!}',
            type: 'GET',
            data: {
                gudep: {!! json_encode($gudep->id) !!},
            },
        },
        columns: [
            {data: 'foto', name: 'foto'},
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

    $.ajax({
        url: {!! json_encode(url('api/get-number-of-pramuka')) !!}+'/'+{!! json_encode($id_wilayah) !!},
        type: 'GET',
        data:{gudep:@json($gudep->id)},
        success: function(data) {
            $('#total-siaga').html(data.siaga);
            $('#total-penggalang').html(data.penggalang);
            $('#total-penegak').html(data.penegak);
            $('#total-pandega').html(data.pandega);
            $('#total-dewasa').html(data.dewasa);
            $('#total-pelatih').html(data.pelatih);
        }
    });

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

