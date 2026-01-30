<?php

namespace App\Services;

use App\Models\Reservation;
use App\Services\Contracts\ReservationServiceInterface;

class ReservationService implements ReservationServiceInterface
{
    public function listForUser(int $userId)
    {
        return Reservation::where('user_id', $userId)->orderByDesc('reservation_date')->get();
    }

    public function listAll()
    {
        return Reservation::orderByDesc('reservation_date')->get();
    }

    public function createReservation(array $data)
    {
        return Reservation::create($data);
    }

    public function updateStatus(int $reservationId, string $status): bool
    {
        $reservation = Reservation::find($reservationId);
        if (! $reservation) return false;
        $reservation->status = $status;
        return $reservation->save();
    }

    public function deleteReservation(int $reservationId): bool
    {
        $reservation = Reservation::find($reservationId);
        if (! $reservation) return false;
        return $reservation->delete();
    }
}
