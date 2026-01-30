import api from './client';

export const fetchCart = async () => {
  const res = await api.get('/cart');
  return res.data;
};

export const addToCart = async (payload: { menu_item_id: number; quantity?: number }) => {
  const res = await api.post('/cart/add', payload);
  return res.data;
};

export const updateCart = async (payload: { menu_item_id: number; quantity: number }) => {
  const res = await api.post('/cart/update', payload);
  return res.data;
};

export const clearCart = async () => {
  const res = await api.post('/cart/clear');
  return res.data;
};
