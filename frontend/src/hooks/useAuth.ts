import { useMutation } from '@tanstack/react-query';
import { login as apiLogin, register as apiRegister, logout as apiLogout } from '../api/auth';
import { useAppDispatch } from '../store/hooks';
import { setAuth, clearAuth } from '../features/auth/authSlice';

export function useLogin() {
  const dispatch = useAppDispatch();
  return useMutation((payload: { email: string; password: string }) => apiLogin(payload), {
    onSuccess: (data: any) => {
      if (data?.user) dispatch(setAuth({ user: data.user }));
    },
  });
}

export function useRegister() {
  const dispatch = useAppDispatch();
  return useMutation((payload: any) => apiRegister(payload), {
    onSuccess: (data: any) => {
      if (data?.user) dispatch(setAuth({ user: data.user }));
    },
  });
}

export function useLogout() {
  const dispatch = useAppDispatch();
  return useMutation(() => apiLogout(), {
    onSuccess: () => dispatch(clearAuth()),
  });
}
