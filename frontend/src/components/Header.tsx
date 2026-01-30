import React from 'react';
import { Link } from 'react-router-dom';
import { useAppSelector } from '../store/hooks';
import { useLogout } from '../hooks/useAuth';

export default function Header() {
  const user = useAppSelector(s => s.auth.user);
  const logout = useLogout();

  return (
    <header className="d-flex top-header w-100 border-bottom border-dark sticky-top" style={{ backgroundColor: 'white', top: 0 }}>
      <div className="d-flex justify-content-between py-3 w-100 header-container align-items-center">
        <h1 style={{ color: 'black' }}>
          <Link to="/" style={{ color: 'black', textDecoration: 'none' }}>Savoria</Link>
        </h1>

        <ul className="d-flex list-unstyled gap-4 m-0 justify-content-center align-items-center navbar" style={{ margin: 0, padding: 0 }}>
          <li>
            <Link to="/" style={{ textDecoration: 'none', color: window.location.pathname === '/' ? '#ea580c' : '#4b5563' }}>Home</Link>
          </li>
          <li>
            <Link to="/menu" style={{ textDecoration: 'none', color: window.location.pathname === '/menu' ? '#ea580c' : '#4b5563' }}>Menu</Link>
          </li>
          <li>
            <Link to="/about" style={{ textDecoration: 'none', color: window.location.pathname === '/about' ? '#ea580c' : '#4b5563' }}>About</Link>
          </li>
          <li>
            <Link to="/contact" style={{ textDecoration: 'none', color: window.location.pathname === '/contact' ? '#ea580c' : '#4b5563' }}>Contact</Link>
          </li>
          <li>
            <a href="#reservationForm" style={{ color: '#4b5563', textDecoration: 'none' }}>Reservation</a>
          </li>
        </ul>

        <div className="d-flex gap-3">
          {user ? (
            <div className="dropdown">
              <button className="btn btn-profile dropdown-toggle" style={{ color: '#ea580c' }} type="button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#ea580c" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                  <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="#ea580c" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
              </button>
            </div>
          ) : (
            <>
              <Link className="btn btn-Reserve" to="/login">Login to Reserve</Link>
              <Link className="btn btn-order" to="/register">Sign Up</Link>
            </>
          )}
        </div>
      </div>
    </header>
  );
}
