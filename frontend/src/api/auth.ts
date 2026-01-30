import api from './client';

export const login = async (payload: { email: string; password: string }) => {
  const res = await api.post('/auth/login', payload);
  return res.data;
};

export const register = async (payload: { name: string; email: string; password: string; password_confirmation: string }) => {
  const res = await api.post('/auth/register', payload);
  return res.data;
};

export const logout = async () => {
  const res = await api.post('/auth/logout');
  return res.data;
};
