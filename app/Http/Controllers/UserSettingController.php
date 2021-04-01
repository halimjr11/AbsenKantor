<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\divisi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserSettingController extends Controller
{
    public function form()
    {   
        
        $data = DB::table('users')
                    ->join('divisis', function ($join) {
                        $join->on('users.divisi', '=', 'divisis.id_divisi')
                             ->where('users.id','=', Auth::id());
                    })
                    ->first();
                    $list = DB::table('pengajuan')->get();           
        $divisi = Divisi::all();
        return view('app.pages.user.setting', ['dt'=>$data], compact('divisi','list'));
    }

    public function update(Request $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'divisi' => $request->divisi,
                'password' => bcrypt($request->password)
            ]);
        return redirect('user/profile/',Auth::user()->id)->with('status', 'Pegawai berhasil diupdate!'); 
    }
}
