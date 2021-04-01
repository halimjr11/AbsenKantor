@extends('app.main')
@section('title', 'Absensi')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>
                            <h1>Absensi Harian</h1>
                        </strong>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                             <div class="alert alert-success alert-block">
                                {{ session('status') }}
                                <button type="button" class="close float-right" data-dismiss="alert">×</button>
                            </div>
                        @endif
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <div class="text-center">
                                            <th>tanggal</th>
                                            <th>Absen Masuk</th>
                                            <th>Absen Pulang</th>
                                            <th>Status</th>
                                        </div>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if ($libur)
                                            <td class="bg-danger text-dark" colspan="4">
                                                Tidak ada Absen (hari libur nasional {{$holiday}})
                                            </td>
                                        @else
                                            @if (date('l') == "Saturday" || date('l') == "Sunday")
                                                <td class="bg-danger text-dark" colspan="4">
                                                    Tidak ada Absen (hari libur akhir pekan)
                                                </td>
                                            
                                            @else
                                            <td>{{date('d-m-Y')}}</td>
                                            <td>
                                                @if($kondisimasuk)
                                                    <p>Silahkan Absen</p>
                                                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                            <button class="btn btn-primary" type="submit">Absen Masuk</button>
                                                        </form>
                                                @elseif($kondisimasuktelat)
                                                    <p>Silahkan Absen Masuk Terlambat</p>
                                                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                            <button class="btn btn-primary" type="submit">Absen Masuk</button>
                                                        </form>
                                                    
                                                @else
                                                <p class="bg-danger">Check-in Belum Tersedia</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($kondisipulang)
                                                    <p>Silahkan Check-in</p>
                                                        <form action="{{ route('kehadiran.check-out') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                            <button class="btn btn-primary" type="submit">Absen Pulang</button>
                                                        </form>
                                                    @elseif($kondisipulangtelat)
                                                    <p>Silahkan Absen Pulang Terlambat</p>
                                                        <form action="{{ route('kehadiran.check-out') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                            <button class="btn btn-primary" type="submit">Absen Pulang</button>
                                                        </form>
                                                @else
                                                <p class="bg-danger">Absen Pulang Belum Tersedia <br> <strong>Belum waktunya pulang silahkan kembali bekerja!!</strong></p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($masuk == "" && $keluar == "")
                                                    <div class="icon-circle text-center" style="font-size: 50px">
                                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                                    </div>
                                                @else
                                                    <div class="icon-circle text-center" style="font-size: 50px">
                                                        <i class="fas fa-check-circle text-success"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            @endif
                                            
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection