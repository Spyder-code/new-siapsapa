<li class="header-nav-item">
    <a href="{{ url('/') }}" class="menu-link active">Beranda</a>
</li>
<li class="hide-on-mobile-menu">
    <a href="index.html#" class="menu-link have-sub">Agenda</a>
    <ul class="sub-menu">
        <li>
            <a href="#"> <i class="icofont-lock"></i>Lomba</a>
        </li>
        <li>
            <a href="{{ route('page.agenda') }}">Non Lomba</a>
        </li>
    </ul>
</li>
<li class="header-nav-item">
    <a href="index.html#" class="menu-link have-sub">Berita</a>
    <ul class="sub-menu">
        <li>
            <a href="#">Artikel</a>
        </li>
        <li>
            <a href="#">Penggumuman</a>
        </li>
    </ul>
</li>
<li class="header-nav-item">
    <a href="{{ route('page.statistik') }}" class="menu-link active">Statistik</a>
</li>
{{-- <li class="header-nav-item">
    <a href="index.html#" class="menu-link have-sub"><i class="icofont-lock"></i> Produk</a>
    <ul class="sub-menu">
        <li>
            <a href="#">Pramuka</a>
        </li>
        <li>
            <a href="#">Umum</a>
        </li>
    </ul>
</li> --}}
{{-- <li class="header-nav-item">
    <a href="https://radiustheme.com/demo/html/cirkle/contact.html" class="menu-link">Kontak Kami</a>
</li> --}}
<li class="header-nav-item">
    <a href="{{ route('social.home') }}" class="menu-link">Member Area</a>
</li>
<li class="header-nav-item">
    <a href="{{ url('scan-anggota') }}" class="menu-link">Scan QR</a>
</li>
