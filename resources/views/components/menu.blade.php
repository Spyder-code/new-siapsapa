@php
    $menu = [
    [
        'text' => 'Statistik',
        'href' => route('statistik.index'),
        'icon' => 'home',
        'access' => ['all'],
    ],[
        'text' => 'Pesanan KTA',
        'href' => '#',
        'icon' => 'dollar-sign',
        'access' => ['admin'],
        // 'twoColumn' => true,
        'sub' => [
            ['text' => 'Pending','href' => route('transaction.index', ['status'=>1]),'icon' => 'fa-list'],
            ['text' => 'Dicetak ','href' => route('transaction.index', ['status'=>2]),'icon' => 'fa-list'],
            ['text' => 'Selesai Cetak','href' => route('transaction.index', ['status'=>3]),'icon' => 'fa-list'],
            ['text' => 'Diterima','href' => route('transaction.index', ['status'=>4]),'icon' => 'fa-list'],
        ]
    ],[
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
        'text' => 'Transfer Anggota',
        'href' => route('gudep.transfer'),
        'icon' => 'external-link',
        'access' => ['gudep'],
    ],[
        'text' => 'Data Anggota',
        'href' => '#',
        'icon' => 'users',
        'access' => ['gudep'],
        'sub' => [
            ['text' => 'Anggota Aktif','href' => route('gudep.anggota', Auth::user()->anggota->gudep ?? 0),'icon' => 'fa-users'],
            ['text' => 'Anggota tidak aktif','href' => route('gudep.anggota', ['gudep'=>Auth::user()->anggota->gudep ?? 0, 'active'=>0]),'icon' => 'fa-users',],
        ]
    ],[
        'text' => 'Data Anggota',
        'href' => '#',
        'icon' => 'users',
        'access' => ['admin','kwarda','kwarcab','kwaran'],
        'sub' => [
            ['text' => 'Anggota non Gudep','href' => route('anggota.index','non-gudep'),'icon' => 'fa-users'],
            ['text' => 'Anggota Gudep','href' => route('anggota.index','is-gudep'),'icon' => 'fa-users',],
            ['text' => 'Anggota tidak aktif','href' => route('anggota.index','non-active'),'icon' => 'fa-users',],
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
    ],[
        'text' => 'Agenda',
        'href' => route('agenda.index'),
        'icon' => 'calendar',
        'access' => ['all'],
    ],[
        'text' => 'Percetakan',
        'href' => '#',
        'icon' => 'archive',
        'access' => ['admin'],
        // 'twoColumn' => true,
        'sub' => [
            // ['text' => 'Transaksi Pending','href' => route('transaction.index', ['status'=>1]),'icon' => 'fa-list'],
            ['text' => 'List Percetakan','href' => route('percetakan.batch'),'icon' => 'fa-list'],
            ['text' => 'Belum Cetak','href' => route('percetakan.index',['status'=>0]),'icon' => 'fa-list'],
            ['text' => 'Proses Cetak','href' => route('percetakan.index', ['status'=>1]),'icon' => 'fa-list'],
            ['text' => 'Sudah Cetak','href' => route('percetakan.index', ['status'=>2]),'icon' => 'fa-list'],
        ]
    ]
    // ,[
    //     'text' => 'Percetakan',
    //     'href' => '#',
    //     'icon' => 'printer',
    //     'access' => ['admin'],
    //     // 'twoColumn' => true,
    //     'sub' => [
    //         ['text' => 'Pending Cetak','href' => route('percetakan.index', ['status'=>0]),'icon' => 'fa-list'],
    //         ['text' => 'Sudah Cetak','href' => route('percetakan.index', ['status'=>1]),'icon' => 'fa-list'],
    //     ]
    // ]
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
