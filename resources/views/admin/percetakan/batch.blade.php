@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '#'],
            ['name' => 'Transaksi', 'url' => '#'],
        ]"

        :title="'Percetakan Batch'"
        :description="'Daftar Batch'"
    />
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between">
                <h4 class="card-title mb-0">List Batch</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Code</th>
                                <th>Penerima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->penerima }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('percetakan.batch.show', $item) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                                    <form action="{{ route('cart.print', $item) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Cetak Langsung</button>
                                    </form>
                                    <form action="{{ route('percetakan.complete', $item) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info" onclick="return confirm('are you sure?')">Tandai Selesai Cetak</button>
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
@endsection

@section('script')
    <script>
        var table = $(".file-export").DataTable();
    </script>
@endsection
