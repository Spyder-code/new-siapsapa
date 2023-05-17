@if (Auth::user()->anggota->kta)
    @include('components.kta', ['anggota'=>Auth::user()->anggota])
@endif
<div class="widget widget-banner {{ Auth::user()->anggota->kta ? 'mt-5' : '' }}">
    <h3 class="item-title">PESAN KTA</h3>
    <div class="item-subtitle">Kartu Anggota</div>
    <a href="#" class="item-btn">
        <span class="btn-text">Pesan Sekarang</span>
        <span class="btn-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                <path fill-rule="evenodd" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
            </svg>
        </span>
    </a>
    <div class="item-subtitle">Gratis t-shirt untuk 10  pemesan</div>
    <div class="item-img">
        <img src="{{ asset('berkas/tshirt.png') }}" alt="banner">
    </div>
</div>

