<template>
    <div>
        <MapWithMarker
            ref="mapWithMarker"
            :markers="markers"
            :initialCenter="initialCenter"
            @markerMoved="handleMarkerMoved"
        />
    </div>
</template>

<script>
import MapWithMarker from "./MapWithMarker.vue";
import "leaflet/dist/leaflet.css";

export default {
    name: "MapComponent",
    components: { MapWithMarker },
    props: {
        id: { type: String, required: true }, // tracking_code du voyage
        userType: { type: String, required: true }, // "driver" ou "passenger"
    },
    data() {
        return {
            markers: [
                {
                    id: "driver",
                    lat: 51.505,
                    lng: -0.09,
                    iconUrl: "/assets/icon/car.png",
                },
                {
                    id: "passenger",
                    lat: 51.53,
                    lng: -0.066,
                    iconUrl: "/assets/icon/pin.png",
                },
            ],
            initialCenter: [51.505, -0.09],
        };
    },
    mounted() {
        Echo.private(`travel-live-location.${this.id}`).listenForWhisper(
            "driver-location",
            (e) => {
                if (this.userType === "passenger") {
                    this.$refs.mapWithMarker.updateMarkerPosition(
                        e.newPosition
                    );
                }
            }
        );
    },
    methods: {
        handleMarkerMoved(newPosition) {
            if (this.userType === "driver") {
                Echo.private(`travel-live-location.${this.id}`).whisper(
                    "driver-location",
                    {
                        newPosition: newPosition,
                    }
                );
            }
        },
    },
};
</script>
