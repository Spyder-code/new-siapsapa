<div class="card shadow p-3">
    <span>List Penilaian Suara</span>
    <hr>
    <div class="table-responsive">
        <table class="table table-sm table-bordered" style="font-size: .7rem">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>{{ $lomba->kepesertaan=='kelompok'?ucfirst($lomba->kegiatan->agenda->tingkat):'Nama Peserta' }}</th>
                    <th>File</th>
                    <th>Jumlah Suara</th>
                    <th>Vote</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($files as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($lomba->kepesertaan=='kelompok')
                                @if ($lomba->kegiatan->agenda->tingkat=='provinsi')
                                    {{ $item->anggota->province->name }}
                                @elseif($lomba->kegiatan->agenda->tingkat=='kabupaten')
                                    {{ $item->anggota->city->name }}
                                @elseif($lomba->kegiatan->agenda->tingkat=='kecamatan')
                                    {{ $item->anggota->district->name }}
                                @elseif($lomba->kegiatan->agenda->tingkat=='gudep')
                                    {{ $item->anggota->gudepInfo->nama_sekolah }}
                                @endif
                            @else
                                {{ $item->anggota->nama }}
                            @endif
                        </td>
                        <td><a href="{{ route('lomba.file.open',$item) }}">Lihat</a></td>
                        <td>{{ $item->votes->count() }}</td>
                        <td>
                            @if ($cek)
                                @if ($item->id==$cek->lomba_file_id)
                                <form action="{{ route('lomba.vote.destroy',$cek) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" style="font-size: .7rem" onclick="return confirm('are you sure?')">Tarik Suara</button>
                                </form>
                                @endif
                            @else
                            <form action="{{ route('lomba.vote.add',$lomba) }}" method="post">
                                @csrf
                                <button name="lomba_file_id" value="{{ $item->id }}" type="submit" class="btn btn-sm btn-success" style="font-size: .7rem" onclick="return confirm('are you sure?')">Beri Suara</button>
                            </form>
                            @endif
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
