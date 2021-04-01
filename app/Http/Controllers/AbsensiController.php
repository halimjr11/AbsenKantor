<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function home()
    {
        $masuk = DB::table('absensis')
                            ->select('jam_masuk')
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('tanggal', '=', date('Y-m-d'))
                            ->first();
        $keluar = DB::table('absensis')
                            ->select('jam_keluar')
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('tanggal', '=', date('Y-m-d'))
                            ->first();
        $kalender = DB::table('libur')
                        ->where('tahun', '=', date('Y'))
                        ->get()
                        ->first();
        $jumlah = DB::table('libur')
                    ->where('tahun', '=', date('Y'))
                    ->count();
        $ket =  DB::table('libur')
                    ->where('tahun', '=', date('Y'))
                    ->where('tgl_libur', '=', date('Y-m-d'))
                    ->get()
                    ->first();
        $libur = false;
        $holiday = null;
        if ($kalender != false) {
            for ($i=0; $i < $jumlah ; $i++) {
                if ($kalender->tgl_libur == date('Y-m-d')) {
                    $libur = true;
                    $holiday = $ket->keterangan;
                    break;
                }
            }
        }
        $kondisi= $masuk == "" && $keluar == "";
        $jam_in = DB::table('waktu')
                        ->where('keterangan', '=', "Masuk")
                        ->first();
        $jam_out = DB::table('waktu')
                        ->where('keterangan', '=', "Pulang")
                        ->first();
         
        $kondisimasuk = strtotime(date('H:i:s')) >= strtotime($jam_in->mulai) && strtotime(date('H:i:s')) <= strtotime($jam_in->batas);
        $kondisimasuktelat = strtotime(date('H:i:s')) >= strtotime($jam_in->batas) && strtotime(date('H:i:s')) <= strtotime($jam_out->mulai);
        $kondisipulang = strtotime(date('H:i:s')) >= strtotime($jam_out->mulai) && strtotime(date('H:i:s')) <= strtotime($jam_out->batas);
        $kondisipulangtelat = strtotime(date('H:i:s')) >= strtotime($jam_out->batas) && strtotime(date('H:i:s')) <= strtotime('23:59:00');
        $now = date('H:i:s');
        return view('app.pages.absensi.absensi', compact('masuk','keluar','kondisi', 'kondisipulangtelat','kondisipulang','kondisimasuktelat','kondisimasuk','libur','holiday','jam_in','jam_out','now'));
    }
    public function index()
    {
        $data = DB::table('users')
                    ->where('level', '=', "karyawan")->get();
        return view('app.pages..absensi.listabsensi', compact('data'));
    }

    public function detail(Request $request,$id)
    {   
        if(isset($request->bulan)){
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            }else{
            $bulan = date('m');
            $tahun = date('Y');
        }
        $dt = Carbon::now();
        $kalender = CAL_GREGORIAN;
        $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $dt->month = $bulan;
        $dt->year = $tahun;
        $bln = $dt->format('m');
        $thn = $dt->format('Y');
        $hari_tgl = [];
        $data = DB::table('absensis')
                    ->where('user_id', '=' , $id)
                    ->first();
        $id = $id;
        $user = DB::table('users')->where('id', '=', $id)->first();
        return view('app.pages.absensi.detail', compact('id','data','jml_hari','bln', 'thn','dt','user'));
    }

    public function filter(Request $request, $id)
    {
        if(isset($request->bulan)){
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            }else{
            $bulan = date('m');
            $tahun = date('Y');
            }
            $dt = Carbon::now();
            $kalender = CAL_GREGORIAN;
            $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            $dt->month = $bulan;
            $dt->year = $tahun;
            $bln = $dt->format('m');
            $thn = $dt->format('Y');
            $hari_tgl = [];
            $tgl = DB::table('absensis')
                        ->where('user_id','=', $id)
                        ->get();
            $data = DB::table('absensis')
                        ->where('tanggal', 'like' , "%{$bln}%")
                        ->where('user_id', '=' , $id)
                        ->get();
            $id = $id;
            $user = DB::table('users')->where('id', '=', $id)->first();
            return redirect('app.pages.absensi.listuser', compact('id','data','jml_hari','bln', 'thn','tgl','dt','user'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'tanggal' => ['required']
        ]);
        $presents = DB::table('absensis')
                            ->whereTanggal($request->tanggal)
                            ->orderBy('jam_masuk')
                            ->paginate(6);
        $masuk = DB::table('absensis')
                            ->whereTanggal($request->tanggal)
                            ->whereKeterangan('masuk')
                            ->count();
        $telat = DB::table('absensis')
                            ->whereTanggal($request->tanggal)
                            ->whereKeterangan('telat')
                            ->count();
        $cuti = DB::table('absensis')
                            ->whereTanggal($request->tanggal)
                            ->whereKeterangan('cuti')
                            ->count();
        $alpha = DB::table('absensis')
                            ->whereTanggal($request->tanggal)
                            ->whereKeterangan('alpha')
                            ->count();
        $rank = $presents->firstItem();
        return view('presents.index', compact('presents','rank','masuk','telat','cuti','alpha'));
    }

    public function cari(Request $request, User $user)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $data = explode('-',$request->bulan);
        $presents = DB::table('absensis')
                            ->whereUserId($user->id)->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])->orderBy('tanggal','desc')
                            ->paginate(5);
        $masuk = DB::table('absensis')
                            ->whereUserId($user->id)->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])->whereKeterangan('masuk')
                            ->count();
        $telat = DB::table('absensis')
                            ->whereUserId($user->id)->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])->whereKeterangan('telat')
                            ->count();
        $cuti = DB::table('absensis')
                            ->whereUserId($user->id)->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])->whereKeterangan('cuti')
                            ->count();
        $alpha = DB::table('absensis')
                            ->whereUserId($user->id)->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])->whereKeterangan('alpha')
                            ->count();
        $kehadiran = DB::table('absensis')
                            ->whereUserId($user->id)->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])->whereKeterangan('telat')
                            ->get();
        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse('07:00:00')));
        }
        $url = 'https://kalenderindonesia.com/api/YZ35u6a7sFWN/libur/masehi/'.date('Y/m');
        $kalender = file_get_contents($url);
        $kalender = json_decode($kalender, true);
        $libur = false;
        $holiday = null;
        if ($kalender['Data'] != false) {
            for ($i=0; $i < count($kalender['Data']); $i++) { 
                if ($kalender['Data'][$i]['Date']['M'] == date('Y-m-d')) {
                    $libur = true;
                    $translate = $kalender['Data'][$i]['Holiday']['Name'];
                    $holiday = $kalender['Translate'][$translate];
                    break;
                }
            }
        }
        return view('users.show', compact('presents','user','masuk','telat','cuti','alpha','libur','totalJamTelat'));
    }

    public function cariDaftarHadir(Request $request)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $data = explode('-',$request->bulan);
        $presents = DB::table('absensis')
                            ->whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])
                            ->orderBy('tanggal','desc')->paginate(5);
        $masuk = DB::table('absensis')
                            ->whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])
                            ->whereKeterangan('masuk')->count();
        $telat = DB::table('absensis')
                            ->whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])
                            ->whereKeterangan('telat')->count();
        $cuti = DB::table('absensis')
                            ->whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])
                            ->whereKeterangan('cuti')->count();
        $alpha = DB::table('absensis')
                            ->whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal',$data[1])
                            ->whereYear('tanggal',$data[0])
                            ->whereKeterangan('alpha')->count();
        return view('presents.show', compact('presents','masuk','telat','cuti','alpha'));
    }

    public function checkIn(Request $request)
    {
        $users = User::all();
        $alpha = false;

        if (date('l') == 'Saturday' || date('l') == 'Sunday') {
            return redirect()->back()->with('error','Hari Libur Tidak bisa Absen');
        }

        foreach ($users as $user) {
            $absen = DB::table('absensis')
                            ->whereUserId($user->id)
                            ->whereTanggal(date('Y-m-d'))
                            ->first();
            if (!$absen) {
                $alpha = true;
            }
        }
        
        if ($alpha) {
            foreach ($users as $user) {
                if ($user->id != $request->id_user) {
                    DB::table('absensis')
                    ->insert([
                        'keterangan'    => 'Alpha',
                        'jam_masuk' => date('H:i:s'),
                        'tanggal'       => date('Y-m-d'),
                        'user_id'       => $user->id
                    ]); 
                }
            }
        }
        $waktu = DB::table('waktu')
                    ->where('keterangan', '=', "Masuk")->first();
        $pulang = DB::table('waktu')
                    ->where('keterangan', '=', "Pulang")->first();
        $present = DB::table('absensis')
                            ->whereUserId(Auth::user()->id)
                            ->whereTanggal(date('Y-m-d'))
                            ->first();
        if ($present) {
            if ($present->keterangan == 'Alpha') {
                $data['jam_masuk']  = date('H:i:s');
                $data['tanggal']    = date('Y-m-d');
                $data['user_id']    = Auth::user()->id;
                if (strtotime($data['jam_masuk']) >= strtotime($waktu->mulai) && strtotime($data['jam_masuk']) <= strtotime($waktu->batas)) {
                    $data['keterangan'] = 'Masuk';
                } else if (strtotime($data['jam_masuk']) > strtotime($waktu->batas) && strtotime($data['jam_masuk']) < strtotime($pulang->mulai)) {
                    $data['keterangan'] = 'Telat';
                } else {
                    $data['keterangan'] = 'Alpha';
                }
                DB::table('absensis')
                            ->whereUserId(Auth::user()->id)
                            ->whereTanggal(date('Y-m-d'))
                            ->update($data);
                return redirect()->back()->with('success','Check-in berhasil'); 
            } else {
                return redirect()->back()->with('error','Check-in gagal');
            }
        }
        else{
            $now  = date('H:i:s');
            $masuk1 = strtotime($now) >= strtotime($waktu->mulai) && strtotime($now) <= strtotime($waktu->batas);
            $masuk2 = strtotime($now) > strtotime($waktu->batas) && strtotime($now) < strtotime($pulang->mulai);
            if ($masuk1) {
                $keterangan = 'Masuk';
            } elseif ($masuk2) {
                $keterangan = 'Telat';
            } else {
                $keterangan = 'Alpha';
            }
        
            DB::table('absensis')->insertGetId([
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => $now,
            'keterangan' => $keterangan,
            'user_id' => $request->user_id
        ]);
            return redirect()->back()->with('success', 'Check-in berhasil');
        }
    }

    public function checkOut()
    {
            
        $data['jam_keluar'] = date('H:i:s');
        DB::table('absensis')
                            ->whereUserId(Auth::user()->id)
                            ->whereTanggal(date('Y-m-d'))
                            ->update($data);
        return redirect()->back()->with('success', 'Absensi Pulang berhasil, terimakasih sudah tepat waktu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $present = DB::table('absensis')
                            ->whereUserId($request->id_user)
                            ->whereTanggal(date('Y-m-d'))
                            ->first();
        if ($present) {
            return redirect()->back()->with('error','Absensi hari ini telah terisi');
        }
        $data = $request->validate([
            'keterangan'    => ['required'],
            'id_user'    => ['required']
        ]);
        $data['tanggal'] = date('Y-m-d');
        if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
            $data['jam_masuk'] = $request->jam_masuk;
            if (strtotime($data['jam_masuk']) >= strtotime('07:00:00') && strtotime($data['jam_masuk']) <= strtotime('08:00:00')) {
                $data['keterangan'] = 'Masuk';
            } else if (strtotime($data['jam_masuk']) > strtotime('08:00:00') && strtotime($data['jam_masuk']) <= strtotime('17:00:00')) {
                $data['keterangan'] = 'Telat';
            } else {
                $data['keterangan'] = 'Alpha';
            }
        }
        DB::table('absensis')->insert($data);
        return redirect()->back()->with('success','Kehadiran berhasil ditambahkan');
    }

    public function ubah(Request $request)
    {
        $present = DB::table('absensis')->findOrFail($request->id);
        echo json_encode($present);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $presents = DB::table('absensis')
                        ->whereUserId(auth()->user()->id)
                        ->whereMonth('tanggal',date('m'))
                        ->whereYear('tanggal',date('Y'))
                        ->orderBy('tanggal','desc')
                        ->paginate(6);
        $masuk = DB::table('absensis')
                        ->whereUserId(auth()->user()->id)
                        ->whereMonth('tanggal',date('m'))
                        ->whereYear('tanggal',date('Y'))
                        ->whereKeterangan('masuk')
                        ->count();
        $telat = DB::table('absensis')
                        ->whereUserId(auth()->user()->id)
                        ->whereMonth('tanggal',date('m'))
                        ->whereYear('tanggal',date('Y'))
                        ->whereKeterangan('telat')
                        ->count();
        $cuti = DB::table('absensis')
                        ->whereUserId(auth()->user()->id)
                        ->whereMonth('tanggal',date('m'))
                        ->whereYear('tanggal',date('Y'))
                        ->whereKeterangan('cuti')
                        ->count();
        $alpha = DB::table('absensis')
                        ->whereUserId(auth()->user()->id)
                        ->whereMonth('tanggal',date('m'))
                        ->whereYear('tanggal',date('Y'))
                        ->whereKeterangan('alpha')
                        ->count();
        return view('presents.show', compact('presents','masuk','telat','cuti','alpha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Present  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kehadiran)
    {
        $kehadiran= DB::table('absensis')->get();
        $data = $request->validate([
            'keterangan'    => ['required']
        ]);

        if ($request->jam_keluar) {
            $data['jam_keluar'] = $request->jam_keluar;
        }

        if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
            $data['jam_masuk'] = $request->jam_masuk;
            if (strtotime($data['jam_masuk']) >= strtotime('07:00:00') && strtotime($data['jam_masuk']) <= strtotime('08:00:00')) {
                $data['keterangan'] = 'Masuk';
            } else if (strtotime($data['jam_masuk']) > strtotime('08:00:00') && strtotime($data['jam_masuk']) <= strtotime('17:00:00')) {
                $data['keterangan'] = 'Telat';
            } else {
                $data['keterangan'] = 'Alpha';
            }
        } else {
            $data['jam_masuk'] = null;
            $data['jam_keluar'] = null;
        }
        $kehadiran->update($data);
        return redirect()->back()->with('success', 'Kehadiran tanggal "'.date('l, d F Y',strtotime($kehadiran->tanggal)).'" berhasil diubah');
    }
}
