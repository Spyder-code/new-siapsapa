@extends('layouts.social')
@section('content')
    <section class="mb-5">
        <div class="container">
            <a href="{{ route('social.event') }}"> Kembali ke agenda</a>
            <p style="text-transform: uppercase">Penilaian {{ $lomba->kegiatan->nama_kegiatan }}</p>
            @if (strtotime(date('Y-m-d'))<strtotime($lomba->kegiatan->waktu_selesai))
                <div class="alert alert-warning">
                    <p class="text-center"> <strong id="countdown"></strong></p>
                </div>
            @else
                @if ($lomba->penilaian=='vote')
                <div class="card p-3 shadow">
                    <table class="table table-sm table-bordered" style="font-size: .7rem">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>{{ $lomba->kepesertaan=='kelompok'?'Gudep':'Nama Peserta' }}</th>
                                <th>Jumlah Suara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lomba->kepesertaan=='kelompok'?$item->agenda_file->gudep->nama_sekolah:$item->agenda_file->anggota->nama }}</td>
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
                @if ($lomba->penilaian=='subjective')
                <div class="card p-3 shadow">
                    <table class="table table-sm table-bordered" style="font-size: .7rem">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>{{ $lomba->kepesertaan=='kelompok'?'Gudep':'Nama Peserta' }}</th>
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
                @if ($lomba->penilaian=='objective')
                    <p class="text-center">HASIL MASIH DALAM PENGEMBANGAN</p>
                @endif
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script>
        let to = @json($lomba->kegiatan->waktu_selesai);
        // Set the date we're counting down to
        var countDownDate = new Date(to).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
        }, 1000);
    </script>
@endsection
