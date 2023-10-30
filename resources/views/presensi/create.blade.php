@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Buat Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
    <style>
        /* .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;
        } */
        
        #map {
            height: 450px;
            border-radius: 15px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
@endsection
@section('content')
    <div class="section full mt-2">
        <div class="section-title">Presensi</div>
        <div class="wide-block pt-2 pb-2">
            {{-- Great to start your projects from here. --}}
            {{-- camera --}}
            {{-- <div hidden class="row"> --}}
                {{-- <div class="col"> --}}
                    {{-- <div hidden class="webcam-capture"></div> --}}
                {{-- </div>
            </div> --}}
            {{-- <div class="row" style="margin-bottom: 15px; margin-top:15px">
                <div class="col"> --}}
                    <div id="map" style="z-index: 1"></div>
                {{-- </div>
            </div> --}}
            <div class="card mt-2">
                <div class="card-header">
                    <p class="card-text" id="paraID1">
                    {{-- <button onclick="getlocation()" class="btn btn-primary btn-block"><ion-icon name="locate-outline"></ion-icon>Simpan Kepulangan</button> --}}
                </div>
                <div class="card-body">
                    <input type="hidden" name="lokasi" id="lokasi">
                    <p class="card-text" id="paraID2">
                        
                    </p>
                    @if ($cek > 0)
                        <button id="takepresensi" class="btn btn-primary btn-block"><ion-icon name="locate-outline"></ion-icon>Simpan Kepulangan</button>
                    @else
                        <button id="takepresensi" class="btn btn-primary btn-block"><ion-icon name="locate-outline"></ion-icon>Simpan Kehadiran</button>
                    @endif
                </div>
            </div>
    </div>
@endsection

{{-- <audio id='notif_in'>
    <source src="{{ asset('assets/sound/notif_in.mp3')}}" type="audio/mpeg">
</audio>
<audio id='notif_out'>
    <source src="{{ asset('assets/sound/notif_out.mp3')}}" type="audio/mpeg">
</audio>
<audio id='notif_radius'>
    <source src="{{ asset('assets/sound/notif_radius.mp3')}}" type="audio/mpeg">
</audio> --}}

@push('myscript')
    <script>
        // var notif_in = document.getElementById('notif_in')
        // var notif_out = document.getElementById('notif_out')
        // var notif_radius = document.getElementById('notif_radius')
        // Webcam.set({
        //     height:480,
        //     width:640,
        //     image_format:'jpeg',
        //     jpeg_quality: 80
        // });

        // Webcam.attach('.webcam-capture');

        var variable1 = document.getElementById("paraID1");
        var variable2 = document.getElementById("paraID2");
 
        function getlocation() {
            navigator.geolocation.getCurrentPosition(showLoc);
            navigator.geolocation.getCurrentPosition(showLoc2);
        }

        function showLoc(pos) {
            variable1.innerHTML = "Lokasi saat ini: " +
                pos.coords.latitude + ", " +
                pos.coords.longitude;
        }

        function showLoc2(pos) {
            variable2.innerHTML = "Akurat sampai: "
                + pos.coords.accuracy + " meter";
        }

        document.body.onload = function(){
            getlocation();
        };

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude+", "+position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 16);
            var lokasi_kantor = "{{ $lok_kantor->lokasi_kantor }}";
            var lok = lokasi_kantor.split(",");
            var radius = "{{ $lok_kantor->radius }}";
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            // var lat1 = -8.488431;
            // var lon1 = 117.423025;
            var lat1 = lok[0];
            var lon1 = lok[1];
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map).bindPopup('Anda ada di sini');
            var circle = L.circle([lat1, lon1], {
                color: 'green',
                fillColor: 'lightgreen',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }
        function errorCallback() {

        }

        $('#takepresensi').click(function(e) {
            // Webcam.snap(function(uri) {
            //     image = uri
            // });
            var lokasi = $('#lokasi').val();
            $.ajax({
                type: 'POST',
                url: '/presensi/store',
                data:{
                    _token:'{{ csrf_token() }}',
                    // image: image,
                    lokasi: lokasi
                },
                cache:false,
                success:function(respond){
                    var status = respond.split("|");
                    if (status[0] == 'success') {
                        // if (status[2] == 'in') {
                        //     notif_in.play();
                        // } else {
                        //     notif_out.play();
                        // }
                        Swal.fire({
                            icon: 'success',
                            title: 'Yey...',
                            text: status[1],
                            })
                            setTimeout("location.href='/dashboard'",0);
                    } else {
                        // if (status[2] == 'radius') {
                        //     notif_radius.play();
                        // }
                        Swal.fire({
                            icon: 'error',
                            title: 'Waduh...',
                            text: status[1],
                            })
                    }
                }
            });
        });
    </script>
@endpush