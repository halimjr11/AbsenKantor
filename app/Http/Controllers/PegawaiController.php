<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PegawaiController extends Controller
{
    public function index()
    {
        $user = DB::table('users')
                    ->join('divisis', function ($join) {
                        $join->on('users.divisi', '=', 'divisis.id_divisi')
                            ->where('users.level', '!=', "admin");
                    })
                    ->orderBy('name', 'asc')
                    ->get();
        return view('app.pages.user.pegawai', compact('user'));
    }

    public function add(){
        $divisi = Divisi::all();
        return view('app.pages.user.tambah', compact('divisi'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'jk' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:1024'],
            'divisi' => ['required'],
            'password' => ['alphanumeric', 'symbol', 'min:8', 'confirmed'],
        ]);
    }

    public function save(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'divisi' => $request->divisi,
            'password' => bcrypt($request->password)
        ]);
        return redirect(route('app.pegawai'))->with('status', 'Pegawai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $edit =  DB::table('users')->get();
        $divisi = Divisi::all();
        return view('app.pages.user.admineditor', compact('edit','divisi'));
    }

    public function put(Request $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'notif' => $request->notif,
                'telp' => $request->telp,
                'divisi' => $request->divisi,
                'password' => bcrypt($request->password)
            ]);
            return redirect('pegawai')->with('status', 'Pegawai berhasil diupdate!');
    }
    public function kick($id){
        DB::table('users')
            ->where('id', '=', $id)
            ->delete();
        return redirect('pegawai')->with('status', 'Pegawai berhasil dihapus!');
    }
}
