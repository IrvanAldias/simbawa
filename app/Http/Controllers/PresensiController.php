<?php

namespace App\Http\Controllers;

use App\Models\Pengajuanizin;
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
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view('presensi.create', compact('cek', 'lok_kantor'));
    }

    public function store(Request $request)
    {
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");


        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        $lok = explode(',', $lok_kantor->lokasi_kantor);
        // $lat1 = -8.488431;
        // $lon1 = 117.423025;
        $lat1 = $lok[0];
        $lon1 = $lok[1];

        $lokasi = $request->lokasi;
        $lokasiuser = explode(',', $lokasi);
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

        if ($radius > $lok_kantor->radius) {
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

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
            ->select('presensi.*','nama', 'nama_kegiatan', 'posisi', 'sesi')
            ->join('mitra','presensi.sobat_id','=','mitra.sobat_id')
            ->join('kegiatan','mitra.id_kegiatan','=','kegiatan.id_kegiatan')
            ->where('tgl_presensi', $tanggal)
            ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id',$id)
        ->join('mitra', 'presensi.sobat_id','=','mitra.sobat_id')
        ->first();
        return view('presensi.showmap', compact('presensi'));
    }

    public function laporan()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $mitra = DB::table('mitra')->orderBy('nama')->get();
        return view('presensi.laporan', compact('namabulan', 'mitra'));
    }

    public function cetaklaporan(Request $request)
    {
        $sobat_id = $request->sobat_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $mitra = DB::table('mitra')->where('sobat_id', $sobat_id)
            ->join('kegiatan', 'mitra.id_kegiatan','=','kegiatan.id_kegiatan')
            ->first();
        $presensi = DB::table('presensi')->where('sobat_id',$sobat_id)
            ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
            ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
            ->orderBy('tgl_presensi')
            ->get();
        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'mitra', 'presensi'));
    }

    public function rekap()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.rekap', compact('namabulan'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('presensi')
        ->selectRaw('presensi.sobat_id, nama,
        MAX(IF(DAY(tgl_presensi) = 1,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_1,
        MAX(IF(DAY(tgl_presensi) = 2,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_2,
        MAX(IF(DAY(tgl_presensi) = 3,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_3,
        MAX(IF(DAY(tgl_presensi) = 4,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_4,
        MAX(IF(DAY(tgl_presensi) = 5,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_5,
        MAX(IF(DAY(tgl_presensi) = 6,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_6,
        MAX(IF(DAY(tgl_presensi) = 7,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_7,
        MAX(IF(DAY(tgl_presensi) = 8,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_8,
        MAX(IF(DAY(tgl_presensi) = 9,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_9,
        MAX(IF(DAY(tgl_presensi) = 10,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_10,
        MAX(IF(DAY(tgl_presensi) = 11,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_11,
        MAX(IF(DAY(tgl_presensi) = 12,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_12,
        MAX(IF(DAY(tgl_presensi) = 13,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_13,
        MAX(IF(DAY(tgl_presensi) = 14,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_14,
        MAX(IF(DAY(tgl_presensi) = 15,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_15,
        MAX(IF(DAY(tgl_presensi) = 16,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_16,
        MAX(IF(DAY(tgl_presensi) = 17,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_17,
        MAX(IF(DAY(tgl_presensi) = 18,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_18,
        MAX(IF(DAY(tgl_presensi) = 19,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_19,
        MAX(IF(DAY(tgl_presensi) = 20,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_20,
        MAX(IF(DAY(tgl_presensi) = 21,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_21,
        MAX(IF(DAY(tgl_presensi) = 22,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_22,
        MAX(IF(DAY(tgl_presensi) = 23,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_23,
        MAX(IF(DAY(tgl_presensi) = 24,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_24,
        MAX(IF(DAY(tgl_presensi) = 25,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_25,
        MAX(IF(DAY(tgl_presensi) = 26,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_26,
        MAX(IF(DAY(tgl_presensi) = 27,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_27,
        MAX(IF(DAY(tgl_presensi) = 28,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_28,
        MAX(IF(DAY(tgl_presensi) = 29,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_29,
        MAX(IF(DAY(tgl_presensi) = 30,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_30,
        MAX(IF(DAY(tgl_presensi) = 31,CONCAT(jam_in,"-",IFNULL(jam_out,"kosong")),"")) as tgl_31')
        ->join('mitra','presensi.sobat_id','=','mitra.sobat_id')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->groupByRaw('presensi.sobat_id, nama')
        ->orderBy('mitra.posisi')
        ->get();

       return view('presensi.cetakrekap', compact('bulan', 'tahun', 'namabulan','rekap'));
    }

    public function izinsakit(Request $request)
    {
        $query = Pengajuanizin::query();
        $query->select('id','tgl_izin','pengajuan_izin.sobat_id','nama','posisi','status','status_approved','keterangan');
        $query->join('mitra','pengajuan_izin.sobat_id','=','mitra.sobat_id');

        if(!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_izin', [$request->dari, $request->sampai]);
        }
        if(!empty($request->sobat_id)) {
            $query->where('pengajuan_izin.sobat_id', $request->sobat_id);
        }
        if(!empty($request->nama)) {
            $query->where('nama', 'like', '%'.$request->nama.'%');
        }
        if($request->status_approved != ""){
            $query->where('status_approved', $request->status_approved);
        }

        $query->orderBy('tgl_izin','desc');
        $izinsakit = $query->paginate(10);
        $izinsakit->appends($request->all());
        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('pengajuan_izin')->where('id',$id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data berhasil diperbarui']);
        } else {
            return Redirect::back()->with(['warning' => 'Data gagal diperbarui']);
        }
    }

    public function batalizinsakit($id)
    {
        $update = DB::table('pengajuan_izin')->where('id',$id)->update([
            'status_approved' => 0
        ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data berhasil diperbarui']);
        } else {
            return Redirect::back()->with(['warning' => 'Data gagal diperbarui']);
        } 
    }

    public function cekpengajuanizin(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $cek = DB::table('pengajuan_izin')->where('sobat_id',$sobat_id)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }
}
