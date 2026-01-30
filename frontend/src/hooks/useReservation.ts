import { useMutation, useQuery } from '@tanstack/react-query';
import { createReservation, fetchReservations } from '../api/reservations';

export function useCreateReservation() {
  return useMutation((payload: any) => createReservation(payload));
}

export function useReservations() {
  return useQuery(['reservations'], fetchReservations, { enabled: false });
}
