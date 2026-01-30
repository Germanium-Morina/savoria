import React from 'react';
import { useMutation } from '@tanstack/react-query';
import { createReservation } from '../api/reservations';

export default function Footer() {
  const mutation = useMutation((payload: any) => createReservation(payload));

  const handleSubmit = (e: any) => {
    e.preventDefault();
    const form = new FormData(e.target);
    const payload: any = {
      name: form.get('name'),
      email: form.get('email'),
      phone: form.get('phone'),
      date: form.get('date'),
      time: form.get('time'),
      guests: form.get('guests'),
    };
    mutation.mutate(payload);
  };

  return (
    <footer className="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-8">
      <div className="max-w-6xl mx-auto px-4 py-8">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 className="text-xl font-semibold">Make a Reservation</h3>
            <p className="text-sm text-gray-600">Book your table for an unforgettable dining experience</p>
            <form id="reservationForm" onSubmit={handleSubmit} className="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
              <input name="name" placeholder="Full Name" required className="border rounded px-3 py-2" />
              <input name="email" type="email" placeholder="Email" required className="border rounded px-3 py-2" />
              <input name="phone" placeholder="Phone" required className="border rounded px-3 py-2" />
              <input name="date" type="date" required className="border rounded px-3 py-2" />
              <select name="time" required className="border rounded px-3 py-2">
                <option value="">Select time</option>
                <option value="17:00">5:00 PM</option>
                <option value="17:30">5:30 PM</option>
                <option value="18:00">6:00 PM</option>
                <option value="18:30">6:30 PM</option>
                <option value="19:00">7:00 PM</option>
                <option value="19:30">7:30 PM</option>
                <option value="20:00">8:00 PM</option>
              </select>
              <select name="guests" required className="border rounded px-3 py-2">
                <option value="">Guests</option>
                <option value="1">1 Guest</option>
                <option value="2">2 Guests</option>
                <option value="3">3 Guests</option>
                <option value="4">4 Guests</option>
                <option value="5">5 Guests</option>
              </select>
              <div className="md:col-span-2">
                <button type="submit" className="px-4 py-2 bg-orange-500 text-white rounded">Reserve Now</button>
              </div>
            </form>
            {mutation.isSuccess && <div className="mt-3 text-green-600">Reservation created</div>}
            {mutation.isError && <div className="mt-3 text-red-600">Error creating reservation</div>}
          </div>

          <div>
            <h3 className="text-xl font-semibold">Contact</h3>
            <p className="text-sm text-gray-600 mt-2">123 Gourmet Street, Culinary District</p>
            <p className="text-sm text-gray-600">(555) 123-4567</p>
            <p className="text-sm text-gray-600">info@savoria.com</p>
          </div>
        </div>
      </div>
    </footer>
  );
}
