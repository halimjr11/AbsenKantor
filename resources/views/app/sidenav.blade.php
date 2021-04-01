<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <table id="jamdigital" class="table table-dark text-center nav-item">
                            <th id="jam"></th>
                                <th>:</th>
                                <th id="menit"></th>
                                <th>:</th>
                                <th id="detik"></th>
                            </table>
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="{{ route('app.home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            @if(Auth::user()->level != "karyawan")
                            <a class="nav-link" href="{{route('app.waktu')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                Waktu Absen
                            </a>
                            <a class="nav-link" href="{{ route('app.divisi')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                                Divisi
                            </a>
                            <a class="nav-link" href="{{ route('app.pegawai') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Pegawai
                            </a>
                            <a class="nav-link" href="{{ route('app.absensi.rekap') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                                Rekap Absensi
                            </a>
                            @endif
                            <a class="nav-link" href="{{ route('app.absensi') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-check-circle"></i></div>
                                Absensi
                            </a>
                            <a class="nav-link" href="{{ route('app.pengajuan') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard"></i></div>
                                Pengajuan Cuti
                            </a>
			</div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{Auth::user()->name}}
                    </div>
                </nav>
            </div>