<?php

namespace App\Services;

use App\Models\Reservation;
use App\Services\Contracts\ReservationServiceInterface;

class ReservationService implements ReservationServiceInterface
{
    public function listForUser(int $userId): array
    {
        return Reservation::where('user_id', $userId)->orderByDesc('reservation_date')->get()->toArray();
    }

    public function createReservation(array $data): array
    {
        $reservation = Reservation::create($data);
        return $reservation->toArray();
    }

    public function updateStatus(int $reservationId, string $status): bool
    {
        $reservation = Reservation::find($reservationId);
        if (! $reservation) return false;
        $reservation->status = $status;
        return $reservation->save();
    }
}
