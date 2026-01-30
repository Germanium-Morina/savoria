<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ReservationServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;

class ReservationController extends Controller
{
    protected ReservationServiceInterface $service;

    public function __construct(ReservationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json(['data' => $this->service->listForUser($user->id)]);
    }

    public function store(ReservationStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()?->id ?? null;
        $reservation = $this->service->createReservation($data);

        return response()->json(['data' => $reservation], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $this->authorize('update', \App\Models\Reservation::class);
        $data = $request->validate(['status' => 'required|string']);
        $ok = $this->service->updateStatus((int) $id, $data['status']);
        return response()->json(['success' => $ok]);
    }
}
