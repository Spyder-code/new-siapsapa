@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <style>
        tr.selected{
            background-color: #34ff89ab;
        }
    </style>
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Item Cetak', 'url' => '#'],
        ]"

        :title="'Percetakan'"
        :description="'Daftar Item'"
    />
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">List Item {{ $status==1?'Proses Cetak':($status==2?'Sudah Cetak':'Belum Cetak') }}</h4>
                </div>
            </div>
            <div class="table-responsive p-4">
                <table class="table table-bordered file-export" style="width: 100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kwarcab</th>
                            <th>Kwaran</th>
                            <th>Gudep</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="cart" class="position fixed-bottom">
    <form action="{{ route('percetakan.update.status') }}" method="post">
        @csrf
        <input type="hidden" name="transaction_id" class="transaction_id">
        <div class="bg-light-primary px-5 py-2 text-center justify-content-center">
            <p class="fw-bold"><span id="cart-item">10</span> Item dipilih</p>
            @if ($status!=0)
                <button class="btn btn-warning"  name="status" value="0" type="submit">Masukan ke antrian cetak</button>
            @endif
            @if ($status!=1)
                <button class="btn btn-primary"  name="status" value="1" type="submit">Masukan ke proses cetak</button>
            @endif
            @if ($status!=2 && $status!=0)
                <button class="btn btn-success"  name="status" value="2" type="submit">Masukan ke selesai cetak</button>
            @endif
        </div>
    </form>
    @if ($status==1)
    <form action="{{ route('percetakan.print') }}" method="post">
        @csrf
        <input type="hidden" name="transaction_id" class="transaction_id">
        <div class="bg-light-primary px-5 py-2 text-center justify-content-center">
            <button class="btn btn-danger"  name="status" value="3" type="submit"><i class="fas fa-print"></i> Cetak</button>
        </div>
    </form>
    @endif
</div>

@endsection

@section('script')
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script>
        $('#cart').hide();
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            select:true,
            ajax: {
                url: @json(route('datatable.percetakan')),
                type: 'GET',
                data: {
                        status: {!! json_encode($status) !!},
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
                {data: 'id', name: 'id', searchable: false, orderable: false, visible: false},
                {data: 'foto', name: 'foto', searchable: false, orderable: false},
                {data: 'nama', name: 'nama', searchable: false, orderable: false},
                {data: 'kwarcab', name: 'kwarcab', searchable: false, orderable: false},
                {data: 'kwaran', name: 'kwaran', searchable: false, orderable: false},
                {data: 'gudep', name: 'gudep', searchable: false, orderable: false},
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
                    $('.transaction_id').val(selected);
                    $('#cart').show('slow');
                }else{
                    $('#cart').hide('slow');
                }
            }, 500);
            // console.log(data);
        });
    </script>
@endsection
