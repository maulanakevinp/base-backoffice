<nav class="pcoded-navbar theme-horizontal menu-light brand-blue">
    <div class="navbar-wrapper">
        <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                @php
                    $JudulMenu = App\Models\JudulMenu::whereHas('peran_judul_menu', function($peran_judul_menu) { return $peran_judul_menu->where('peran_id', auth()->user()->peran_id);})->orderBy('urutan')->get();
                @endphp
                @foreach ($JudulMenu as $i => $judul_menu)
                    <li class="nav-item pcoded-menu-caption">
                        <label>{{ $judul_menu->nama }}</label>
                    </li>
                    @php
                        $peran_judul_menu = $judul_menu->peran_judul_menu->where('peran_id', auth()->user()->peran_id)->first();
                        $Menu = collect();
                        if ($peran_judul_menu) {
                            $peran_judul_menu_id = $peran_judul_menu->id;
                            $Menu = App\Models\Menu::whereHas('judul_menu_menu', function ($judul_menu_menu) use ($peran_judul_menu_id) { return $judul_menu_menu->where('peran_judul_menu_id',$peran_judul_menu_id);})->orderBy('urutan')->get();
                        }
                    @endphp

                    @foreach ($Menu as $key => $menu)
                        @php
                            $judul_menu_menu = $menu->judul_menu_menu->where('peran_judul_menu_id',$peran_judul_menu_id)->first();
                            $Submenu = collect();
                            if ($judul_menu_menu) {
                                $judul_menu_menu_id = $judul_menu_menu->id;
                                $Submenu = App\Models\Submenu::whereHas('menu_submenu', function ($menu_submenu) use ($judul_menu_menu_id) { return $menu_submenu->where('judul_menu_menu_id', $judul_menu_menu_id); })->orderBy('urutan')->get();
                            }
                        @endphp
                        <li class="nav-item {{ count($Submenu) > 0 ? 'pcoded-hasmenu' : '' }}">
                            <a href="{{ url($menu->url) }}" class="nav-link">
                                <span class="pcoded-micon"><i class="{{ $menu->icon }}"></i></span>
                                <span class="pcoded-mtext">{{ $menu->nama }}</span>
                            </a>
                            @if (count($Submenu) > 0)
                                <ul class="pcoded-submenu">
                                    @foreach ($Submenu as $submenu)
                                        @php
                                            $menu_submenu = $submenu->menu_submenu->where('judul_menu_menu_id', $judul_menu_menu_id)->first();
                                            $Sub_submenu = collect();
                                            if ($menu_submenu) {
                                                $menu_submenu_id = $menu_submenu->id;
                                                $Sub_submenu = App\Models\SubSubMenu::whereHas('submenu_sub_submenu', function ($submenu_sub_submenu) use ($menu_submenu_id) { return $submenu_sub_submenu->where('menu_submenu_id', $menu_submenu_id); })->orderBy('urutan')->get();
                                            }
                                        @endphp
                                        <li class="{{ count($Sub_submenu) > 0 ? 'pcoded-hasmenu' : '' }}">
                                            <a href="{{ url($submenu->url) }}">{{ $submenu->nama }}</a>
                                            @if (count($Sub_submenu) > 0)
                                                <ul class="pcoded-submenu">
                                                    @foreach ($Sub_submenu as $sub_submenu)
                                                        <li><a href="{{ url($sub_submenu->url) }}">{{ $sub_submenu->nama }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</nav>
