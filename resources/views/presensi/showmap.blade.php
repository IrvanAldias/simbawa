<style>
    #map { height: 250px; }
</style>
<div id="map"></div>
<script>
    var lokasi = "{{ $presensi->lokasi_in }}";
    var lok = lokasi.split(',');
    var latitude = lok[0];
    var longitude = lok[1];
    var map = L.map('map').setView([{{ $presensi->lokasi_in }}], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var lat1 = -8.488431;
    var lon1 = 117.423025;
    var marker = L.marker([latitude, longitude]).addTo(map).bindPopup('{{ $presensi->nama }}');
    var circle = L.circle([lat1, lon1], {
        color: 'green',
        fillColor: 'lightgreen',
        fillOpacity: 0.5,
        radius: 100
    }).addTo(map);
</script>