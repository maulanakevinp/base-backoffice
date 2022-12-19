@extends('layouts.master')
@section('title', 'Ubah Peran')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('layouts.components.alert')
    @include('layouts.components.breadcrumb', [
        'title' => 'Ubah Peran',
        'breadcrumb' => '
            <li class="breadcrumb-item"><a href="#!">Admin</a></li>
            <li class="breadcrumb-item"><a href="#!">Kelola Pengguna</a></li>
            <li class="breadcrumb-item"><a href="'. route('peran.index') .'">Peran</a></li>
        '
    ])

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Peran</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('peran.update',$peran) }}" method="post">
                        @csrf @method('put')
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            @if ($peran->nama != "Super Admin" && $peran->nama != "Kepala" && $peran->nama != "Operator" && $peran->nama != "Bidang Keuangan")
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $peran->nama }}">
                            @else
                                <input disabled type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $peran->nama }}">
                            @endif
                            @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="text-right">
                            <a href="{{ route('peran.index') }}" class="btn btn-secondary">Kembali</a>
                            @if ($peran->nama != "Super Admin" && $peran->nama != "Kepala" && $peran->nama != "Operator" && $peran->nama != "Bidang Keuangan")
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <h5 class="mt-4">Akses Menu</h5>
            <hr>
            <div class="accordion" id="level0">
                @php $i = 0; @endphp
                @foreach (App\Models\JudulMenu::orderBy('id')->get() as $judul_menu)
                    <div class="card">
                        <div class="card-header" id="heading{{ $i }}">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0">
                                    <a href="#!" data-toggle="collapse" data-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapse{{ $i }}" class="">
                                        {{ $judul_menu->nama }}
                                    </a>
                                </h5>
                                <div class="mb-0">
                                    @php
                                        $peran_judul_menu = App\Models\PeranJudulMenu::where('peran_id', $peran->id)->where('judul_menu_id',$judul_menu->id)->first();
                                    @endphp
                                    @if ($peran_judul_menu)
                                        <input type="checkbox" class="akses" checked data-toggle="tooltip" title="Menu Diaktifkan (Klik Untuk Menonaktifkan)" style="transform: scale(1.3)">
                                        <form action="{{ route('peran-judul-menu.destroy', $peran_judul_menu) }}" method="post">@csrf @method('delete')</form>
                                    @else
                                        <input type="checkbox" class="akses" data-toggle="tooltip" title="Menu Dinonaktifkan (Klik Untuk Mengaktifkan)" style="transform: scale(1.3)">
                                        <form action="{{ route('peran-judul-menu.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="peran_id" value="{{ $peran->id }}">
                                            <input type="hidden" name="judul_menu_id" value="{{ $judul_menu->id }}">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (count($judul_menu->menu) > 0 && $peran_judul_menu != null)
                            <div id="collapse{{ $i }}" class="card-body collapse show" aria-labelledby="heading{{ $i }}" data-parent="#level0" style="">
                                <div class="accordion" id="level1">
                                    @php $i++; @endphp
                                    @foreach ($judul_menu->menu as $menu)
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $i }}">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="mb-0">
                                                        <a href="#!" data-toggle="collapse" data-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapse{{ $i }}" class="">
                                                            {{ $menu->nama }}
                                                        </a>
                                                    </h5>
                                                    <div class="mb-0">
                                                        @php
                                                            $judul_menu_menu = App\Models\JudulMenuMenu::where('peran_judul_menu_id', $peran_judul_menu->id)->where('menu_id',$menu->id)->first();
                                                        @endphp
                                                        @if ($judul_menu_menu)
                                                            <input type="checkbox" class="akses" checked data-toggle="tooltip" title="Menu Diaktifkan (Klik Untuk Menonaktifkan)" style="transform: scale(1.3)">
                                                            <form action="{{ route('judul-menu-menu.destroy', $judul_menu_menu) }}" method="post">@csrf @method('delete')</form>
                                                        @else
                                                            <input type="checkbox" class="akses" data-toggle="tooltip" title="Menu Dinonaktifkan (Klik Untuk Mengaktifkan)" style="transform: scale(1.3)">
                                                            <form action="{{ route('judul-menu-menu.store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="peran_judul_menu_id" value="{{ $peran_judul_menu->id }}">
                                                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @if (count($menu->submenu) > 0 && $judul_menu_menu != null)
                                                <div id="collapse{{ $i }}" class="card-body collapse show" aria-labelledby="heading{{ $i }}" data-parent="#level1" style="">
                                                    <div class="accordion" id="level2">
                                                        @php $i++; @endphp
                                                        @foreach ($menu->submenu as $submenu)
                                                            <div class="card">
                                                                <div class="card-header" id="heading{{ $i }}">
                                                                    <div class="d-flex justify-content-between">
                                                                        <h5 class="mb-0">
                                                                            <a href="#!" data-toggle="collapse" data-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapse{{ $i }}" class="">
                                                                                {{ $submenu->nama }}
                                                                            </a>
                                                                        </h5>
                                                                        <div class="mb-0">
                                                                            @php
                                                                                $menu_submenu = App\Models\MenuSubmenu::where('judul_menu_menu_id', $judul_menu_menu->id)->where('submenu_id',$submenu->id)->first();
                                                                            @endphp
                                                                            @if ($menu_submenu)
                                                                                <input type="checkbox" class="akses" checked data-toggle="tooltip" title="Menu Diaktifkan (Klik Untuk Menonaktifkan)" style="transform: scale(1.3)">
                                                                                <form action="{{ route('menu-submenu.destroy', $menu_submenu) }}" method="post">@csrf @method('delete')</form>
                                                                            @else
                                                                                <input type="checkbox" class="akses" data-toggle="tooltip" title="Menu Dinonaktifkan (Klik Untuk Mengaktifkan)" style="transform: scale(1.3)">
                                                                                <form action="{{ route('menu-submenu.store') }}" method="post">
                                                                                    @csrf
                                                                                    <input type="hidden" name="judul_menu_menu_id" value="{{ $judul_menu_menu->id }}">
                                                                                    <input type="hidden" name="submenu_id" value="{{ $submenu->id }}">
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if (count($submenu->sub_submenu) > 0 && $menu_submenu != null)
                                                                    <div id="collapse{{ $i }}" class="card-body collapse show" aria-labelledby="heading{{ $i }}" data-parent="#level2" style="">
                                                                        <div class="accordion" id="level3">
                                                                            @php $i++; @endphp
                                                                            @foreach ($submenu->sub_submenu as $sub_submenu)
                                                                                <div class="card">
                                                                                    <div class="card-header" id="heading{{ $i }}">
                                                                                        <div class="d-flex justify-content-between">
                                                                                            <h5 class="mb-0">
                                                                                                <a href="#!" data-toggle="collapse" data-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapse{{ $i }}" class="">
                                                                                                    {{ $sub_submenu->nama }}
                                                                                                </a>
                                                                                            </h5>
                                                                                            <div class="mb-0">
                                                                                                @php
                                                                                                    $submenu_sub_submenu = App\Models\SubMenuSubSubmenu::where('menu_submenu_id', $menu_submenu->id)->where('sub_submenu_id',$sub_submenu->id)->first();
                                                                                                @endphp
                                                                                                @if ($submenu_sub_submenu)
                                                                                                    <input type="checkbox" class="akses" checked data-toggle="tooltip" title="Menu Diaktifkan (Klik Untuk Menonaktifkan)" style="transform: scale(1.3)">
                                                                                                    <form action="{{ route('submenu-sub-submenu.destroy', $submenu_sub_submenu) }}" method="post">@csrf @method('delete')</form>
                                                                                                @else
                                                                                                    <input type="checkbox" class="akses" data-toggle="tooltip" title="Menu Dinonaktifkan (Klik Untuk Mengaktifkan)" style="transform: scale(1.3)">
                                                                                                    <form action="{{ route('submenu-sub-submenu.store') }}" method="post">
                                                                                                        @csrf
                                                                                                        <input type="hidden" name="menu_submenu_id" value="{{ $menu_submenu->id }}">
                                                                                                        <input type="hidden" name="sub_submenu_id" value="{{ $sub_submenu->id }}">
                                                                                                    </form>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @php $i++; @endphp
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    @php $i++; @endphp
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                @php $i++; @endphp
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            @php $i++; @endphp
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $(".akses").click(function (event) {
            $(this).siblings('form').submit();
        });
    });
</script>
@endpush
