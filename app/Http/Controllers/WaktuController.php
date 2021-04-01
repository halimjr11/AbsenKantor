<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WaktuController extends Controller
{
    public function index()
    {
        $waktu = DB::table('waktu')->get();
        $list = DB::table('pengajuan')->get();
        return view('app.pages.waktu.jam', compact('waktu','list'));
    }

    public function edit($id)
    {
        $edit = DB::table('waktu')->where('id', $id)->first();
        $list = DB::table('pengajuan')->get();
        return view('app.pages.waktu.edit', compact('edit','list'));
    }

    public function update(Request $request, $id)
    {
        DB::table('waktu')
        ->where('id', $id)
        ->update([
            'mulai' => $request->mulai,
            'batas' => $request->batas
        ]);

         return redirect('waktu')->with('status', 'Rentang Waktu Absensi berhasil diperbarui! ');
    }
}
