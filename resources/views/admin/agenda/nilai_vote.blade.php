<div class="card shadow p-3">
    <span>List Penilaian Suara</span>
    <hr>
    <div class="table-responsive">
        <table class="table table-sm table-bordered" style="font-size: .7rem">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Gudep</th>
                    <th>File</th>
                    <th>Jumlah Suara</th>
                    <th>Vote</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($files as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->gudep->nama_sekolah }}</td>
                        <td><a href="#">Lihat</a></td>
                        <td>{{ $item->votes->count() }}</td>
                        <td>
                            @if ($cek)
                                @if ($item->id==$cek->agenda_file_id)
                                <form action="{{ route('agenda.vote.destroy',$cek) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" style="font-size: .7rem" onclick="return confirm('are you sure?')">Tarik Suara</button>
                                </form>
                                @endif
                            @else
                            <form action="{{ route('agenda.vote.add',$agenda) }}" method="post">
                                @csrf
                                <button name="agenda_file_id" value="{{ $item->id }}" type="submit" class="btn btn-sm btn-success" style="font-size: .7rem" onclick="return confirm('are you sure?')">Beri Suara</button>
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
