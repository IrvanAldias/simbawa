@extends('layouts.admin.tabler')
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
                          {{ $rekapizin->jml_izin != null ? $rekapizin->jml_izin : 0 }}
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
                          {{ $rekapizin->jml_sakit != null ? $rekapizin->jml_sakit : 0 }}
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

@endsection