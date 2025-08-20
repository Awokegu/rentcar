@extends('layouts.myapp')

@section('content')
<div class="container">
    <h2>Vehicle Map</h2>
    <div id="map" style="height: 600px; width: 100%;"></div>
</div>

<script>
    var map = L.map('map').setView([9.03, 38.74], 7); // default center

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);

    var cars = @json($cars); // We'll pass this from controller

    vehicles.forEach(function(v) {
        if(v.latitude && v.longitude) {
            L.marker([v.latitude, v.longitude]).addTo(map)
             .bindPopup(`<b>${v.name}</b><br>Speed: ${v.speed ?? 0} km/h`);
        }
    });
</script>
@endsection

