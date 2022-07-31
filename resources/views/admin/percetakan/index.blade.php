@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Keranjang', 'url' => '#'],
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
                <h4 class="card-title mb-0">List Item</h4>
            </div>
            <div class="table-responsive p-4">
                <table class="table table-bordered table-striped file-export" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="justify-content-center text-center">
                                    <img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                                    <span class="badge bg-primary">{{ $item->anggota->kode }}</span>
                                </div>
                            </td>
                            <td>{{ $item->anggota->nama }}</td>
                            <td>{{ $item->pramuka->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            @if (Auth::user()->role == 'admin')
                            <td colspan="5">
                                <form action="{{ route('cart.print') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success"><i class="fas fa-print"></i> Cetak Langsung</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    </tfoot>
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
