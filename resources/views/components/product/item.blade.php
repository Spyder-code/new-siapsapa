<div class="card">
    <div class="el-card-item pb-3">
        <div class=" el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
            <img src="{{ asset('berkas/product/'.$product->foto) }}" class="d-block position-relative w-100" alt="user"/>
            <div class="el-overlay w-100 overflow-hidden">
                <ul class=" list-style-none el-info text-white text-uppercase d-inline-block p-0 ">
                    <li class="el-item d-inline-block my-0 mx-1">
                        <a class=" btn default btn-outline image-popup-vertical-fit el-link text-white border-white " href="{{ asset('berkas/product/'.$product->foto) }}">
                            <i class="icon-magnifier"></i>
                        </a>
                    </li>
                    <li class="el-item d-inline-block my-0 mx-1">
                        <a class=" btn default btn-outline el-link text-white border-white " href="javascript:void(0);">
                            <i class="icon-link"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="align-item-center text-center">
            <span class="ml-5">Rp. {{ number_format($product->harga) }}</span>
        </div>
        <div class="d-flex no-block align-items-center mt-2">
            <div class="ms-3">
                <h4 class="mb-0">{{ $product->nama }}</h4>
                <span class="text-muted">{{ $product->deskripsi }}</span>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <span class="badge bg-{{ $product->status==0?'warning':'success' }}">{{ $product->status==0?'Belum diverifikasi':'Terverifikasi' }}</span>
        <div class="btn-group">
            <a href="{{ route('product.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('product.destroy', $product) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
