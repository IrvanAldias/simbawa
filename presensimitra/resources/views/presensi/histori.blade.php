@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Riwayat Bulanan</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
<div class="section full mt-2">
    <div class="section-title">Riwayat Bulanan</div>
    <div class="wide-block pt-2 pb-2">
        <div class="form-group">
            <select name="tahun" id="tahun" class="form-control">
                <option value="">Tahun</option>
                @php
                $tahunmulai = 2022;
                $tahunsekarang = date('Y');
                @endphp
                @for ($tahun=$tahunmulai; $tahun <= $tahunsekarang; $tahun++)
                <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}> {{ $tahun }} </option>
                @endfor 
            </select>
        </div>
        <div class="form-group">
            <select name="bulan" id="bulan" class="form-control">
                <option value="">Bulan</option>
                @for ($i=1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}> {{ $namabulan[$i] }} </option>
                @endfor 
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" id="getdata">
                <ion-icon name="filter"></ion-icon> Filter
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col" id="showhistori">
    
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(function(){
        $("#getdata").click(function(e){
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            $.ajax({
                type: 'POST',
                url:'/gethistori',
                data: {
                    _token:"{{ csrf_token() }}",
                    bulan: bulan,
                    tahun: tahun
                },
                cache: false,
                success: function(respond){
                    $("#showhistori").html(respond);
                }
            });
        });
    });
</script>
@endpush