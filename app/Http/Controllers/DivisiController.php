<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    public function index(){
        $divisi = DB::table('divisis')->get();
        return view('app.pages.divisi.divisi', compact('divisi'));
    }

    public function create(){
        return view('app.pages.divisi.input');
    }

    public function save(Request $request){
        DB::table('divisis')->insert([
            'nama' => $request->nama
        ]);
        return redirect('divisi')->with('status', 'Divisi ditambahkan!');
    }

    public function edit($id)
    {
        $edit = DB::table('divisis')->where('id', $id)->first();
        return view('app.pages.divisi.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        DB::table('divisis')
              ->where('id', $id)
              ->update(['nama' => $request->nama]);
        
        return redirect('divisi')->with('status', 'Divisi telah berhasil di Update!');    
    }

    public function delete($id)
    {
        DB::table('divisis')->where('id', '=', $id)->delete();

        return redirect('divisi')->with('status', 'Divisi telah dihapus!');
    }
}
