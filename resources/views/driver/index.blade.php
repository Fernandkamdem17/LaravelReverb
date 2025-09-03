

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Espace Chauffeur</h2>

        {{-- On passe le tracking_code du voyage dans le composant --}}
        <map-component id="{{ $travel->tracking_code }}" user-type="driver"/>


            <p>Tracking code actuel : {{ $travel->tracking_code }}</p>

    </div>

    <br>

    <div id="map" style="height: 500px;"></div>

    <script>
        // Initialisation de la carte
        // let map = L.map('map').setView([3.8667, 11.5167], 13); // Yaoundé par défaut
        let map = L.map('map').setView([5.4778, 10.4170], 13); // Bafoussam


        // Ajouter un fond de carte (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Marqueur chauffeur (déplaçable)
        let driverMarker = L.marker([3.8667, 11.5167], { draggable: true }).addTo(map)
            .bindPopup(" Chauffeur");
            

        // Quand on déplace le marqueur
        driverMarker.on('dragend', function (e) {
            let pos = e.target.getLatLng();
            console.log("Nouvelle position envoyée", pos);

            Echo.private(`travel-live-location.{{ $travel->tracking_code }}`)
                .whisper('driver-location', {
                    lat: pos.lat,
                    lng: pos.lng,
                });
        });

        map.setView(driverMarker.getLatLng(), 15);
        driverMarker.openPopup();


    </script>


@endsection

