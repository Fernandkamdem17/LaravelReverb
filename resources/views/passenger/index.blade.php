@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Espace Passager</h2>
        <p>Tracking code actuel : {{ $travel->tracking_code }}</p>
        <div id="map" style="height: 500px;"></div>
    </div>
@endsection

@push('script')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialisation de la carte
    let map = L.map('map').setView([3.8667, 11.5167], 13);

    // Fond de carte
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Marqueur chauffeur (sera mis à jour)
    let driverMarker = L.marker([3.8667, 11.5167]).addTo(map)
        .bindPopup("Chauffeur");

    // Abonnement au canal
    Echo.private(`travel-live-location.{{ $travel->tracking_code }}`)
    .listenForWhisper('driver-location', (e) => {
            console.log("Position reçue", e);

            if (e.lat && e.lng) {
                driverMarker.setLatLng([e.lat, e.lng]); // mise à jour du marqueur
                map.panTo([e.lat, e.lng]); // centrer la carte
            }
        });

    map.setView(driverMarker.getLatLng(), 15);
    driverMarker.openPopup();
});
</script>
@endpush
