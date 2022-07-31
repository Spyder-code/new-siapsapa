@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Keranjang', 'url' => '#'],
        ]"

        :title="'Keranjang Saya'"
        :description="'Daftar Item dalam keranjang saya'"
    />
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between">
                <h4 class="card-title mb-0">List Item</h4>
                <div class="d-flex gap-3">
                    <p>Jumlah KTA ({{ $carts->count() }})</p>
                    <p>Total: <b>Rp. {{ number_format($carts->sum('harga')) }}</b></p>
                    @if ($carts->count() > 0)
                    <a href="{{ route('transaction.create') }}" class="btn btn-success pos-relative right-0"><i class="fas fa-print"></i> Buat Transaksi</a>
                    @endif
                </div>
            </div>
            <div class="table-responsive p-4">
                <table class="table table-bordered table-striped file-export" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Harga</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="justify-content-center text-center">
                                    <img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                                    <span class="badge bg-primary">{{ $item->anggota->kode }}</span>
                                </div>
                            </td>
                            <td>{{ $item->anggota->nama }}</td>
                            <td>
                                <form action="{{ route('cart.update',$item) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <select onchange="submit()" name="golongan" id="golongan" class="form-control">
                                        @foreach ($pramuka as $golongan)
                                            <option value="{{ $golongan->id }}" {{ $golongan->id == $item->golongan?'selected':'' }}>{{ $golongan->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>Rp. {{ number_format($item->harga) }}</td>
                            <td>
                                <form action="{{ route('cart.destroy',$item) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash-alt"></i></button>
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
@endsection

@section('script')
    <script>
        var table = $(".file-export").DataTable();
    </script>
@endsection
