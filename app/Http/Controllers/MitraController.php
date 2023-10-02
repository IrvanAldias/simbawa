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
        $query->join('kegiatan', 'mitra.id_kegiatan', '=', 'kegiatan.id_kegiatan');
        $query->orderBy('nama');
        if (!empty($request->nama)) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }
        if (!empty($request->id_kegiatan)) {
            $query->where('mitra.id_kegiatan', $request->id_kegiatan);
        }
        // if (!empty($request->posisi)) {
        //     $query->where('posisi', $request->posisi);
        // }
        // if (!empty($request->sesi)) {
        //     $query->where('sesi', $request->sesi);
        // }
        $mitra = $query->paginate(10);

        $kegiatan = DB::table('kegiatan')->get();

        return view('mitra.index', compact('mitra', 'kegiatan'));
    }

    public function store(Request $request)
    {
        $sobat_id = $request->sobat_id;
        $nama = $request->nama;
        $no_hp = $request->no_hp;
        $password = Hash::make('Mitrabps1');
        $id_kegiatan = $request->id_kegiatan;
        $posisi = $request->posisi;
        $sesi = $request->sesi;
        $catatan = $request->catatan;
        if ($request->hasFile('foto')) {
            $foto = $sobat_id . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
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
                'id_kegiatan' => $id_kegiatan,
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
            return Redirect::back()->with(['error' => 'Data mitra gagal disimpan']);
            dd($e);
        }
    }

    public function edit(Request $request)
    {
        $sobat_id = $request->sobat_id;
        $kegiatan = DB::table('kegiatan')->get();
        return view('mitra.edit', compact('kegiatan'));
    }
}
