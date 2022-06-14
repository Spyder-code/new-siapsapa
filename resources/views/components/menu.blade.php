@php
    $menu = [
    [
        'text' => 'Dashboard',
        'href' => 'dashboar',
        'icon' => 'home',
        'access' => ['all'],
    ],[
        'text' => 'Kwartir',
        'href' => route('kwartir.index'),
        'icon' => 'map',
        'access' => ['all'],
    ],[
        'text' => 'Data Gudep',
        'href' => '#',
        'icon' => 'bookmark',
        'access' => ['all'],
        'sub' => [
            ['text'=>'List Gudep','href'=>route('gudep.index'),'icon'=>'fa-list'],
            ['text'=>'Registrasi Gudep','href'=>route('gudep.create'),'icon'=>'fa-plus'],
        ]
    ],[
        'text' => 'Data Anggota',
        'href' => '#',
        'icon' => 'users',
        'access' => ['admin'],
        'sub' => [
            ['text' => 'Anggota non Gudep','href' => route('anggota.index'),'icon' => 'fa-users'],
            ['text' => 'Anggota Gudep','href' => route('anggota.index',['gudep'=>true]),'icon' => 'fa-users',],
            ['text' => 'Anggota tidak aktif','href' => 'master/divisi','icon' => 'fa-users',],
            ['text' => 'Registrasi Anggota','href' => 'master/divisi','icon' => 'fa-user-plus',],
        ]
    ],[
        'text' => 'Validasi Anggota',
        'href' => 'users',
        'icon' => 'user-check',
        'access' => ['admin'],
    ],[
        'text' => 'Dokumen',
        'href' => 'laporan-masuk',
        'icon' => 'file-text',
        'access' => ['all'],
    ],[
        'text' => 'Agenda',
        'href' => 'laporan-masuk',
        'icon' => 'calendar',
        'access' => ['all'],
    ],[
        'text' => 'Lain-lain',
        'href' => 'laporan-keluar',
        'icon' => 'archive',
        'access' => ['all'],
        // 'twoColumn' => true,
        'sub' => [
            ['text' => 'Pesan KTA','href' => 'siapsapa','icon' => 'fa-list'],
            ['text' => 'Pesan Produk','href' => 'siapsapa','icon' => 'fa-list'],
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
                    <x-menu.item :access="$item['access']" :href="$item['href']" :icon="$item['icon']" :text="$item['text']" :twoColumn="$item['twoColumn']??false" :subMenu="$item['sub'] ?? []"/>
                @endforeach
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
</aside>
