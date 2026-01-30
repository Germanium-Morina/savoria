import React, { useState } from 'react'
import { useQuery } from '@tanstack/react-query'
import { fetchMenu } from '../api/menu'
import FeaturedGrid from '../components/FeaturedGrid'
import MenuCard from '../components/MenuCard'
import ItemModal from '../components/ItemModal'
import CartSidebar from '../components/CartSidebar'
import CategoryFilter from '../components/CategoryFilter'

export default function MenuPage() {
  const [selectedItem, setSelectedItem] = useState<any | null>(null);
  const [modalOpen, setModalOpen] = useState(false);
  const [activeCategory, setActiveCategory] = useState<string>('all');

  const menuQuery = useQuery(['menu'], () => fetchMenu());

  const categories = Array.from(new Set((menuQuery.data?.data || []).map((i: any) => i.category_name || 'Other')));

  const filtered = (menuQuery.data?.data || []).filter((it: any) => activeCategory === 'all' || (it.category_name || 'Other') === activeCategory);

  const handleView = (item: any) => {
    setSelectedItem(item);
    setModalOpen(true);
  };

  return (
    <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
      <div className="lg:col-span-3 space-y-6">
        <FeaturedGrid onView={handleView} />

        <section>
          <h2 className="text-2xl font-semibold mb-3">Menu</h2>
          <CategoryFilter categories={categories} active={activeCategory} onSelect={setActiveCategory} />
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            {menuQuery.isLoading ? (
              <div>Loading...</div>
            ) : (
              filtered.map((item: any) => <MenuCard key={item.id} item={item} onView={handleView} />)
            )}
          </div>
        </section>
      </div>

      <div>
        <CartSidebar />
      </div>

      <ItemModal item={selectedItem} open={modalOpen} onClose={() => setModalOpen(false)} />
    </div>
  )
}
