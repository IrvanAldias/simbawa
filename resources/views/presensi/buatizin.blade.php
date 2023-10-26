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
<div class="section full mt-2">
    <div class="section-title">Lapor Izin/Sakit</div>
    <div class="wide-block pt-2 pb-2">
        <div class="card mt-2">
            <form action="/presensi/storeizin" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="date" class="form-control" value="" name="tgl_izin" id='tgl_izin' placeholder="Tanggal" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <select name="status" id="status" class="form-control" required>
                                <option value="i">Izin</option>
                                <option value="s">Sakit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="submit" class="btn btn-primary btn-block">
                                <ion-icon name="send"></ion-icon>
                                Ajukan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection
@push('myscript')
    <script>
        $(document).ready(function(){
            $("#tgl_izin").change(function(e){
                var tgl_izin = $(this).val();
                $.ajax({
                    type: 'POST',
                    url:'/presensi/cekpengajuanizin',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tgl_izin: tgl_izin
                    },
                    catch: false,
                    success: function(respond) {
                        if(respond>0) {
                            Swal.fire({
                            icon: 'warning',
                            title: 'Waduh...',
                            text: 'Anda sudah mengjukan izin pada tanggal tersebut!',
                            }).then((result) => {
                                $("#tgl_izin").val("");                  
                        })
                    }
                }
                });
            });
        });
    </script>
@endpush