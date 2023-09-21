<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function homeuser()
    {
        $hariini = date('Y-m-d');
        $bulanini = date('m');
        $tahunini = date('Y');
        $sobat_id = Auth::guard('mitra')->user()->sobat_id;
        $presensihariini = DB::table('presensi')
            ->where('sobat_id', $sobat_id)
            ->where('tgl_presensi', $hariini)
            ->first();
        $historibulanini = DB::table('presensi')
            ->where('sobat_id', $sobat_id)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi')
            ->get();
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(sobat_id) as jml_hadir, SUM(IF(jam_in > "07:00",1,0)) as jml_terlambat')
            ->where('sobat_id', $sobat_id)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();
        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
            ->where('sobat_id', $sobat_id)
            ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
            ->where('status_approved', 1)
            ->first();
        return view('dashboard.dashboard', compact('presensihariini', 'historibulanini', 'rekappresensi', 'rekapizin'));
    }

    public function dashboardadmin()
    {
        $hariini = date('Y-m-d');
        $bulanini = date('m');
        $tahunini = date('Y');
        $historibulanini = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi')
            ->get();
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(sobat_id) as jml_hadir, SUM(IF(jam_in > "07:00",1,0)) as jml_terlambat')
            ->where('tgl_presensi', $hariini)
            ->first();
        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
            ->where('tgl_izin', $hariini)
            ->where('status_approved', 1)
            ->first();
        return view('dashboard.dashboardadmin', compact('rekappresensi', 'rekapizin', 'historibulanini'));
    }
}
