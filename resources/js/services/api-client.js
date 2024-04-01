import axios from 'axios';

const timeout = 3000;
let accessToken;

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_SERVER_URL + '/api',
    timeout: timeout,
    headers: { 
        'Content-Type': 'application/json',
    },
});

axiosInstance.interceptors.request.use((config) => {
    if (!accessToken) {
        const auth0AuthInfoLocalStorageKey = '@@auth0spajs@@::' + import.meta.env.VITE_AUTH0_CLIENT_ID + '::@@user@@';
        const authInfo = JSON.parse(localStorage.getItem(auth0AuthInfoLocalStorageKey));
        accessToken = authInfo?.id_token;
    }

    config.headers.Authorization = `Bearer ${accessToken}`;

    return config;
});

class ApiClient {
    get(path, params) {
        return axiosInstance.get(path, params);
    }
}

export default new ApiClient();