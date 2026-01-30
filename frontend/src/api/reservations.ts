import api from './client';

export const createReservation = async (payload: any) => {
  const res = await api.post('/reservations', payload);
  return res.data;
};

export const fetchReservations = async () => {
  const res = await api.get('/reservations');
  return res.data;
};
