@forelse ($documents as $document)
<div class="card my-2" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('images/document.png') }}" id="image" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $document->first()->golongan->name }}</h5>
                <ul class="list-group list-group-flush">
                    @foreach ($document as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ $item->documentType->name }}</div>
                                <span class="text-{{ $item->status==0?'warning':'success' }}">Status: {{ $item->status==0?'Belum diverifikasi':'Terverifikasi' }}</span>
                            </div>
                            <div class="btn-group">
                                <a href="{{ asset('berkas/dokumen/'.$item->document_type_id.'/'.$item->file) }}" target="d_blank" class="badge bg-primary rounded-pill border-light image-popup-vertical-fit">Lihat</a>
                            <button class="badge bg-danger rounded-pill border-light" onclick="deleteDocument({{ $item->id }})">Hapus</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@empty
    <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
@endforelse
