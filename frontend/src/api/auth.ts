import api from './client';
import axios from 'axios';

const BASE = import.meta.env.VITE_API_URL ?? 'http://localhost';
const SANCTUM_CSRF = `${BASE.replace(/\/$/, '')}/sanctum/csrf-cookie`;
const LOGIN_URL = `${BASE.replace(/\/$/, '')}/login`;
const LOGOUT_URL = `${BASE.replace(/\/$/, '')}/logout`;

export const getCsrf = async () => {
  await axios.get(SANCTUM_CSRF, { withCredentials: true });
};

export const login = async (payload: { email: string; password: string }) => {
  await getCsrf();
  const res = await axios.post(LOGIN_URL, payload, { withCredentials: true });
  return res.data;
};

export const register = async (payload: { name: string; email: string; password: string; password_confirmation: string }) => {
  const res = await api.post('/auth/register', payload);
  return res.data;
};

export const logout = async () => {
  await axios.post(LOGOUT_URL, {}, { withCredentials: true });
};
