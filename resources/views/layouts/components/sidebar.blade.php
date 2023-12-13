@php
    $links = [
        [
            'href' => route('home'),
            'text' => 'Dasboard',
            'icon' => 'fas fa-home',
            'is_multi' => false,
        ],
        [
            'text' => 'Kelola Akun',
            'icon' => 'fas fa-users',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'Data Akun',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('akun.index'),
                ],
                [
                    'section_text' => 'Tambah Akun',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('akun.add'),
                ],
            ],
        ],
        [
            'text' => 'Kelola Pemasukan',
            'icon' => 'fas fa-wallet',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'Data Pemasukan',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('pemasukan.index'),
                ],
                [
                    'section_text' => 'Tambah Pemasukan',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('pemasukan.add'),
                ],
            ],
        ],
        [
            'text' => 'Kelola Pengeluaran',
            'icon' => 'fas fa-shopping-cart',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'Data Pengeluaran',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('pengeluaran.index'),
                ],
                [
                    'section_text' => 'Tambah Pengeluaran',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('pengeluaran.add'),
                ],
            ],
        ],
        [
            'text' => 'Kelola Hutang',
            'icon' => 'fas fa-credit-card',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'Data Hutang',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('hutang.index'),
                ],
                [
                    'section_text' => 'Tambah Hutang',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('hutang.add'),
                ],
            ],
        ],
        [
            'text' => 'Kelola Pinjaman',
            'icon' => 'fas fa-money-bill',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'Data Pinjaman',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('pinjaman.index'),
                ],
                [
                    'section_text' => 'Tambah Pinjaman',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('pinjaman.add'),
                ],
            ],
        ],
        [
            'text' => 'Kelola Transfer Saldo',
            'icon' => 'fas fa-share',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'Data Transfer Saldo',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('transfer_saldo.index'),
                ],
                [
                    'section_text' => 'Tambah Transfer Saldo',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('transfer_saldo.add'),
                ],
            ],
        ],
        [
            'text' => 'Riwayat Transaksi',
            'icon' => 'fas fa-users',
            'is_multi' => false,
            'href' => route('riwayat.index')
        ]
    ];
    $navigation_links = json_decode(json_encode($links));
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('vendor/adminlte3/img/SavePenseLogo.svg') }}" alt="SavePense Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
            @if (auth()->user()->is_admin == 0)
                <span class="brand-text font-weight-light">SavePense</span>    
            @else
                <span class="brand-text font-weight-light">SavePense<b>Admin</b></span>
            @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        @foreach ($navigation_links as $link)
            @if (auth()->user()->is_admin == 0)
                @if (auth()->user()->is_admin == 0 && $link->text == 'Kelola Akun')
                    {{-- Skip 'Kelola Akun' for non-admin users --}}
                    @continue
                @endif

                @if (!$link->is_multi)
                    {{-- Display other non-multi sections for all users --}}
                    <li class="nav-item">
                        <a href="{{ url()->current() == $link->href ? '#' : $link->href }}"
                            class="nav-link {{ url()->current() == $link->href ? 'active' : '' }}">
                            <i class="nav-icon {{ $link->icon }}"></i>
                            <p>
                                {{ $link->text }}
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                @else
                    {{-- Display multi-sections for all users --}}
                    @php
                        foreach ($link->href as $section) {
                            if (url()->current() == $section->section_href) {
                                $open = 'menu-open';
                                $status = 'active';
                                break; // Put this here
                            } else {
                                $open = '';
                                $status = '';
                            }
                        }
                    @endphp
                    <li class="nav-item {{ $open }}">
                        <a href="#" class="nav-link {{ $status }}">
                            <i class="nav-icon {{ $link->icon }}"></i>
                            <p>
                                {{ $link->text }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach ($link->href as $section)
                                <li class="nav-item">
                                    <a href="{{ url()->current() == $section->section_href ? '#' : $section->section_href }}"
                                        class="nav-link {{ url()->current() == $section->section_href ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $section->section_text }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @elseif (auth()->user()->is_admin == 1 && $link->text == 'Kelola Akun')
                {{-- Display only 'Kelola Akun' for admin users --}}
                @php
                    foreach ($link->href as $section) {
                        if (url()->current() == $section->section_href) {
                            $open = 'menu-open';
                            $status = 'active';
                            break; // Put this here
                        } else {
                            $open = '';
                            $status = '';
                        }
                    }
                @endphp
                <li class="nav-item {{ $open }}">
                    <a href="#" class="nav-link {{ $status }}">
                        <i class="nav-icon {{ $link->icon }}"></i>
                        <p>
                            {{ $link->text }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($link->href as $section)
                            <li class="nav-item">
                                <a href="{{ url()->current() == $section->section_href ? '#' : $section->section_href }}"
                                    class="nav-link {{ url()->current() == $section->section_href ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $section->section_text }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
            </ul>
        </nav>


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
