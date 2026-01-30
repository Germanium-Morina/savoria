import { createSlice } from '@reduxjs/toolkit';
import type { PayloadAction } from '@reduxjs/toolkit';

interface AuthState {
  user: any | null;
}

const initialState: AuthState = {
  user: null,
};

const slice = createSlice({
  name: 'auth',
  initialState,
  reducers: {
    setAuth(state, action: PayloadAction<{ user: any }>) {
      state.user = action.payload.user;
    },
    clearAuth(state) {
      state.user = null;
    },
  },
});

export const { setAuth, clearAuth } = slice.actions;
export default slice.reducer;
