import api from './client';

export const fetchFeatured = async () => {
  const res = await api.get('/featured-menu');
  return res.data;
};

export const fetchMenu = async (categoryId?: number) => {
  const res = await api.get('/menu', { params: { category_id: categoryId } });
  return res.data;
};
