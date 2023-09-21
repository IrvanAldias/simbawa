@extends('layouts.admin.tabler')
@section('content')
    <!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                Master
                </div>
                <h2 class="page-title">
                Data Mitra
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            {{-- <a href="" class="btn btn-primary" id="btnTambahMitra" style="margin-bottom: 15px"> --}}
                            <a href="" class="btn btn-primary" id="btnTambahMitra" data-bs-toggle="modal" data-bs-target="#tambah-mitra" style="margin-bottom: 15px">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                 </svg>
                                 Tambah Data</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="/mitra" method="GET">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="text" name="nama" id="nama" placeholder="Nama Mitra" value="{{ Request('nama') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <select name="kegiatan" id="kegiatan" class="form-select">
                                            @foreach ($kegiatan as $d)
                                                <option {{ Request('id_kegiatan')==$d->id_kegiatan ? 'selected' : ''}} value="{{ $d->id_kegiatan }}">{{ $d->nama_kegiatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                    <path d="M21 21l-6 -6"></path>
                                                 </svg>
                                                 Cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                  <thead>
                                    <tr>
                                      <th>Nomor</th>
                                      <th>Nama/Sobat ID</th>
                                      <th>Kegiatan/Posisi</th>
                                      <th>Nomor HP</th>
                                      <th>Catatan</th>
                                      <th class="w-1">Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($mitra as $d)
                                    @php
                                        $path = Storage::url('/uploads/mitra/'.$d->foto);    
                                    @endphp
                                    <tr>
                                        <td class="text-muted" >
                                        {{ $loop->iteration + $mitra->firstItem()-1 }}
                                        </td>
                                      <td >
                                        <div class="d-flex py-1 align-items-center">
                                            @if (empty($d->foto))
                                            <img src="{{ asset('assets/img/nophoto.png') }}" class="avatar me-2" alt="">
                                            @else
                                            <span class="avatar me-2" style="background-image: url({{ url($path) }})"></span>
                                            @endif
                                          <div class="flex-fill">
                                            <div class="font-weight-medium">{{ $d->nama }}</div>
                                            <div class="text-muted">{{ $d->sobat_id }}</div>
                                          </div>
                                        </div>
                                      </td>
                                      <td >
                                        <div>{{ $d->nama_kegiatan }}</div>
                                        <div class="text-muted">{{ $d->posisi }}</div>
                                      </td>
                                      <td class="text-muted" >
                                        {{ $d->no_hp }}
                                      </td>
                                      <td class="text-muted" >
                                        {{ $d->catatan }}
                                      </td>
                                      <td>
                                        <a href="#">Edit</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                {{ $mitra->links('vendor.pagination.bootstrap-5') }}

                        </div>
                    </div>
                      </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="tambah-mitra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Mitra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/mitra/store" method="POST" id="form-mitra" enctype="multipart/form-data">
          @csrf
          <div class="input-icon mb-3">
            <span class="input-icon-addon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-qrcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                <path d="M7 17l0 .01"></path>
                <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                <path d="M7 7l0 .01"></path>
                <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                <path d="M17 7l0 .01"></path>
                <path d="M14 14l3 0"></path>
                <path d="M20 14l0 .01"></path>
                <path d="M14 14l0 3"></path>
                <path d="M14 20l3 0"></path>
                <path d="M17 17l3 0"></path>
                <path d="M20 17l0 3"></path>
             </svg>
            </span>
            <input type="text" value="" class="form-control" id="sobat_id" name="sobat_id" placeholder="Sobat ID" required>
          </div>
          <div class="input-icon mb-3">
            <span class="input-icon-addon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
             </svg>
            </span>
            <input type="text" value="" class="form-control" id="nama" name="nama" placeholder="Nama" required>
          </div>
          <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
              <path d="M14 19l2 2l4 -4"></path>
              <path d="M9 8h4"></path>
              <path d="M9 12h2"></path>
           </svg>
            </span>
            <input type="text" value="" class="form-control" id="posisi" name="posisi" placeholder="Posisi" required>
          </div>
          <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
           </svg>
            </span>
            <input type="text" value="" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required>
          </div>
          <div class="input-icon mb-3">
            <span class="input-icon-addon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                <path d="M9 7l6 0"></path>
                <path d="M9 11l6 0"></path>
                <path d="M9 15l4 0"></path>
             </svg>
            </span>
            <input type="text" value="" class="form-control" id="catatan" name="catatan" placeholder="Catatan">
          </div>
          <select name="kegiatan" id="kegiatan" class="form-select">
            <option value="">Kegiatan</option>
            @foreach ($kegiatan as $d)
                <option {{ Request('id_kegiatan')==$d->id_kegiatan ? 'selected' : ''}} value="{{ $d->id_kegiatan }}">{{ $d->nama_kegiatan }}</option>
            @endforeach
          </select>
          <br>
          <input type="file" class="form-control" name="foto" placeholder="Foto">
          <br>
          {{-- <button type="button" class="btn me-auto" data-bs-dismiss="modal">Keluar</button> --}}
          <button type="button" class="btn btn-primary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M10 14l11 -11"></path>
              <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
           </svg>
            Simpan
          </button>
        </form>
      </div>
      {{-- <div class="modal-footer">
      </div> --}}
    </div>
  </div>
</div>

@endsection

@push('myscript')
<script>
  $(function(){
    // $("#btnTambahMitra").click(function(){
    //   // $("#tambah-mitra").modal("show");
    //   alert("test00");
    // });
    $('#form-mitra').submit(function(){
    //   var sobat_id = $('#sobat_id').val();
    //   var nama = $('#nama').val();
    //   var posisi = $('#posisi').val();
    //   var no_hp = $('#no_hp').val();
    //   var kegiatan = $('#kegiatan').val();
    //   if(sobat_id==""){
    //     Swal.fire({
    //       title: "Waduh",
    //       text: "Sobat_ID harus diisi!",
    //       icon: "warning",
    //       confirmButtonText: 'Bagus'
    //     }).then((result)=> {
    //       $("#sobat_id").focus();
    //     })
    //   } return false;
        alert("tetsts");

    });
  });
</script>
@endpush