@extends('layouts.admin.tabler')
@section('content')
    <!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                Data Master
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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                @if (Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif

                @if (Session::get('error'))
                <div class="alert alert-warning">
                    {{Session::get('error')}}
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="row ">
                  <div class="col-12">
                    <a href="#" class="btn btn-primary" id="btnTambahMitra">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M16 19h6"></path>
                        <path d="M19 16v6"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                     </svg>
                      Tambah Data</a>
                      <a href="#" class="btn btn-success" id="btnImporMitra">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                          <path d="M16 19h6"></path>
                          <path d="M19 16v6"></path>
                          <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                       </svg>
                        Impor Data</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form action="/mitra" method="GET">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Mitra" value="{{ Request('nama') }}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <select name="id_kegiatan" class="form-select" id="id_kegiatan">
                          <option value="">Kegiatan</option>
                          @foreach ($kegiatan as $d)
                            <option {{ Request('id_kegiatan')==$d->id_kegiatan ? 'selected' : '' }} value="{{ $d->id_kegiatan }}">{{ $d->nama_kegiatan}}</option>  
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
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
            <div class="row mt-2">
              <div class="col-12" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Sobat ID</th>
                      <th>Nama</th>
                      <th>Posisi</th>
                      <th>Nomor HP</th>
                      <th>Foto</th>
                      <th>Kegiatan</th>
                      <th>Sesi</th>
                      <th>Catatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($mitra as $d)
                    @php
                      $path = Storage::url('uploads/mitra/'.$d->foto);
                    @endphp
                        <tr>
                          <td>{{ $loop->iteration + $mitra->firstItem()-1 }}</td>
                          <td>{{ $d->sobat_id }}</td>
                          <td>{{ $d->nama }}</td>
                          <td>{{ $d->posisi }}</td>
                          <td>{{ $d->no_hp }}</td>
                          <td>
                            @if (empty($d->foto))
                              <img src="{{ asset('assets/img/nophoto.png') }}" class="avatar me-2" alt="">
                            @else
                              <span class="avatar me-2" style="background-image: url({{ url($path) }})"></span>
                            @endif
                          </td>
                          <td>{{ $d->nama_kegiatan }}</td>
                          <td>{{ $d->sesi }}</td>
                          <td>{{ $d->catatan }}</td>
                          <td>
                            <div class="btn-group">
                              <a href="#" class="edit btn btn-info btn-sm" sobat_id="{{ $d->sobat_id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                  <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                  <path d="M16 5l3 3"></path>
                               </svg>
                              </a>
                              <form action="/mitra/{{ $d->sobat_id }}/delete" method="POST" style="margin-left: 5px">
                                @csrf
                                <a class="btn btn-danger btn-sm delete-confirm">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7l16 0"></path>
                                    <path d="M10 11l0 6"></path>
                                    <path d="M14 11l0 6"></path>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                 </svg>
                                </a>
                              </form>
                            </div>
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

<div class="modal modal-blur fade" id="modal-inputmitra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Mitra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/mitra/store" method="POST" id="frmmitra" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3"></path>
                    <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6"></path>
                    <path d="M12 11v2a14 14 0 0 0 2.5 8"></path>
                    <path d="M8 15a18 18 0 0 0 1.8 6"></path>
                    <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95"></path>
                 </svg>
                </span>
                <input type="text" value="" class="form-control" name="sobat_id" id="sobat_id" placeholder="Sobat ID">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                 </svg>
                </span>
                <input type="text" value="" class="form-control" name="nama" id="nama" placeholder="Nama">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                 </svg>
                </span>
                <input type="text" value="" class="form-control" name="password" id="password" placeholder="Password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                    <path d="M15 7a2 2 0 0 1 2 2"></path>
                    <path d="M15 3a6 6 0 0 1 6 6"></path>
                 </svg>
                </span>
                <input type="text" value="" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor HP">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <select type="text" class="form-select" id="select-users" name="posisi" id="posisi" value="">
                  <option value="">Posisi</option>
                  <option value="Receiving-Batching">Receiving Batching</option>
                  <option value="Editing-Coding">Editing Coding</option>
                  <option value="Entri">Entry</option>
                  <option value="Peta">Olah Peta</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <select name="id_kegiatan" class="form-select" id="id_kegiatan">
                  <option value="">Kegiatan</option>
                  @foreach ($kegiatan as $d)
                    <option {{ Request('id_kegiatan')==$d->id_kegiatan ? 'selected' : '' }} value="{{ $d->id_kegiatan }}">{{ $d->nama_kegiatan}}</option>  
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <select type="text" class="form-select" id="sesi" name="sesi" value="">
                  {{-- <option value="">Sesi</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option> --}}
                  @foreach ($konfigurasi_jam as $d)
                  <option {{ Request('sesi')==$d->kode_jam_kerja ? 'selected' : '' }} value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja}}</option>  
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <div class="form-label">Foto</div>
                  <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto"/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <textarea class="form-control" name="catatan" id="catatan" rows="6" placeholder="Catatan"></textarea>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-12">
              <div class="form-group">
                <button class="btn btn-primary w-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                 </svg>
                 Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-blur fade" id="modal-editmitra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Mitra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="loadeditform">
        
      </div>
    </div>
  </div>
</div>

<div class="modal modal-blur fade" id="modal-impormitra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Impor Data Mitra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/mitra/import" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <div class="form-label">FIle</div>
                  <input type="file" class="form-control" name="data" id="data" placeholder="File"/>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-12">
              <div class="form-group">
                <button class="btn btn-primary w-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                 </svg>
                 Kirim</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('myscript')
<script>
  $(function(){
    $("#btnTambahMitra").click(function(){
      $("#modal-inputmitra").modal("show");
    });

    $("#btnImporMitra").click(function(){
      $("#modal-impormitra").modal("show");
    });

    $(".edit").click(function(){
      var sobat_id = $(this).attr('sobat_id');
      $.ajax({
        type: 'POST',
        url: '/mitra/edit',
        cache: false,
        data: {
          _token: "{{ csrf_token(); }}",
          sobat_id: sobat_id
        },
        success:function(respond){
          $("#loadeditform").html(respond);
        }
      });
      $("#modal-editmitra").modal("show");
    });

    $(".delete-confirm").click(function(e){
      var form = $(this).closest('form')
      e.preventDefault();
      Swal.fire({
        title: 'Apakah anda yakin data ini mau dihapus?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
          Swal.fire(
            'Terhapus!',
            'Data berhasil dihapus.',
            'success'
          )
        }
      })
    })

    $("#frmmitra").submit(function(){
      var sobat_id = $("#sobat_id").val();
      var nama = $("#nama").val();
      var password = $("#password").val();
      var no_hp = $("#no_hp").val();
      var posisi = $("frmMitra").find("#posisi").val();
      var id_kegiatan = $("frmMitra").find("#id_kegiatan").val();
      var sesi = $("frmMitra").find("#sesi").val();
      if(sobat_id==""){
        Swal.fire({
          title: 'Warning!',
          text: 'Sobat Id harus terisi',
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then((result) => {
          $("#sobat_id").focus();
        });
        return false;
      }
      // else if (nama=="") {
      //   Swal.fire({
      //     title: 'Warning!',
      //     text: 'Nama harus terisi',
      //     icon: 'warning',
      //     confirmButtonText: 'Ok'
      //   }).then((result) => {
      //     $("#nama").focus();
      //   });
      //   return false;
      // } else if (posisi=="") {
      //   Swal.fire({
      //     title: 'Warning!',
      //     text: 'Posisi harus terisi',
      //     icon: 'warning',
      //     confirmButtonText: 'Ok'
      //   }).then((result) => {
      //     $("#posisi").focus();
      //   });
      //   return false;
      // } else if (id_kegiatan=="") {
      //   Swal.fire({
      //     title: 'Warning!',
      //     text: 'Kegiatan harus terisi',
      //     icon: 'warning',
      //     confirmButtonText: 'Ok'
      //   }).then((result) => {
      //     $("#id_kegiatan").focus();
      //   });
      //   return false;
      // }
    });
  });
</script>
@endpush