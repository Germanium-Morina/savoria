import React from 'react';
import { useGetCart } from '../hooks/useCart';
import { updateCart, clearCart } from '../api/cart';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import { Link } from 'react-router-dom';

export default function CartSidebar() {
  const qc = useQueryClient();
  const { data, isLoading } = useGetCart();

  const updateMutation = useMutation((payload: any) => updateCart(payload), {
    onSuccess: () => qc.invalidateQueries(['cart']),
  });

  const clearMutation = useMutation(() => clearCart(), {
    onSuccess: () => qc.invalidateQueries(['cart']),
  });

  if (isLoading) return <div>Loading cart...</div>;

  const items = data?.data || [];
  const total = items.reduce((s: number, it: any) => s + (it.line_total ?? (it.menu_item.price * it.quantity)), 0);

  return (
    <aside className="border rounded p-4 bg-white dark:bg-gray-800">
      <h3 className="font-semibold">Your Cart</h3>
      {items.length === 0 ? (
        <div className="text-gray-600 mt-2">Your cart is empty</div>
      ) : (
        <div className="space-y-3 mt-3">
          {items.map((it: any) => (
            <div key={it.menu_item.id} className="flex items-center justify-between">
              <div>
                <div className="font-medium">{it.menu_item.name}</div>
                <div className="text-sm text-gray-600">Qty: {it.quantity}</div>
              </div>
              <div className="text-right">
                <div className="font-medium">${(it.line_total ?? it.menu_item.price * it.quantity).toFixed(2)}</div>
              </div>
            </div>
          ))}
          <div className="pt-2 border-t mt-2 flex items-center justify-between">
            <div className="font-semibold">Total</div>
            <div className="font-bold">${total.toFixed(2)}</div>
          </div>
          <div className="flex gap-2 mt-3">
            <Link to="/checkout" className="flex-1 text-center px-3 py-2 bg-green-600 text-white rounded">Checkout</Link>
            <button onClick={() => clearMutation.mutate()} className="px-3 py-2 border rounded">Clear</button>
          </div>
        </div>
      )}
    </aside>
  );
}
