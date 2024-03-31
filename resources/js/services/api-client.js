import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000/api',
    timeout: 3000,
    headers: { "Content-Type": 'application/json' },
});

class ApiClient
{
    get(path, params) {
        return axiosInstance.get(path, params);
    }
}

export default new ApiClient();