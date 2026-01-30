<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ReservationServiceInterface;
use App\Http\Resources\ReservationResource;
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
        $data = $this->service->listForUser($user->id);
        return response()->json(['data' => ReservationResource::collection($data)]);
    }

    public function store(ReservationStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()?->id ?? null;
        $reservation = $this->service->createReservation($data);

        return response()->json(['data' => new ReservationResource($reservation)], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $this->authorize('update', \App\Models\Reservation::class);
        $data = $request->validate(['status' => 'required|string']);
        $ok = $this->service->updateStatus((int) $id, $data['status']);
        return response()->json(['success' => $ok]);
    }

    // Admin listing
    public function adminIndex(Request $request)
    {
        $this->authorize('viewAny', \App\Models\Reservation::class);
        $data = $this->service->listAll();
        return response()->json(['data' => ReservationResource::collection($data)]);
    }

    // Admin status update
    public function adminUpdateStatus(Request $request, $id)
    {
        $this->authorize('update', \App\Models\Reservation::class);
        $data = $request->validate(['status' => 'required|string']);
        $ok = $this->service->updateStatus((int) $id, $data['status']);
        return response()->json(['success' => $ok]);
    }

    // Admin delete
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', \App\Models\Reservation::class);
        $ok = $this->service->deleteReservation((int) $id);
        return response()->json(['success' => $ok]);
    }
}
