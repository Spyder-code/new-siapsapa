<div class="table-responsive">
    <table class="table table-bordered table-striped file-export table-sm" style="width: 100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Anggota</th>
                <th>Golongan</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->golongan->name }}</td>
                <td>{{ $item->documentType->name }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ asset('berkas/dokumen/'.$item->document_type_id.'/'.$item->file) }}" target="d_blank" class="btn btn-primary btn-sm image-popup-vertical-fit">Lihat</a>
                        <form action="{{ route('dokumen.update', ['dokuman'=> $item]) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success btn-sm" name="status" value="1" onclick="return confirm('are you sure?')">Validasi</button>
                            <button type="submit" class="btn btn-danger btn-sm" name="status" value="2" onclick="return confirm('are you sure?')">Tolak</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

