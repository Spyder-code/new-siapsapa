<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ $item->foto ?? 'https://via.placeholder.com/150' }}" class="img-fluid rounded-start" alt="{{ $item->nama }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nama }}</h5>
                <p class="card-text">{{ $item->deskripsi }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="fw-bold">Tanggal mulai: {{ date('d/m/Y', strtotime($item->tgl_mulai)) }}</div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="fw-bold">Tanggal mulai: {{ date('d/m/Y', strtotime($item->tgl_selesai)) }}</div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <a href="" class="btn btn-sm btn-primary">Detail</a>
                        <a href="" class="btn btn-sm btn-success">Daftar</a>
                        <a href="" class="btn btn-sm btn-danger">Hapus</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
