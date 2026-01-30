import React from 'react';
import FeaturedGrid from '../components/FeaturedGrid';

export default function HomePage() {
  return (
    <div>
      <section className="introduction-section">
        <div className="introduction-container">
          <h1 className="no-shadow">Savoria</h1>
          <p className="no-shadow">Experience culinary excellence with our carefully crafted dishes.</p>
        </div>
      </section>

      <section className="container-menu">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div className="text-center">
            <h3 className="legacy-title">Fine Dining</h3>
            <p className="legacy-description">Experience culinary excellence with our carefully crafted dishes.</p>
          </div>
          <div className="text-center">
            <h3 className="legacy-title">Premium Drinks</h3>
            <p className="legacy-description">Enjoy premium wines, craft cocktails, and artisanal beverages.</p>
          </div>
          <div className="text-center">
            <h3 className="legacy-title">5-Star Service</h3>
            <p className="legacy-description">Our staff ensures every guest receives exceptional service.</p>
          </div>
        </div>
      </section>

      <section className="container-menu">
        <FeaturedGrid onView={() => {}} />
      </section>
    </div>
  );
}
