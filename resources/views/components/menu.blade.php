@php
    $menu = [
    [
        'text' => 'Statistik',
        'href' => route('statistik.index'),
        'icon' => 'home',
        'access' => ['all'],
    ], [
        'text' => 'Perbaikan Data',
        'href' => route('statistik.index'),
        'icon' => 'database',
        'access' => ['all'],
        'alert' => true,
        'sub' => [
            ['text' => 'Tanggal Lahir','href' => route('data.view.date'),'icon' => 'fa-calendar'],
            ['text' => 'Foto','href' => route('data.view.image'),'icon' => 'fa-image'],
        ]
    ],[
        'text' => 'Kwartir',
        'href' => route('kwartir.index'),
        'icon' => 'map',
        'access' => ['admin','kwarda','kwarcab','kwaran'],
    ],[
        'text' => 'Data Gudep',
        'href' => '#',
        'icon' => 'bookmark',
        'access' => ['admin','kwarda','kwarcab','kwaran'],
        'sub' => [
            ['text'=>'List Gudep','href'=>route('gudep.index'),'icon'=>'fa-list'],
            ['text'=>'Registrasi Gudep','href'=>route('gudep.create'),'icon'=>'fa-plus'],
        ]
    ],[
        'text' => 'Data Anggota',
        'href' => route('gudep.anggota', Auth::user()->anggota->gudep ?? 0),
        'icon' => 'users',
        'access' => ['gudep'],
    ],[
        'text' => 'Anggota non Aktif',
        'href' => route('gudep.anggota', ['gudep'=>Auth::user()->anggota->gudep ?? 0, 'active'=>0]),
        'icon' => 'users',
        'access' => ['gudep'],
    ],[
        'text' => 'Transfer Anggota',
        'href' => route('gudep.transfer'),
        'icon' => 'external-link',
        'access' => ['gudep'],
    ],[
        'text' => 'Data Anggota',
        'href' => '#',
        'icon' => 'users',
        'access' => ['admin','kwarda','kwarcab','kwaran'],
        'sub' => [
            ['text' => 'Anggota non Gudep','href' => route('anggota.index'),'icon' => 'fa-users'],
            ['text' => 'Anggota Gudep','href' => route('anggota.index',['gudep'=>true]),'icon' => 'fa-users',],
            ['text' => 'Anggota tidak aktif','href' => route('anggota.index',['active' => '0']),'icon' => 'fa-users',],
            ['text' => 'Registrasi Anggota','href' => route('anggota.create'),'icon' => 'fa-user-plus',],
        ]
    ],[
        'text' => 'Validasi Anggota',
        'href' => route('anggota.non_validate'),
        'icon' => 'user-check',
        'access' => ['admin','kwarda','kwarcab','kwaran','gudep'],
    ],[
        'text' => 'Dokumen',
        'href' => route('dokumen.index'),
        'icon' => 'file-text',
        'access' => ['all'],
    ]
    ,[
        'text' => 'Agenda',
        'href' => route('agenda.index'),
        'icon' => 'calendar',
        'access' => ['all'],
    ],[
        'text' => 'Produk',
        'href' => 'laporan-keluar',
        'icon' => 'archive',
        'access' => ['alls'],
        // 'twoColumn' => true,
        'sub' => [
            ['text' => 'Pesan KTA','href' => '#','icon' => 'fa-lock'],
            ['text' => 'Produk Saya','href' => route('product.index'),'icon' => 'fa-heart'],
        ]
    ]
];
@endphp
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
            <!-- User Profile-->
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Main</span>
                </li>
                @foreach ($menu as $item)
                    <x-menu.item :access="$item['access']" :alert="$item['alert'] ?? false" :href="$item['href']" :icon="$item['icon']" :text="$item['text']" :twoColumn="$item['twoColumn']??false" :subMenu="$item['sub'] ?? []"/>
                @endforeach
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
</aside>
