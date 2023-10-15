<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KegiatanController extends Controller
{
    //
    public function index(Request $request)
    {
        // $kegiatan = DB::table('kegiatan')->orderBy('id_kegiatan')->get();
        $query = Kegiatan::query();
        $query->select('*');
        if (!empty($request->id_kegiatan)) {
            $query->where('id_kegiatan', 'like', '%' . $request->id_kegiatan . '%');
        }
        if (!empty($request->nama_kegiatan)) {
            $query->where('nama_kegiatan', 'like', '%' . $request->nama_kegiatan . '%');
        }
        $kegiatan = $query->get();
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $id_kegiatan = $request->id_kegiatan;
        $nama_kegiatan = $request->nama_kegiatan;
        $data = [
            'id_kegiatan' => $id_kegiatan,
            'nama_kegiatan' => $nama_kegiatan
        ];

        $simpan = DB::table('kegiatan')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data kegiatan berhasil disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data kegiatan gagal disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $id_kegiatan = $request->id_kegiatan;
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->first();
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update($id_kegiatan, Request $request)
    {
        $nama_kegiatan = $request->nama_kegiatan;
        $data = [
            'nama_kegiatan' => $nama_kegiatan
        ];
        $update = DB::table('kegiatan')->where('id_kegiatan',$id_kegiatan)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data kegiatan berhasil diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data kegiatan gagal diupdate']);
        }
    }

    public function delete($id_kegiatan)
    {
        $hapus = DB::table('kegiatan')->where('id_kegiatan',$id_kegiatan)->delete();
        if($hapus){
            return Redirect::back()->with(['success' => 'Data kegiatan berhasil dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data kegiatan gagal dihapus']);
        }
    }
}
