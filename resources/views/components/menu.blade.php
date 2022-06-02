@php
    $menu = [
    [
        'text' => 'Dashboard',
        'href' => 'dashboar',
        'icon' => 'home',
        'access' => ['all'],
    ],[
        'text' => 'Master Data',
        'href' => '#',
        'icon' => 'database',
        'access' => ['admin'],
        'sub' => [
            ['text' => 'Tipe Laporan','href' => route('report_type.index'),'icon' => 'fa-list'],
            ['text' => 'Kategori Laporan','href' => 'master/kategori-laporan','icon' => 'fa-list',],
            ['text' => 'Divisi','href' => 'master/divisi','icon' => 'fa-list'],
        ]
    ],[
        'text' => 'Management User',
        'href' => 'users',
        'icon' => 'users',
        'access' => ['admin'],
    ],[
        'text' => 'Laporan Masuk',
        'href' => 'laporan-masuk',
        'icon' => 'inbox',
        'access' => ['all'],
    ],[
        'text' => 'Laporan Keluar',
        'href' => 'laporan-keluar',
        'icon' => 'archive',
        'access' => ['all'],
    ],[
        'text' => 'Artikel',
        'href' => 'article',
        'icon' => 'book',
        'access' => ['admin'],
    ],
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
                    <x-menu.item :access="$item['access']" :href="$item['href']" :icon="$item['icon']" :text="$item['text']" :subMenu="$item['sub'] ?? []"/>
                @endforeach
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
</aside>
