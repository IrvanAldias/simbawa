<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MitraController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Mitra::query();
        $query->select('mitra.*', 'nama_kegiatan');
        $query->join('kegiatan', 'mitra.kegiatan_id', '=', 'kegiatan.id_kegiatan');
        $query->orderBy('nama');
        if (!empty($request->nama)) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }
        if (!empty($request->kegiatan_id)) {
            $query->where('mitra.kegiatan_id', $request->kegiatan_id);
        }
        $mitra = $query->paginate(2);

        $kegiatan = DB::table('kegiatan')->get();
        return view('mitra.index', compact('mitra', 'kegiatan'));
    }

    public function store(Request $request)
    {
        $sobat_id = $request->sobat_id;
        $nama = $request->nama;
        $posisi = $request->posisi;
        $password = Hash::make('Mitrabps1');
        $no_hp = $request->no_hp;
        $catatan = $request->catatan;
        $sesi = $request->sesi;
        $kegiatan_id = $request->kegiatan_id;
        $mitra = DB::table('mitra')->where('sobat_id', $sobat_id)->first();
        if ($request->hasFile('foto')) {
            $foto = $sobat_id . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $mitra->foto;
        }
        try {
            $data = [
                'sobat_id' => $sobat_id,
                'nama' => $nama,
                'password' => $password,
                'posisi' => $posisi,
                'no_hp' => $no_hp,
                'catatan' => $catatan,
                'sesi' => $sesi,
                'kegiatan_id' => $kegiatan_id,
                'foto' => $foto
            ];
            $simpan = DB::table('mitra')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/mitra";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data mitra berhasil disimpan']);
            }
        } catch (\Exception $e) {
            // return Redirect::back()->with(['error' => 'Data mitra gagal disimpan']);
            dd($e);
        }
    }
}
