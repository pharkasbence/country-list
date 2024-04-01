import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_SERVER_URL + '/api',
    timeout: 3000,
    headers: { 
        'Content-Type': 'application/json',
    },
});

class ApiClient
{
    get(path, params) {
        return axiosInstance.get(path, params);
    }
}

export default new ApiClient();