@extends('layouts.presensi')
@section('content')
{{-- <div class="section" id="user-section" style="background-color: #1e74fd"> --}}
<div class="section" id="user-section">
    
    <div id="user-detail">
        <a href="/editprofile">
            <div class="avatar">
                @if(!empty(Auth::guard('mitra')->user()->foto))
                @php
                $path = Storage::url('uploads/mitra/'.Auth::guard('mitra')->user()->foto);
                @endphp
                <img src="{{ url($path) }}" alt="avatar" class="imaged rounded" style="width: 48px; height:48px; object-fit: cover">
                @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w48 rounded">
                @endif
            </div>
        </a>
        <div id="user-info" style="text-align:center">
            <h3 id="user-name">{{ Auth::guard('mitra')->user()->nama }}</h3>
            <p id="user-role">{{ Auth::guard('mitra')->user()->posisi}}</p>
        </div>
        <a href="/proseslogout">
            <div class="avatar">
                <ion-icon name="log-out-outline" class="h2" style="color: aliceblue"></ion-icon>
            </div>
        </a>
    </div>
    </div>
    <div class="section" id="menu-section">
        <div class="card text-white bg-warning mb-2">
            <div class="card-header text-center">{{ date('D, d-m-Y') }}</div>
            {{-- <div class="card-body">
                <h5 class="card-title">Warning card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div> --}}
        </div>
        {{-- <div class="chip chip-warning ml-05 mb-05 text-center">
            <span class="chip-label">Warning</span>
        </div> --}}
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            Jam Datang
                        </div>
                        <div class="menu-name">
                            {{-- <span class="text-center h2 text-primary">{{ $presensihariini != null ? $presensihariini->jam_in : '-'}}</span> --}}
                            <span class="text-center h2 text-primary">{{ $presensihariini != null ? date('H:i', strtotime($presensihariini->jam_in)) : '-'}}</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            Jam Pulang
                        </div>
                        <div class="menu-name">
                            <span class="text-center h2 blue text-primary">{{ $presensihariini != null && $presensihariini->jam_out != null ? date('H:i', strtotime($presensihariini->jam_out)) : '-'}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                        {{-- <ion-icon name="calendar" class="h2"></ion-icon> --}}
                                        <img src="assets/img/calendar.png" alt="" style="height: 50px">
                                    </div>
                                    <div class="menu-name mt-1">
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
                                        {{-- <ion-icon name="locate" class="h2"></ion-icon> --}}
                                        <img src="assets/img/map.png" alt="" style="height: 50px">
                                    </div>
                                    <div class="menu-name mt-1">
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
                                        {{-- <ion-icon name="document-text" class="h2"></ion-icon> --}}
                                        <img src="assets/img/note.png" alt="" style="height: 50px">
                                    </div>
                                    <div class="menu-name mt-1">
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
                                    <div>{{ date('d-m-Y', strtotime($d->tgl_presensi))}}</div>
                                    <span class="badge badge-success">{{ $d->jam_in }}</span>
                                    <span class="badge badge-danger">{{ $presensihariini != null && $d->jam_out != null ? $d->jam_out : 'Belum' }}</span>
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
                                                <span class="rekappresencedetail">{{ $rekapizin->jmlizin }} Hari</span>
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
                                                <span class="rekappresencedetail">{{ $rekapizin->jmlsakit }} Hari</span>
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
                                                <span class="rekappresencedetail">{{ $rekappresensi->jml_terlambat }} Hari</span>
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