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
            <a href="{{ route('anggota.create',['type'=>$type]) }}" class="btn btn-success">
                <i data-feather="plus" class="fill-white feather-sm"></i>
                Tambah Data
            </a>
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
                <div class="table-responsives">
                    <table class="table table-sm table-bordered file-export" style="width: 100%; white-space:nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Foto</th>
                                <th>Nik</th>
                                {{-- <th>Nomor Anggota</th> --}}
                                <th>Nama Lengkap</th>
                                {{-- <th>Tgl Lahir</th> --}}
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

<form action="{{ route('cart.store') }}" method="post" id="cart" class="position fixed-bottom">
    @csrf
    <input type="hidden" name="anggota_id" id="anggota_id">
    <div class="bg-light-primary px-5 py-2 text-center justify-content-center">
        <label for="all">
            <input type="checkbox" class="selectAll" name="selectAll" value="all" id="all"> Pilih Semua Anggota
        </label>
        <p class="fw-bold"><span id="cart-item">10</span> Item dipilih</p>
        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-bag"></i> Masukan ke keranjang</button>
    </div>
</form>

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
<div class="modal fade" id="modalPromote" tabindex="-1" aria-labelledby="modalPromoteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('organization_user.store') }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="anggota_id" id="anggota_promote_id">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPromoteLabel">Angkat Sebagai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-input :type="'select'" :options="$organizations" :name="'organization_id'" :label="''"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" onclick="return confirm('apa anda yakin?')" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("select").select2({
            theme: "bootstrap-5",
        });
        $('#cart').hide();

        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            keyboard: false
        })

        var modalPromote = new bootstrap.Modal(document.getElementById('modalPromote'), {
            keyboard: false
        })


        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            select:true,
            // pagingType: "simple",
            scrollY: '500px',
            scrollX:true,
            ajax: {
            url: @json($url),
            type: 'GET',
            data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                },
            },
            columns: [
                {
                    orderable: false,
                    searchable: false,
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return '';
                    },
                },
                {data: 'foto', name: 'foto', searchable: false, orderable: false},
                {data: 'nik', name: 'tb_anggota.nik', visible: false},
                // {data: 'kode', name: 'kode'},
                {data: 'nama', name: 'tb_anggota.nama'},
                // {data: 'tgl_lahir', name: 'tgl_lahir', searchable: false, orderable: false},
                {data: 'jk', name: 'jk', searchable: false, orderable: false},
                {data: 'kabupaten', name: 'kabupaten', searchable: false, orderable: false},
                {data: 'kecamatan', name: 'kecamatan', searchable: false, orderable: false},
                {data: 'status', name: 'status', searchable: false, orderable: false},
                {data: 'action', name: 'action', searchable: false, orderable: false},
            ],
            columnDefs: [ {
                className: 'select-checkbox',
                targets:   0,
                searchable: false,
                orderable: false,
            } ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            dom: "Bfrtip",
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: ["pageLength","copy", "csv", "excel", "pdf", "print"],
            "bLengthChange": true,
            language: {
                paginate: {
                    previous: '<i class="fas fa-angle-left"></i>',
                    next: '<i class="fas fa-angle-right"></i>'
                }
            }
        });

        $.fn.dataTable.ext.errMode = 'throw';

        var selected = [];

        function handleSelected(){
            var data = table.rows('.selected').data().toArray();
            selected = [];
            $.each(data, function(index, value){
                selected.push(value.id);
            });
            console.log(selected);
        }

        table.on('click', function () {
            setTimeout(() => {
                handleSelected()
                var total = selected.length;
                if(total>0){
                    $('#cart-item').html(total);
                    $('#anggota_id').val(selected);
                    $('#cart').show('slow');
                }else{
                    $('#cart').hide('slow');
                }
            }, 500);
            // console.log(data);
        });

        $(".selectAll").on("click", function(e) {
            if ($(this).is(":checked")) {
                table.rows().select();
            } else {
                table.rows().deselect();
            }
            setTimeout(() => {
                handleSelected()
                var total = selected.length;
                if(total>0){
                    $('#cart-item').html(total);
                    $('#anggota_id').val(selected);
                    $('#cart').show('slow');
                }else{
                    $('#cart').hide('slow');
                }
            }, 500);
        });

        $('.file-export tbody').on( 'click', 'tr', function () {
            console.log( table.row( this ).data() );
        });

        // hide coulmn datatable
        // if(active==2){
        //     table.column(7).visible(false);
        // }


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


        let promoteAnggota = (anggota_id) => {
            $('#anggota_promote_id').val(anggota_id);
            modalPromote.toggle()
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
