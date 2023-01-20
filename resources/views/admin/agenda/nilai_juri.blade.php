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
                    <th>Gudep</th>
                    <th>Nilai (1-100)</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($files as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->first()->gudep->nama_sekolah }}</td>
                        <td><input type="number" value="{{ $item->first()->pointJuriAgendaGudep($lomba->id,$juri_id) ?? '' }}" max="100" min="1" class="text-center form-control" id="point-{{ $item->first()->gudep_id }}"></td>
                        <td>
                            <input type="hidden" id="id-{{ $item->first()->gudep_id }}" value="{{ $item->first()->idJuriAgendaGudep($lomba->id,$juri_id) }}">
                            <input class="form-control" style="font-size:.7rem" type="text" id="deskripsi-{{ $item->first()->gudep_id }}" value="{{ $item->first()->deskripsiJuriAgendaGudep($lomba->id,$juri_id) ?? '' }}">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary" style="font-size: .7rem" onclick="submitGudep({{ $item->first()->gudep_id }})">Simpan</button>
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
                        <td><input type="number" value="{{ $item->pointJuriAgendaPeserta($lomba->id,$juri_id) ?? '' }}" max="100" min="1" class="text-center form-control" id="point-{{ $item->id }}"></td>
                        <td>
                            <input type="hidden" id="id-{{ $item->id }}" value="{{ $item->idJuriAgendaPeserta($lomba->id,$juri_id) }}">
                            <input class="form-control" style="font-size:.7rem" type="text" id="deskripsi-{{ $item->id }}" value="{{ $item->deskripsiJuriAgendaPeserta($lomba->id,$juri_id) ?? '' }}">
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
                    url: "{{ route('agenda.juri.addPoint') }}",
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
                    url: "{{ route('agenda.juri.addPoint') }}",
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
