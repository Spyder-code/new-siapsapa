@extends('layouts.social')
@section('content')
    <section class="mb-5">
        <div class="container">
            <a href="{{ route('social.event') }}"> Kembali ke agenda</a>
            <p style="text-transform: uppercase">Penilaian {{ $agenda->nama }}</p>
            @if ($agenda->penilaian=='vote')
            <div class="card p-3 shadow">
                <table class="table table-sm table-bordered" style="font-size: .7rem">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>{{ $agenda->kepesertaan=='kelompok'?'Gudep':'Nama Peserta' }}</th>
                            <th>Jumlah Suara</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $agenda->kepesertaan=='kelompok'?$item->agenda_file->gudep->nama_sekolah:$item->agenda_file->anggota->nama }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak Ada Dokumen Penilaian</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
            @if ($agenda->penilaian=='subjective')
            <div class="card p-3 shadow">
                <table class="table table-sm table-bordered" style="font-size: .7rem">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>{{ $agenda->kepesertaan=='kelompok'?'Gudep':'Nama Peserta' }}</th>
                            <th>Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['point'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak Ada Dokumen Penilaian</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
            @if ($agenda->penilaian=='objective')
                <p class="text-center">HASIL MASIH DALAM PENGEMBANGAN</p>
            @endif
        </div>
    </section>
@endsection
