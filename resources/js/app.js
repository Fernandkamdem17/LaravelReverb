import "./bootstrap.js";
import '../css/app.css';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import { createApp } from "vue";
// importer ton composant
import RequestTravel from './RequestTravel.vue'
import RequestDetails from './RequestDetails.vue'

// créer l’application Vue
const app = createApp({})

// enregistrer le composant global
app.component('request-travel', RequestTravel)
app.component('request-details', RequestDetails)

// monter l’app Vue sur l’élément #app
app.mount('#app')


window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});


