<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JatahCuti;
use App\DataTables\DaftarCutiDataTable;
use App\DataTables\PengajuanCutiDataTable;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Events\PengajuanCuti;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('jatah_cuti')->where('user_id', '=', Auth::id())->first();
        $cuti = DB::table('cuti')->where('user_id', '=', Auth::id())->get();
        $cutiall = DB::table('cuti')->get();
        return view('app.pages.pengajuan.cuti', compact('cuti','data', 'cutiall'));
    }
    
    public function approve($id){
        $data = User::join('cuti', 'cuti.user_id', '=', 'users.id')
                ->where('cuti.id_cuti', '=', $id)
                ->first();
        return view('app.pages.pengajuan.approval', compact('data'));
    }


    public function edit(Request $request,$id){
        $sisa_cuti = DB::table('jatah_cuti')->where('user_id', '=', Auth::id())->first();
        $cutisisa = $sisa_cuti->jumlah - $request->jumlah;
        if($request->approve == "Y"){
            $status = "Telah dikonfirmasi dan disetujui.";
            $stat = "Menyetujui";
            DB::table('jatah_cuti')->where('user_id', '=', Auth::id())->update(['jumlah' => $cutisisa]);
        }else{
            $status = "Telah dikonfirmasi dan ditolak. ";
            $stat = "Menolak";
        }

        DB::table('pengajuan')->where('id_cuti', $id)
        ->update([
            'read' => $request->approve,
            'status' => $stat
        ]);
        DB::table('cuti')->where('id_cuti', $id)
        ->update([
            'approve' => $request->approve,
            'ket_approve' => $request->alasan,
            'status' => $status
        ]);
        DB::table('keputusan')->insert([
            'keterangan' => $request->alasan,
            'status' => $stat,
            'user_id' => $request->user
        ]);
        event(new ApprovalCuti(Auth::user()->name, 0));
        return redirect('pengajuan');
    }
    public function create(){
        $data = DB::table('jatah_cuti')->where('user_id', '=', Auth::id())->first();
        return view('app.pages.pengajuan.create', compact('data',));
    }
    public function save(Request $request){
        $tanggal = $request->tgl_awal;
            $tanggal1 = $request->tgl_akhir;
            // memecah string tanggal awal untuk mendapatkan
                // tanggal, bulan, tahun
                $pecah1 = explode("-", $tanggal);
                $date1 = $pecah1[2];
                $month1 = $pecah1[1];
                $year1 = $pecah1[0];
            
                // memecah string tanggal akhir untuk mendapatkan
                // tanggal, bulan, tahun
                $pecah2 = explode("-", $tanggal1);
                $date2 = $pecah2[2];
                $month2 = $pecah2[1];
                $year2 =  $pecah2[0];
            
                // mencari total selisih hari dari tanggal awal dan akhir
                $jd1 = GregorianToJD($month1, $date1, $year1);
                $jd2 = GregorianToJD($month2, $date2, $year2);
            
                $selisih = $jd2 - $jd1;

            $libur1 = 0;
            $libur2 = 0;
            $libur3 = 0;
                
                // proses menghitung tanggal merah dan hari minggu
                // di antara tanggal awal dan akhir
                for($i=1; $i<=$selisih; $i++)
    {
        // menentukan tanggal pada hari ke-i dari tanggal awal
        $tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
        $tglstr = date("Y-m-d", $tanggal);
        $users = DB::table('libur')->first();
         
        // menghitung jumlah tanggal pada hari ke-i
        // yang masuk dalam daftar tanggal merah selain minggu
        if ($tglstr == $users->tgl_libur) 
        {
           $libur1++;
        }
         
        // menghitung jumlah tanggal pada hari ke-i
        // yang merupakan hari minggu
        if ((date("N", $tanggal) == 7))
        {
           $libur2++;
        }

        // menghitung jumlah tanggal pada hari ke-i
        // yang merupakan hari sabtu
        if ((date("N", $tanggal) == 6))
        {
           $libur3++;
        }
    }
    $jumlah_cuti = $selisih+1-$libur1-$libur2-$libur3;

        DB::table('cuti')->insert([
            'tanggal' => date('Y-m-d'),
            'user_id' => Auth::user()->id,
            'alasan' => $request->alasan,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'jumlah_cuti' => $jumlah_cuti
        ]);

        $cut = DB::table('cuti')
            ->where('user_id', '=', Auth::user()->id)
            ->where('tgl_awal', '=', $request->tgl_awal)
            ->where('tgl_akhir', '=', $request->tgl_akhir)
            ->where('alasan', '=', $request->alasan)
            ->first();

        DB::table('pengajuan')->insert([
            'id_cuti' => $cut->id_cuti,
            'tanggal' => date('Y-m-d'),
            'keterangan' => $request->alasan,
            'jenis' => "cuti",
            'user_id' => Auth::user()->id
        ]);

        event(new PengajuanCuti(Auth::user()->name, 1));
        return redirect('pengajuan')->with('alert', 'Pengajuan cuti berhasil ditambahkan');
    }
}