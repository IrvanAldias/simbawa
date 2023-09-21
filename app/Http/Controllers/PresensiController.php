<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    //
    public function create()
    {
        $hariini = date("Y-m-d");
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('sobat_id', $sobat_id)->count();
        return view('presensi.create', compact('cek'));
    }

    public function store(Request $request)
    {
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");

        $lokasi = $request->lokasi;
        $lokasiuser = explode(',', $lokasi);
        // $lat1 = -8.488431;
        // $lon1 = 117.423025;
        $lat1 = $lokasiuser[0];
        $lon1 = $lokasiuser[1];
        $lat2 = $lokasiuser[0];
        $lon2 = $lokasiuser[1];
        $jarak = $this->distance($lat1, $lon1, $lat2, $lon2);
        $radius = round($jarak['meters']);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('sobat_id', $sobat_id)->count();
        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }
        // $image = $request->image;
        // $folderPath = "public/uploads/presensi/";
        // $formatName = $sobat_id . "-" . $tgl_presensi . "-" . $ket;
        // $image_parts = explode(";base64", $image);
        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName = $formatName . ".png";
        // $file = $folderPath . $fileName;

        if ($radius > 100) {
            echo "error|Hayo.. Anda berada di luar radius kantor! " . $radius . " meter dari kantor|radius";
        } else {
            if ($cek > 0) {
                $data_2 = [
                    'jam_out' => $jam,
                    // 'foto_out' => $fileName,
                    'lokasi_out' => $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('sobat_id', $sobat_id)->update($data_2);
                if ($update) {
                    echo "success|Terimakasih, hati-hati di jalan dan selamat beristirahat.|out";
                    // Storage::put($file, $image_base64);
                } else {
                    echo "error|Presensi gagal dicatat!|out";
                }
            } else {
                $data = [
                    'sobat_id' => $sobat_id,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    // 'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Semangat dan selamat bekerja!|in";
                    // Storage::put($file, $image_base64);
                } else {
                    echo "error|Presensi gagal dicatat!|in";
                }
            }
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $mitra = DB::table('mitra')->where('sobat_id', $sobat_id)->first();
        return view('presensi.editprofile', compact('mitra'));
    }

    public function updateprofile(Request $request)
    {
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $nama = $request->nama;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $mitra = DB::table('mitra')->where('sobat_id', $sobat_id)->first();
        if ($request->hasFile('foto')) {
            $foto = $sobat_id . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $mitra->foto;
        }
        if (empty($request->password)) {
            $data = [
                'nama' => $nama,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama' => $nama,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto,
            ];
        }

        $update = DB::table('mitra')->where('sobat_id', $sobat_id)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/mitra";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Profil berhasil diperbarui']);
        } else {
            return Redirect::back()->with(['error' => 'Profil gagal diperbarui']);
        }
    }

    public function histori()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $histori = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('sobat_id', $sobat_id)
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $dataizin = DB::table('pengajuan_izin')->where('sobat_id', $sobat_id)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function buatizin()
    {
        return view('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'sobat_id' => $sobat_id,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);
        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Laporan berhasil diajukan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Laporan gagal diajukan']);
        }
    }

    public function updateizin(Request $request)
    {
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'sobat_id' => $sobat_id,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);
        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Laporan berhasil diajukan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Laporan gagal diajukan']);
        }
    }
}
