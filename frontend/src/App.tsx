import React, { useEffect } from 'react'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import './App.css'
import MenuPage from './pages/MenuPage'
import CartPage from './pages/CartPage'
import CheckoutPage from './pages/CheckoutPage'
import LoginPage from './pages/LoginPage'
import RegisterPage from './pages/RegisterPage'
import HomePage from './pages/HomePage'
import Header from './components/Header'
import Footer from './components/Footer'
import { useQueryClient } from '@tanstack/react-query'
import { syncLocalCartToServer } from './utils/cartSync'

export default function App() {
  const qc = useQueryClient();

  useEffect(() => {
    // best-effort: merge any legacy localStorage cart into server cart on startup
    syncLocalCartToServer(() => qc.invalidateQueries(['cart']))
  }, [qc]);

  return (
    <BrowserRouter>
      <Header />

      <main className="max-w-6xl mx-auto px-4 py-6">
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/menu" element={<MenuPage />} />
          <Route path="/cart" element={<CartPage />} />
          <Route path="/checkout" element={<CheckoutPage />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/register" element={<RegisterPage />} />
        </Routes>
      </main>

      <Footer />
    </BrowserRouter>
  )
}
