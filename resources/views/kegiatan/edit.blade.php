<form action="/kegiatan/{{ $kegiatan->id_kegiatan }}/update" method="POST" id="frmkegiatan">
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
        <input type="text" value="{{ $kegiatan->id_kegiatan }}" class="form-control" name="id_kegiatan" id="id_kegiatan" placeholder="ID Kegiatan" readonly>
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
        <input type="text" value="{{ $kegiatan->nama_kegiatan }}" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan">
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