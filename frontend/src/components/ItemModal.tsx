import React from 'react';
import { useAddToCart } from '../hooks/useCart';

export default function ItemModal({ item, open, onClose }: { item: any | null; open: boolean; onClose: () => void }) {
  const addToCart = useAddToCart();

  if (!item) return null;

  const handleAdd = () => {
    addToCart.mutate({ menu_item_id: item.id, quantity: 1 });
    onClose();
  };

  return (
    <div className={`${open ? 'block' : 'hidden'} fixed inset-0 z-50 flex items-center justify-center`}> 
      <div className="absolute inset-0 bg-black/40" onClick={onClose} />
      <div className="bg-white dark:bg-gray-800 rounded-lg overflow-hidden z-10 max-w-2xl w-full">
        <div className="p-4">
          <div className="flex gap-4">
            {item.image_url && <img src={item.image_url} className="w-48 h-40 object-cover rounded" alt={item.name} />}
            <div>
              <h3 className="text-xl font-semibold">{item.name}</h3>
              <p className="text-sm text-gray-600 dark:text-gray-300 mt-2">{item.description}</p>
              <div className="mt-4 font-medium">${Number(item.price).toFixed(2)}</div>
              <div className="mt-4 flex gap-2">
                <button onClick={handleAdd} className="px-4 py-2 bg-indigo-600 text-white rounded">Add to cart</button>
                <button onClick={onClose} className="px-4 py-2 border rounded">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
