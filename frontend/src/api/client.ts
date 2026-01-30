import axios from 'axios';

const BASE = import.meta.env.VITE_API_URL ?? 'http://localhost';

const api = axios.create({
  baseURL: `${BASE.replace(/\/$/, '')}/api/v1`,
  withCredentials: true,
});

// attach Authorization header if token is available
api.interceptors.request.use((config) => {
  try {
    const token = localStorage.getItem('api_token');
    if (token && config.headers) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
  } catch (e) {
    // ignore
  }
  return config;
});

export default api;
