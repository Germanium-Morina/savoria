import React from 'react';
import { useFeatured } from '../hooks/useFeatured';
import MenuCard from './MenuCard';

export default function FeaturedGrid({ onView }: { onView: (item: any) => void }) {
  const featured = useFeatured();

  if (featured.isLoading) return <div>Loading...</div>;

  return (
    <div>
      <h2 className="text-2xl font-semibold mb-4">Featured</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {featured.data?.data?.map((item: any) => (
          <MenuCard key={item.id} item={item} onView={onView} />
        ))}
      </div>
    </div>
  );
}
