<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('berkas/agenda/'.$item->foto) ?? 'https://via.placeholder.com/150' }}" class="img-fluid rounded-start" alt="{{ $item->nama }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nama }}</h5>
                <p class="card-text">{{ $item->deskripsi }}</p>
                <p style="text-transform: capitalize; font-size: .8rem">{{ Str::lower($item->kecamatan->name) }}, {{ Str::lower($item->kabupaten->name) }}, Provinsi {{ Str::lower($item->provinsi->name) }}</p>
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
    </div>
</div>
