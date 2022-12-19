<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="{{ url('') }}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <div class="dflex justify-content-around">
                <img height="30px" src="{{ url('') }}/assets/images/72x72.png" alt="" class="logo">
                <span class="font-weight-bold h5">Resto Jember</span>
            </div>
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            @yield('search')
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i>
                        <span class="badge bg-danger" id="badge-notifikasi"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifikasi</h6>
                        </div>
                        <ul class="noti-body"></ul>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset(Storage::url(auth()->user()->data_pribadi->avatar)) }}" class="img-radius wid-40" alt="Foto profil">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ asset(Storage::url(auth()->user()->data_pribadi->avatar)) }}" class="img-radius" alt="Foto profil">
                            <span>{{ auth()->user()->data_pribadi->nama }}</span>
                            <a href="{{ route('keluar') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();" class="dud-logout" title="Keluar">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{ route('profil') }}" class="dropdown-item"><i class="feather icon-user"></i> Profil</a></li>
                            <li><a href="{{ route('pengaturan') }}" class="dropdown-item"><i class="feather icon-settings"></i> Pengaturan Akun</a></li>
                            <li><a href="{{ route('keluar') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();" class="dropdown-item"><i class="feather icon-lock"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<form id="form-logout" action="{{ route('keluar') }}" method="POST" style="display: none;">
    @csrf
</form>
