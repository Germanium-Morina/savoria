import React from 'react'
import { Link } from 'react-router-dom'
import { useGetCart } from '../hooks/useCart'

export default function CartPage() {
  const { data, isLoading } = useGetCart();

  if (isLoading) return <div>Loading cart...</div>

  const items = data?.data || []
  const total = items.reduce((s: number, it: any) => s + (it.line_total ?? (it.menu_item.price * it.quantity)), 0)

  return (
    <div className="space-y-4">
      <h2 className="text-2xl font-semibold">Your Cart</h2>
      {items.length === 0 && <div className="text-gray-600">No items</div>}
      {items.map((it: any) => (
        <div key={it.menu_item.id} className="border-b border-gray-200 pb-3 pt-3">
          <h4 className="font-medium text-lg">{it.menu_item.name}</h4>
          <div className="text-sm text-gray-600">Qty: {it.quantity}</div>
          <div className="text-sm text-gray-800">Line: ${ (it.line_total ?? (it.menu_item.price * it.quantity)).toFixed(2) }</div>
        </div>
      ))}
      <div className="mt-4">
        <h3 className="text-xl font-bold">Total: ${total.toFixed(2)}</h3>
        <Link to="/checkout"><button className="mt-2 px-4 py-2 bg-indigo-600 text-white rounded">Checkout</button></Link>
      </div>
    </div>
  )
}
