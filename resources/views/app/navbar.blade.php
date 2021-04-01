<nav class="sb-topnav navbar navbar-expand navbar-dark bg-recom">
            <a class="navbar-brand" href="{{ route('app.home') }}">
            <img src="{{ url('images/logo.png') }}">
            Absensi Kantor</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto float-left">
                <li class="nav-item dropdown dropdown-notifications no-arrow">
                    <a class="nav-link dropdown-toggle" href="#notifications-panel" data-toggle="dropdown">
                        <i data-count="0" class="fas fa-bell fa-fw notification-icon"></i>
                        <sup class="badge badge-danger"><span class="notif-count">0</span></sup>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                        <div class="dropdown-header">
                        <h6 class="dropdown-header bg-recom text-center text-white">
                            Notifications
                        </h6>
                        </div>
                        <div class="dropdown-item notif">
                            <?php 
                            $list = DB::table('pengajuan')->join('users' ,function($join) {
                                $join->on('pengajuan.user_id', '=', 'users.id')
                                     ->where('pengajuan.status', '=', "None");
                            })->get();
                            
                            $lost = DB::table('pengajuan')->join('users' ,function($join) {
                                $join->on('pengajuan.user_id', '=', 'users.id')
                                     ->where('pengajuan.user_id', '=', Auth::user()->id)
                                     ->where('pengajuan.status', '!=', "None");
                            })->get();
                            ?>
                                @if(Auth::user()->level != "karyawan")
                                    @foreach ($list as $d)
                                            <a class="dropdown-item d-flex align-items-center" href="{{route('app.pengajuan.cuti.appr', $d->id_pengajuan)}}">
                                                <i class="fas fa-comment"></i>
                                                <div class="mr-3">
                                                    <div class="icon-circle">
                                                    <h5>{{$d->name}} mengajukan permohonan {{$d->jenis}}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                    @endforeach
                                @elseif(Auth::user()->level == "karyawan")
                                    @foreach ($lost as $d)
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('app.pengajuan.cuti.appr', $d->id_pengajuan)}}">
                                                    <i class="fas fa-comment"></i>
                                                    <div class="mr-3">
                                                        <div class="icon-circle">
                                                        <h5>Atasan telah {{$d->status}} permohonan {{$d->jenis}}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                        @endforeach
                                @endif
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('app.user.profile', Auth::user()->id) }}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
</nav>

@push('modal')
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-recom">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Are you sure?</h5>
                        <button class="close text-warning" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are sure to end current session.</div>
                    <div class="modal-footer bg-recom">
                        <button class="btn btn-primary text-white" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-exclamation-circle"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endpush