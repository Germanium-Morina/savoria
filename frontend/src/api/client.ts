import axios from 'axios';

const BASE = import.meta.env.VITE_API_URL ?? 'http://localhost';

const api = axios.create({
  baseURL: `${BASE.replace(/\/$/, '')}/api/v1`,
  withCredentials: true,
});

export default api;
