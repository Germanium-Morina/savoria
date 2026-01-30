import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query';
import { fetchCart } from '../api/cart';
import api from '../api/client';

export function useAddToCart() {
  const qc = useQueryClient();
  return useMutation((payload: { menu_item_id: number; quantity?: number }) => api.post('/cart/add', payload), {
    onSuccess: () => qc.invalidateQueries(['cart']),
  });
}

export function useGetCart() {
  return useQuery(['cart'], fetchCart);
}
