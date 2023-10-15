<form action="/mitra/{{ $mitra->sobat_id }}/update" method="POST" id="frmmitra" enctype="multipart/form-data">
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
          <input type="text" value="{{ $mitra->sobat_id }}" class="form-control" name="sobat_id" id="sobat_id" placeholder="Sobat ID" disabled>
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
          <input type="text" value="{{ $mitra->nama }}" class="form-control" name="nama" id="nama" placeholder="Nama">
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
          <input type="text" value="{{ $mitra->no_hp }}" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor HP">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="mb-3">
          <select type="text" class="form-select" id="select-users" name="posisi" id="posisi">
            <option {{ $mitra->posisi ? 'selected' : '' }} value="{{ $mitra->posisi }}">Posisi</option>
            <option value="rb">Receiving Batching</option>
            <option value="edcod">Editing Coding</option>
            <option value="entri">Entry</option>
            <option value="peta">Olah Peta</option>
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
              <option {{ $mitra->id_kegiatan==$d->id_kegiatan ? 'selected' : '' }} value="{{ $d->id_kegiatan }}">{{ $d->nama_kegiatan}}</option>  
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="input-icon mb-3">
          <select type="text" class="form-select" id="sesi" name="sesi" value="">
            <option value="{{ $mitra->sesi }}">Sesi</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="mb-3">
          <div class="form-label">Foto</div>
            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto"/>
            <input type="hidden" name="old_foto" value="{{ $mitra->foto }}" id="">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="mb-3">
          <textarea class="form-control" name="catatan" id="catatan" rows="6" placeholder="Catatan">{{ $mitra->catatan }}</textarea>
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
          <input type="text" class="form-control" name="password" id="password" placeholder="Password, Hanya diisi jika ingin direset">
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