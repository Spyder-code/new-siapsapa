<div class="card shadow p-3">
    <i>{{ Auth::user()->anggota->nama }} (juri)</i>
    <span>List Dokumen Penilaian Juri</span>
    <hr>
    <div class="table-responsive">
        @if ($lomba->kepesertaan=='kelompok')
        <table class="table table-sm table-bordered" style="font-size: .7rem">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>{{ ucfirst($lomba->kegiatan->agenda->tingkat) }}</th>
                    <th>Nilai (1-100)</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($files as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($lomba->kegiatan->agenda->tingkat=='provinsi')
                                {{ $item->first()->anggota->province->name }}
                            @elseif($lomba->kegiatan->agenda->tingkat=='kabupaten')
                                {{ $item->first()->anggota->city->name }}
                            @elseif($lomba->kegiatan->agenda->tingkat=='kecamatan')
                                {{ $item->first()->anggota->district->name }}
                            @elseif($lomba->kegiatan->agenda->tingkat=='gudep')
                                {{ $item->first()->anggota->gudepInfo->nama_sekolah }}
                            @endif
                        </td>
                        <td><input type="number" value="{{ $item->first()->pointJuriPesertaKelompok($lomba->id,$juri_id) ?? '' }}" max="100" min="1" class="text-center form-control" id="point-{{ $item->first()->id }}"></td>
                        <td>
                            <input type="hidden" id="id-{{ $item->first()->id }}" value="{{ $item->first()->idJuriPesertaKelompok($lomba->id,$juri_id) }}">
                            <input class="form-control" style="font-size:.7rem" type="text" id="deskripsi-{{ $item->first()->id }}" value="{{ $item->first()->deskripsiJuriPesertaKelompok($lomba->id,$juri_id) ?? '' }}">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary" style="font-size: .7rem" onclick="submitPeserta({{ $item->first()->id }})">Simpan</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada Dokumen Penilaian</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @else
        <table class="table table-sm table-bordered" style="font-size: .7rem">
            <thead>
                <tr>
                    <th>No Daftar.</th>
                    <th>Gudep</th>
                    <th>Nilai (1-100)</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($files as $item)
                    <tr>
                        <td>{{ $item->nodaf }}</td>
                        <td>{{ $item->anggota->nama }}</td>
                        <td><input type="number" value="{{ $item->pointJuriPeserta($lomba->id,$juri_id) ?? '' }}" max="100" min="1" class="text-center form-control" id="point-{{ $item->id }}"></td>
                        <td>
                            <input type="hidden" id="id-{{ $item->id }}" value="{{ $item->idJuriPeserta($lomba->id,$juri_id) }}">
                            <input class="form-control" style="font-size:.7rem" type="text" id="deskripsi-{{ $item->id }}" value="{{ $item->deskripsiJuriPeserta($lomba->id,$juri_id) ?? '' }}">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary" style="font-size: .7rem" onclick="submitPeserta({{ $item->id }})">Simpan</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada Dokumen Penilaian</td>
                    </tr>
                @endforelse
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td colspan="5">
                        <form action="" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm w-100">Validasi Nilai</button>
                        </form>
                    </td>
                </tr>
            </tfoot> --}}
        </table>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        function submitGudep(id){
            let point = $('#point-'+id).val();
            let idP = $('#id-'+id).val();
            let description = $('#deskripsi-'+id).val();
            let juri_id = @json($juri_id);
            if (point==''&&description=='') {
                alert('Harap isi point dan deskripsi!')
            }else{
                $.ajax({
                    type: "post",
                    url: "{{ route('lomba.juri.addPoint') }}",
                    data: {
                        point:point,
                        description:description,
                        gudep_id:id,
                        juri_id:juri_id,
                        id:idP,
                    },
                    success: function (response) {
                        alert('Data berhasil tersimpan!');
                    }
                });
            }
        }
        function submitPeserta(id){
            let point = $('#point-'+id).val();
            let idP = $('#id-'+id).val();
            let description = $('#deskripsi-'+id).val();
            let juri_id = @json($juri_id);
            if (point==''&&description=='') {
                alert('Harap isi point dan deskripsi!')
            }else{
                $.ajax({
                    type: "post",
                    url: "{{ route('lomba.juri.addPoint') }}",
                    data: {
                        point:point,
                        description:description,
                        peserta_id:id,
                        juri_id:juri_id,
                        id:idP,
                    },
                    success: function (response) {
                        alert('Data berhasil tersimpan!');
                    }
                });
            }
        }
    </script>
@endpush
