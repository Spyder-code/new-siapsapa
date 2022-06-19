<div class="col-4">
    <div class="card">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <a class="list-group-item text-center">
                    <img src="{{ empty($anggota)?asset('images/logosiap.png'):asset('berkas/anggota/'. $anggota->foto) }}" alt="siapsapa" class="img-fluid" style="height: 150px">
                </a>
                @if (!empty($anggota)&&Auth::user()->role != 'anggota')
                <a href="{{ route('statistik.index') }}" class="list-group-item">
                    <i style="margin-right: 20px" class="fas fa-chart-line"></i> Dashboard Admin
                </a>
                @endif
                <a href="{{ route('page.profile') }}" class="list-group-item">
                    <i style="margin-right: 20px" class="fas fa-user"></i> Data Saya
                </a>
                <a href="#" class="list-group-item">
                    <i style="margin-right: 20px" class="fas fa-calendar"></i> Agenda Saya
                </a>
                <a href="#" class="list-group-item">
                    <i style="margin-right: 20px" class="fas fa-heart"></i> Pesanan Saya
                </a>
                <a href="#" class="list-group-item">
                    <i style="margin-right: 20px" class="fas fa-book"></i> Unggah Dokumen
                </a>
                <a href="#" class="list-group-item">
                    <i style="margin-right: 20px" class="fas fa-pencil-alt"></i> Tulis Artikel
                </a>
            </ul>
        </div>
    </div>
</div>
