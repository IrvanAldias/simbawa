@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Lapor Izin/Sakit</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
        @endphp
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess }}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror }}
            </div> 
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        @if ($dataizin->isEmpty())
        <div class="alert alert-danger">
            <p>Tidak ada data</p>
        </div>
        @else
        <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                        <div>Laporan</div>
                        <div>Status Pengajuan</div>
                    </div>
                </div>
            </li>   
            @foreach ($dataizin as $d)
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            <b>{{ date('d-m-Y', strtotime($d->tgl_izin))}}</b><br>
                            <small>{{ $d->status=="s" ? "Sakit" : "Izin" }}</small><br>
                            <small>{{ $d->keterangan }}</small>
                        </div>
                        <div></div>
                        @if ($d->status_approved == 0)
                            <span class="badge badge-warning">Tunggu</span>
                        @elseif ($d->status_approved == 1)
                            <span class="badge badge-success">Diterima</span>
                        @elseif ($d->status_approved == 2)
                            <span class="badge badge-danger">Ditolak</span>
                        @endif
                    </div>
                </div>
            </li>                            
            @endforeach
        </ul>
        @endif
    </div>
</div>
        <!-- bottom center -->
        <div class="fab-button text bottom-center">
            <a href="/presensi/buatizin" class="fab">
                <ion-icon name="add-outline"></ion-icon>
                Buat Izin
            </a>
        </div>
        <!-- * bottom center -->
@endsection