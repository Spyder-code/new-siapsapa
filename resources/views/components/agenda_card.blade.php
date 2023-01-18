<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('berkas/agenda/'.$item->foto) ?? 'https://via.placeholder.com/150' }}" class="img-fluid rounded-start" alt="{{ $item->nama }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nama }}</h5>
                <p class="card-text" style="font-size: .8rem">{{ $item->deskripsi }}</p>
                @if ($item->jenis=='lomba')
                    <p style="text-transform: capitalize; font-size: .8rem"> Provinsi {{ Str::lower($item->provinsi->name) }}</p>
                @else
                    <p style="text-transform: capitalize; font-size: .8rem">{{ Str::lower($item->kecamatan->name) }}, {{ Str::lower($item->kabupaten->name) }}, Provinsi {{ Str::lower($item->provinsi->name) }}</p>
                @endif
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="fw-bold">Tanggal mulai: {{ date('d/m/Y', strtotime($item->tanggal_mulai)) }}</div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="fw-bold">Tanggal selesai: {{ date('d/m/Y', strtotime($item->tanggal_selesai)) }}</div>
                    </li>
                    <li class="list-group-item d-flex btn-group">
                        <a href="{{ route('agenda.show', $item) }}" class="btn btn-sm btn-primary">Detail</a>
                        <a href="{{ route('agenda.peserta', $item) }}" class="btn btn-sm btn-success">Peserta</a>
                        @if (Auth::id() == $item->created_by || Auth::user()->role=='admin')
                            <a href="{{ route('agenda.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" onclick="deleteAgenda({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12">
            @if ($item->jenis=='lomba')
            <li class="list-group-item d-flex gap-1">
                @if ($item->is_finish==0)
                    @if (Auth::user()->role!='anggota')
                        @if ($item->penilaian=='vote')
                        <a href="{{ route('agenda.file', $item) }}" class="btn btn-sm btn-outline-info w-100">Upload File <i class="fas fa-paper-plane"></i></a>
                        @endif
                        @if ($item->penilaian=='subjective' && Auth::id()==$item->created_by)
                        <a href="{{ route('agenda.juri', $item) }}" class="btn btn-sm btn-outline-warning w-100">Management Juri <i class="fas fa-check-circle"></i></a>
                        @endif
                    @endif
                    <a href="{{ route('agenda.nilai', $item) }}" class="btn btn-sm btn-outline-primary w-100">Penilaian <i class="fas fa-list-alt"></i></a>
                @endif
                <a href="{{ route('agenda.hasil', $item) }}" class="btn btn-sm btn-outline-success w-100">Hasil Perlombaan <i class="fas fa-trophy"></i></a>
            </li>
            @endif
        </div>
    </div>
</div>
