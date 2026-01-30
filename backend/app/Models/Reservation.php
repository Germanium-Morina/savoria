<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'reservation_date', 'reservation_time', 'number_of_guests', 'special_requests', 'status'
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
