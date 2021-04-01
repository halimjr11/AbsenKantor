@extends('app.main')
@section('title', 'Detail Absensi')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1><strong>Detail Absensi</strong></h1>
                    </div>
                    <div class="card-body">
                        <header>
                            <h5><strong>{{$user->name}}</strong></h5>
                            
                            <div class="row">
                                <div class="col-md-4"><div class="link"><a href="#" class="btn btn-success">Print</a></div></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <form action="{{route('app.absensi.rekap.detail', $id)}}" method="get">
                                        <div class="form-group">
                                            <select class="form-control" name="bulan">
                                                <option value="">-- Pilih Bulan --</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select style="cursor:pointer;" class="form-control" id="tag_select" name="tahun">
                                                <option value="0" selected disabled> Pilih Tahun</option>
                                                <?php 
                                                $year = date('Y');
                                                $min = $year - 60;
                                                $max = $year;
                                                for( $i=$max; $i>=$min; $i-- ) {
                                                echo '<option value='.$i.'>'.$i.'</option>';
                                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Terapkan</button>
                                    </form>
                                </div>
                            </div>
                        </header>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No. </th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Keluar</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=1;$i<=$jml_hari;$i++)
                                    <?php
                                        $dt->day = $i;
                                        $dt->month = $bln;
                                        $dt->year = $thn;
                                        $tg = $dt->format('Y-m-d');
                                        $weekend = $dt->format('l');
                                        $dati = DB::table('absensis')
                                                        ->where('tanggal','=', $tg)
                                                        ->where('user_id', '=',$id)
                                                        ->first();
                                                
                                    ?>
                                        <tr>
                                                <td>{{ $i }}</td>
                                                <td class="bg-dark text-white">{{$tg}}</td>

                                            @if($dati !="")
                                                <td class="bg-secondary">{{$dati->jam_masuk}}</td>
                                                <td class="bg-secondary">{{$dati->jam_keluar}}</td>
                                                <td class="bg-secondary">{{$dati->keterangan}}</td>
                                            @elseif($weekend == "Saturday" || $weekend == "Sunday")
                                                <td class="bg-danger text-white" colspan="4">Hari Libur Akhir Pekan</td>
                                            @else
                                                <td class="bg-danger text-white" colspan="4">User tidak melakukan absensi atau tidak hadir</td>
                                            @endif
                                        </tr>   
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection