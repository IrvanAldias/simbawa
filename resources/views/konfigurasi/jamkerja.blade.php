@extends('layouts.admin.tabler')
@section('content')
    <!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                Konfigurasi
                </div>
                <h2 class="page-title">
                Jam Kerja
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
                  <a href="#" class="btn btn-primary" id="btnTambahjk">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                      <path d="M16 19h6"></path>
                      <path d="M19 16v6"></path>
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                   </svg>
                    Tambah Data</a>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12" style="overflow-x:auto;">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode JK</th>
                        <th>Nama JK</th>
                        <th>Awal Jam Masuk</th>
                        <th>Jam Masuk</th>
                        <th>AKhir Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($jam_kerja as $d)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->kode_jam_kerja }}</td>
                            <td>{{ $d->nama_jam_kerja }}</td>
                            <td>{{ $d->awal_jam_masuk }}</td>
                            <td>{{ $d->jam_masuk }}</td>
                            <td>{{ $d->akhir_jam_masuk }}</td>
                            <td>{{ $d->jam_pulang }}</td>
                            <td>
                              <div class="btn-group">
                                <a href="#" class="edit btn btn-info btn-sm" kode_jam_kerja="{{ $d->kode_jam_kerja }}">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                 </svg>
                                </a>
                                <form action="/konfigurasi/{{ $d->kode_jam_kerja }}/delete" method="POST" style="margin-left: 5px">
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
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal modal-blur fade" id="modal-inputjk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Jam Kerja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/konfigurasi/storejamkerja" method="POST" id="frmjk">
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
                  <input type="text" value="" class="form-control" name="kode_jam_kerja" id="kode_jam_kerja" placeholder="Kode Jam Kerja">
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
                  <input type="text" value="" class="form-control" name="nama_jam_kerja" id="nama_jam_kerja" placeholder="Nama Jam Kerja">
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
                  <input type="text" value="" class="form-control" name="awal_jam_masuk" id="awal_jam_masuk" placeholder="Awal Jam Masuk">
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
                  <input type="text" value="" class="form-control" name="jam_masuk" id="jam_masuk" placeholder="Jam Masuk">
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
                  <input type="text" value="" class="form-control" name="akhir_jam_masuk" id="akhir_jam_masuk" placeholder="Akhir Jam Masuk">
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
                  <input type="text" value="" class="form-control" name="jam_pulang" id="jam_pulang" placeholder="Jam Pulang">
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
  
  <div class="modal modal-blur fade" id="modal-editjk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Jam Kerja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">
          
        </div>
      </div>
    </div>
  </div>

@endsection

@push('myscript')
<script>
  $(function(){
    $('#awal_jam_masuk, #jam_masuk, #akhir_jam_masuk, #jam_pulang').mask('00:00:00');

    $("#btnTambahjk").click(function(){
      $("#modal-inputjk").modal("show");
    });

    $(".edit").click(function(){
      var kode_jam_kerja = $(this).attr('kode_jam_kerja');
      $.ajax({
        type: 'POST',
        url: '/konfigurasi/editjamkerja',
        cache: false,
        data: {
          _token: "{{ csrf_token(); }}",
          kode_jam_kerja: kode_jam_kerja
        },
        success:function(respond){
          $("#loadeditform").html(respond);
        }
      });
      $("#modal-editjk").modal("show");
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

    $("#frmjk").submit(function(){
      var kode_jam_kerja= $("#kode_jam_kerja").val();
      var nama_jam_kerja = $("#nama_jam_kerja").val();
      var awal_jam_masuk = $("#awal_jam_masuk").val();
      var jam_masuk = $("#jam_masuk").val();
      var akhir_jam_masuk = $("#akhir_jam_masuk").val();
      var jam_pulang = $("#jam_pulang").val();
      if(kode_jam_kerja==""){
        Swal.fire({
          title: 'Warning!',
          text: 'Kode jam kerja harus terisi',
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then((result) => {
          $("#kode_jam_kerja").focus();
        });
        return false;
      } else if (nama_jam_kerja=="") {
        Swal.fire({
          title: 'Warning!',
          text: 'Nama jam kerja harus terisi',
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then((result) => {
          $("#nama_jam_kerja").focus();
        });
        return false;
      } else if (awal_jam_masuk=="") {
        Swal.fire({
          title: 'Warning!',
          text: 'Awal jam masuk harus terisi',
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then((result) => {
          $("#awal_jam_masuk").focus();
        });
        return false;
      } else if (jam_masuk=="") {
        Swal.fire({
          title: 'Warning!',
          text: 'Jam Masuk harus terisi',
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then((result) => {
          $("#jam_masuk").focus();
        });
        return false;
      } else if (akhir_jam_masuk=="") {
        Swal.fire({
          title: 'Warning!',
          text: 'Akhir jam masuk harus terisi',
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then((result) => {
          $("#akhir_jam_masuk").focus();
        });
        return false;
      } else if (jam_pulang=="") {
        Swal.fire({
          title: 'Warning!',
          text: 'Jam pulang harus terisi',
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then((result) => {
          $("#jam_pulang").focus();
        });
        return false;
      }
    });
  });
</script>
@endpush