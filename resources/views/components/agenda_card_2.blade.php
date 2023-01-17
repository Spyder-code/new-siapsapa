<div class="col-lg-4 col-md-4">
    <div class="block-box user-blog">
        <div class="blog-img">
            <a href="{{ route('agenda.detail', $item->id) }}"><img
                    style="max-width:100%; max-height:100%; object-fit: cover;" src="{{ asset('berkas/agenda/'.$item->foto) }}"></a>
        </div>
        <div class="blog-content">
            <div class="blog-category">
                <a href="#">{{ $item->kategori }}</a>
            </div>
            <h3 class="blog-title"><a href="{{ route('agenda.detail', $item->id) }}">{{(strlen($item->nama) >= 50) ?
                    substr($item->nama, 0, 50) . '...' : $item->nama}}</a></h3>
            <div class="blog-date">
                <i class="icofont-calendar"></i>{{ date("j F, Y", strtotime($item->created_at)) }}
            </div>
            <p>
                {{(strlen($item->deskripsi) >= 120) ? substr($item->deskripsi, 0, 120) . '...' : $item->deskripsi}}
            </p>
            <p style="text-transform: capitalize; font-size: .8rem">{{ Str::lower($item->kecamatan->name) }}, {{
                Str::lower($item->kabupaten->name) }}, Provinsi {{ Str::lower($item->provinsi->name) }}</p>
            <p class="font-weight-bold" style="text-transform: capitalize; font-size: 1rem">Tanggal mulai: {{
                date('d/m/Y', strtotime($item->tanggal_mulai)) }}</p>
            <p class="font-weight-bold" style="text-transform: capitalize; font-size: 1rem">Tanggal selesai: {{
                date('d/m/Y', strtotime($item->tanggal_selesai)) }}</p>
        </div>
        <div class="blog-meta">
            <li class="d-flex btn-group">
                <a href="{{ route('agenda.detail', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                <a href="{{ route('agenda.peserta', $item) }}" class="btn btn-sm btn-success">Peserta</a>
                @if (Auth::id() == $item->created_by || Auth::user()->role=='admin')
                <a href="{{ route('agenda.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                <button type="button" onclick="deleteAgenda({{ $item->id }})"
                    class="btn btn-sm btn-danger">Hapus</button>
                @endif
            </li>
            @if ($item->jenis=='lomba')
                <li class="list-group-item d-flex gap-1">
                    @if (Auth::user()->role!='anggota')
                        @if ($item->penilaian=='vote')
                        <a href="{{ route('agenda.file', $item) }}" class="btn btn-sm btn-outline-info w-100">Upload File <i class="fas fa-paper-plane"></i></a>
                        @endif
                        @if ($item->penilaian=='subjective')
                        <a href="{{ route('agenda.juri', $item) }}" class="btn btn-sm btn-outline-warning w-100">Management Juri <i class="fas fa-check-circle"></i></a>
                        @endif
                    @endif
                    <a href="{{ route('agenda.nilai', $item) }}" class="btn btn-sm btn-outline-success w-100">Penilaian <i class="fas fa-trophy"></i></a>
                </li>
            @endif
        </div>
    </div>
</div>
