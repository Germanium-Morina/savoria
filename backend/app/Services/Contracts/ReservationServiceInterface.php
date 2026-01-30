<?php

namespace App\Services\Contracts;

interface ReservationServiceInterface
{
    public function listForUser(int $userId): array;

    public function createReservation(array $data): array;

    public function updateStatus(int $reservationId, string $status): bool;
}
