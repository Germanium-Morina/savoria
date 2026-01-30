<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'reservation_date' => $this->reservation_date,
            'reservation_time' => $this->reservation_time,
            'number_of_guests' => (int) $this->number_of_guests,
            'special_requests' => $this->special_requests,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
