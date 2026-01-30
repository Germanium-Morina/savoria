import React from 'react';
import { useAddToCart } from '../hooks/useCart';

export default function MenuCard({ item, onView }: { item: any; onView: (item: any) => void }) {
  const addToCart = useAddToCart();

  const handleAdd = () => {
    addToCart.mutate({ menu_item_id: item.id, quantity: 1 });
  };

  return (
    <div className="border rounded-lg overflow-hidden shadow-sm bg-white dark:bg-gray-800">
      {item.image_url ? (
        <img src={item.image_url} alt={item.name} className="w-full h-48 object-cover" />
      ) : (
        <div className="w-full h-48 bg-gray-100 flex items-center justify-center">🍽️</div>
      )}
      <div className="p-4">
        <h4 className="font-semibold text-lg">{item.name}</h4>
        {item.description && <p className="text-sm text-gray-600 dark:text-gray-300 mt-2">{item.description}</p>}
        <div className="mt-4 flex items-center justify-between">
          <div className="font-medium">${Number(item.price).toFixed(2)}</div>
          <div className="flex items-center gap-2">
            <button onClick={() => onView(item)} className="text-sm px-3 py-1 border rounded">Details</button>
            <button onClick={handleAdd} className="bg-indigo-600 text-white px-3 py-1 rounded">Add</button>
          </div>
        </div>
      </div>
    </div>
  );
}
