<?php

namespace App\Services\Contracts;

interface ReservationServiceInterface
{
    /**
     * Return reservations for a user as Eloquent collection
     */
    public function listForUser(int $userId);

    /**
     * Create and return a Reservation model
     */
    public function createReservation(array $data);

    public function updateStatus(int $reservationId, string $status): bool;

    /**
     * Return all reservations as Eloquent collection
     */
    public function listAll();

    public function deleteReservation(int $reservationId): bool;
}
