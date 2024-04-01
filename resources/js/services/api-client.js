import axios from 'axios';

const auth0AuthInfoLocalStorageKey = '@@auth0spajs@@::' + import.meta.env.VITE_AUTH0_CLIENT_ID + '::@@user@@';
const authInfo = JSON.parse(localStorage.getItem(auth0AuthInfoLocalStorageKey));
const timeout = 3000;

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_SERVER_URL + '/api',
    timeout: timeout,
    headers: { 
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + authInfo?.id_token,
    },
});

class ApiClient {
    get(path, params) {
        return axiosInstance.get(path, params);
    }
}

export default new ApiClient();