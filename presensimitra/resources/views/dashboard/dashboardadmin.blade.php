{{-- @extends('layouts.admin.tabler')
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                Overview
                </div>
                <h2 class="page-title">
                Horizontal layout
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
<div class="container-xl">
    <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                             </svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{ $rekappresensi->jml_hadir }}
                        </div>
                        <div class="text-muted">
                          Kehadiran Mitra
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M9 17h6"></path>
                                <path d="M9 13h6"></path>
                             </svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{ $rekapizin->jmlizin != null ? $rekapizin->jmlizin : 0 }}
                        </div>
                        <div class="text-muted">
                          Lapor Izin
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-sick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18z"></path>
                                <path d="M9 10h-.01"></path>
                                <path d="M15 10h-.01"></path>
                                <path d="M8 16l1 -1l1.5 1l1.5 -1l1.5 1l1.5 -1l1 1"></path>
                             </svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{ $rekapizin->jmlsakit != null ? $rekapizin->jmlsakit : 0 }}
                        </div>
                        <div class="text-muted">
                          Lapor Sakit
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                <path d="M12 10l0 3l2 0"></path>
                                <path d="M7 4l-2.75 2"></path>
                                <path d="M17 4l2.75 2"></path>
                             </svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{ $rekappresensi->jml_terlambat }}
                        </div>
                        <div class="text-muted">
                          Terlambat
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection --}}

@extends('layouts.presensi')
@section('content')
<div class="section" id="user-section" style="background-color: #1e74fd">
    <a href="/editprofile">
        <div id="user-detail">
            <div class="avatar">
                @if(!empty(Auth::guard('user')->user()->foto))
                @php
                $path = Storage::url('uploads/mitra/'.Auth::guard('mitra')->user()->foto);
                @endphp
                <img src="{{ url($path) }}" alt="avatar" class="imaged rounded" style="width: 48px; height:48px; object-fit: cover">
                @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w48 rounded">
                @endif
            </div>
            <div id="user-info" style="align-content: center">
                <h3 id="user-name">{{ Auth::guard('user')->user()->name }}</h3>
                <p id="user-role">{{ Auth::guard('user')->user()->email}}</p>
            </div>
        </div>
    </a>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <h3>Menu</h3>
            <div class="row">
                <div class="col-4">
                    <a href="/presensi/histori">
                        <div class="card">
                            <div class="card-body">
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <ion-icon name="calendar" class="h2"></ion-icon>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Riwayat Bulanan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="/presensi/create">
                        <div class="card">
                            <div class="card-body">
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <ion-icon name="locate" class="h2"></ion-icon>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Buat Presensi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="/presensi/izin">
                        <div class="card">
                            <div class="card-body">
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <ion-icon name="document-text" class="h2"></ion-icon>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Lapor Izin/Sakit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="camera"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>12:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        {{-- <div class="rekappresence">
            <div id="chartdiv"></div>
            <!-- <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence primary">
                                    <ion-icon name="log-in"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Hadir</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence green">
                                    <ion-icon name="document-text"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Izin</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence warning">
                                    <ion-icon name="sad"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Sakit</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence danger">
                                    <ion-icon name="alarm"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Terlambat</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div> --}}
        <h3>Presensi Bulan Ini</h3>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Rekapitulasi
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="item">
                                <div class="in">
                                    <div>Mitra</div>
                                    <div>Tanggal</div>
                                    <div>Jam Datang</div>
                                    <div>Jam Pulang</div>
                                </div>
                            </div>
                        </li>   
                        @foreach ($historibulanini as $d)
                        <li>
                            <div class="item">
                                <div class="in">
                                    <div>{{ $d->sobat_id }}</div>
                                    <div>{{ date('d-m-Y', strtotime($d->tgl_presensi))}}</div>
                                    <span class="badge badge-success">{{ $d->jam_in }}</span>
                                    <span class="badge badge-danger">{{ $d->jam_out != null ? $d->jam_out : 'Belum' }}</span>
                                </div>
                            </div>
                        </li>                            
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <div id="rekappresensi">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="presencecontent">
                                            <div class="iconpresence primary">
                                                <ion-icon name="log-in"></ion-icon>
                                            </div>
                                            <div class="presencedetail">
                                                <h4 class="rekappresencetitle">Hadir</h4>
                                                <span class="rekappresencedetail">{{ $rekappresensi->jml_hadir }} Hari</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="presencecontent">
                                            <div class="iconpresence green">
                                                <ion-icon name="document-text"></ion-icon>
                                            </div>
                                            <div class="presencedetail">
                                                <h4 class="rekappresencetitle">Izin</h4>
                                                <span class="rekappresencedetail">{{ $rekapizin->jmlizin != null ? $rekapizin->jmlizin : 0 }} Hari</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="presencecontent">
                                            <div class="iconpresence warning">
                                                <ion-icon name="sad"></ion-icon>
                                            </div>
                                            <div class="presencedetail">
                                                <h4 class="rekappresencetitle">Sakit</h4>
                                                <span class="rekappresencedetail">{{ $rekapizin->jmlsakit != null ? $rekapizin->jmlsakit : 0 }} Hari</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="presencecontent">
                                            <div class="iconpresence danger">
                                                <ion-icon name="alarm"></ion-icon>
                                            </div>
                                            <div class="presencedetail">
                                                <h4 class="rekappresencetitle">Terlambat</h4>
                                                <span class="rekappresencedetail">{{ $rekappresensi->jml_terlambat != null ? $rekappresensi->jml_terlambat : 0 }} Hari</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="item-menu text-center">
                                            <div class="menu-icon">
                                                <ion-icon name="accessibility"></ion-icon>
                                            </div>
                                            <div class="menu-name">
                                                <span class="text-center">Hadir</span>
                                            </div>
                                            <span class="badge bg-danger">10</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="item-menu text-center">
                                            <div class="menu-icon">
                                                <ion-icon name="mail"></ion-icon>
                                            </div>
                                            <div class="menu-name">
                                                <span class="text-center">Izin</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="item-menu text-center">
                                            <div class="menu-icon">
                                                <ion-icon name="medkit"></ion-icon>
                                            </div>
                                            <div class="menu-name">
                                                <span class="text-center">Sakit</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="item-menu text-center">
                                            <div class="menu-icon">
                                                <ion-icon name="timer"></ion-icon>
                                            </div>
                                            <div class="menu-name">
                                                <span class="text-center">Telat</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection