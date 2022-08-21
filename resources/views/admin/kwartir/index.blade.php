@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Kwartir', 'url' => route('kwartir.index', ['id_wilayah'=>$id_wilayah])],
        ]"

        :title="$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Data statistik '.strtolower($kwartir).' '. ucfirst($title)"
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
@php
    $len = strlen($id_wilayah);
@endphp
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
                                <th>Kode {{ $len>4 ? 'Sekolah' : '' }}</th>
                                <th>Nama {{ $len>4 ? 'Gudep' : '' }}</th>
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
        var column;
        if(@json($len>4)){
            column = [
                {data: 'npsn', name: 'npsn'},
                {data: 'nama_sekolah', name: 'nama_sekolah'},
                {data: 'admin', name: 'admin', searchable: false,},
                {data: 'anggota', name: 'anggota', searchable: false,},
                {data: 'action', name: 'action', searchable: false, orderable: false},
                {data: 'tools', name: 'tools', searchable: false, orderable: false},
            ]
        }else{
            column = [
                {data: 'code', name: 'code', searchable: false,},
                {data: 'name', name: 'name'},
                {data: 'admin', name: 'admin', searchable: false,},
                {data: 'anggota', name: 'anggota', searchable: false,},
                {data: 'action', name: 'action', searchable: false, orderable: false},
                {data: 'tools', name: 'tools', searchable: false, orderable: false},
            ]
        }
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
            columns: column,
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
            url: {!! json_encode(url('api/get-number-of-member')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            success: function(data) {
                $('#total-anggota').html(data.anggota);
                $('#total-admin').html(data.admin);
            }
        });

        $.ajax({
            url: {!! json_encode(url('api/get-number-of-pramuka')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            success: function(data) {
                $('#total-siaga').html(data.siaga);
                $('#total-penggalang').html(data.penggalang);
                $('#total-penegak').html(data.penegak);
                $('#total-pandega').html(data.pandega);
                $('#total-dewasa').html(data.dewasa);
                $('#total-pelatih').html(data.pelatih);
            }
        });

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
    </script>
@endsection
