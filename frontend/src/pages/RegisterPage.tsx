import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useRegister } from '../hooks/useAuth';

export default function RegisterPage() {
  const navigate = useNavigate();
  const mutation = useRegister();
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');

  const submit = (e: React.FormEvent) => {
    e.preventDefault();
    mutation.mutate({ name, email, password, password_confirmation: passwordConfirmation }, { onSuccess: () => navigate('/') });
  };

  return (
    <div className="max-w-md">
      <h2 className="text-2xl font-semibold mb-4">Register</h2>
      <form onSubmit={submit} className="space-y-4">
        <div>
          <label className="block text-sm font-medium text-gray-700">Name</label>
          <input value={name} onChange={e => setName(e.target.value)} className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Email</label>
          <input value={email} onChange={e => setEmail(e.target.value)} className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" value={password} onChange={e => setPassword(e.target.value)} className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700">Confirm Password</label>
          <input type="password" value={passwordConfirmation} onChange={e => setPasswordConfirmation(e.target.value)} className="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <button type="submit" disabled={mutation.isLoading} className="px-4 py-2 bg-indigo-600 text-white rounded">{mutation.isLoading ? 'Creating...' : 'Register'}</button>
        </div>
        {mutation.isError && <div className="text-red-600">Registration failed</div>}
      </form>
    </div>
  );
}
