import './bootstrap';

import { createApp } from 'vue';
import { createAuth0 } from '@auth0/auth0-vue';
import App from './App.vue';

import '../css/app.css';

const app = createApp(App);

app.use(
    createAuth0({
        domain: import.meta.env.VITE_AUTH0_DOMAIN,
        clientId: import.meta.env.VITE_AUTH0_CLIENT_ID,
        useRefreshTokens: true,
        cacheLocation: 'localstorage',
        authorizationParams: {
            redirect_uri: window.location.origin
        }
    })
)
.mount('#app');