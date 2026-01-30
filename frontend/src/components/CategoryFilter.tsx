import React from 'react';

export default function CategoryFilter({ categories, active, onSelect }: { categories: string[]; active?: string; onSelect: (cat: string) => void }) {
  return (
    <div className="flex gap-2 flex-wrap mb-4">
      <button onClick={() => onSelect('all')} className={`px-3 py-1 rounded ${active === 'all' ? 'bg-orange-500 text-white' : 'bg-gray-100'}`}>All</button>
      {categories.map((c) => (
        <button key={c} onClick={() => onSelect(c)} className={`px-3 py-1 rounded ${active === c ? 'bg-orange-500 text-white' : 'bg-gray-100'}`}>{c}</button>
      ))}
    </div>
  );
}
