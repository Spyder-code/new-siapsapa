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
            ['name' => 'Dashboard', 'url' => '#'],
            ['name' => 'Detail', 'url' => '#'],
            ['name' => 'Batch', 'url' => '#'],
        ]"

        :title="'Percetakan'"
        :description="'Detail Item Batch'"
    />
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between">
                <h4 class="card-title mb-0">List Item</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Kwaran</th>
                                <th>Gudep</th>
                                <th>Golongan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <div class="justify-content-center text-center">
                                        <img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                                        <span class="badge bg-primary">{{ $item->anggota->kode }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->anggota->nama }}</td>
                                <td>{{ $item->anggota->district->name }}</td>
                                <td>{{ $item->anggota->gudepInfo->nama_sekolah ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('transaction.update',$item) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <select name="golongan" class="form-control" onclick="submit()">
                                            @foreach ($golongan as $g)
                                                <option value="{{ $g->id }}" {{ $g->id==$item->golongan?'selected':'' }}>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('percetakan.update.status') }}" method="post" id="cart" class="position fixed-bottom">
    @csrf
    <input type="hidden" name="transaction_id" id="transaction_id">
    <div class="bg-light-primary px-5 py-2 text-center justify-content-center">
        <p class="fw-bold"><span id="cart-item">10</span> Item dipilih</p>
        <button class="btn btn-primary"  name="status" value="1" type="submit"><i class="fas fa-print"></i> Masukan ke proses cetak</button>
    </div>
</form>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script>
        $('#cart').hide();
        var table = $(".file-export").DataTable({
            columnDefs: [ {
                className: 'select-checkbox',
                targets:   0,
                searchable: false,
                orderable: false,
            },
            {
                targets:   1,
                visible: false,
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
                selected.push(value[1]);
            });
            console.log(selected);
        }

        table.on('click', function () {
            setTimeout(() => {
                handleSelected()
                var total = selected.length;
                if(total>0){
                    $('#cart-item').html(total);
                    $('#transaction_id').val(selected);
                    $('#cart').show('slow');
                }else{
                    $('#cart').hide('slow');
                }
            }, 500);
            // console.log(data);
        });
    </script>
@endsection
