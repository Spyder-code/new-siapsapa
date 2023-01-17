@extends('layouts.social')
@section('content')
    <section class="mb-5">
        <div class="container">
            <p style="text-transform: uppercase">Penilaian {{ $agenda->nama }}</p>
            <div class="card shadow p-3">
                <span>List Dokumen Penilaian</span>
                <hr>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" style="font-size: .7rem">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Gudep</th>
                                <th>File</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($files as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->gudep->nama_sekolah }}</td>
                                    <td><a href="#">Lihat</a></td>
                                    <td><input type="number" class="text-center form-control" name="point" id="point"></td>
                                    <td><textarea name="deskripsu" id="deskripsi" cols="20" rows="3" class="form-control"></textarea></td>
                                    <td>
                                        <form action="" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" style="font-size: .7rem" onclick="return confirm('are you sure?')">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Dokumen Penilaian</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
