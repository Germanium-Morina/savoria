import { useQuery } from '@tanstack/react-query';
import { fetchFeatured } from '../api/menu';

export function useFeatured() {
  return useQuery(['featured'], fetchFeatured);
}
