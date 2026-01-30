import React from 'react'
import { useMutation } from '@tanstack/react-query'
import api from '../api/client'
import { useNavigate } from 'react-router-dom'
import { useGetCart } from '../hooks/useCart'

export default function CheckoutPage() {
  const navigate = useNavigate();
  const mutation = useMutation((payload: any) => api.post('/checkout', payload), {
    onSuccess: () => navigate('/'),
  });

  const { data: cartData } = useGetCart();

  const handleSubmit = (e: any) => {
    e.preventDefault();
    const form = new FormData(e.target);
    const payload: any = {
      name: form.get('name'),
      email: form.get('email'),
      phone: form.get('phone'),
      order_type: form.get('order_type'),
      delivery_address: form.get('delivery_address'),
      notes: form.get('notes'),
    };
    // include cart items (backend expects `cart` in payload for sessionless SPAs)
    const cartItems = cartData?.data || [];
    payload.cart = cartItems.map((it: any) => ({ menu_item: { id: it.menu_item.id }, quantity: it.quantity, line_total: it.line_total }));
    mutation.mutate(payload);
  }

  return (
    <div className="max-w-lg">
      <h2 className="text-2xl font-semibold mb-4">Checkout</h2>
      <form onSubmit={handleSubmit} className="space-y-4">
        <div>
          <label className="block text-sm font-medium text-gray-700">Name</label>
          <input name="name" required className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Email</label>
          <input name="email" type="email" required className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Phone</label>
          <input name="phone" className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Order Type</label>
          <select name="order_type" className="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
            <option value="pickup">Pickup</option>
            <option value="delivery">Delivery</option>
          </select>
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Delivery Address</label>
          <input name="delivery_address" className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Notes</label>
          <textarea name="notes" className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <button type="submit" disabled={(cartData?.data || []).length === 0} className="px-4 py-2 bg-indigo-600 text-white rounded disabled:opacity-50">Place Order</button>
        </div>
      </form>
    </div>
  )
}
