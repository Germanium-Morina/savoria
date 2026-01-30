<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Reservation;

class ReservationsList extends Component
{
    public $reservations;

    public function mount()
    {
        $this->load();
    }

    public function load()
    {
        $this->reservations = Reservation::orderByDesc('reservation_date')->orderByDesc('reservation_time')->get();
    }

    public function updateStatus($id, $status)
    {
        $r = Reservation::find($id);
        if ($r) {
            $r->status = $status;
            $r->save();
            $this->load();
            session()->flash('message', 'Status updated');
        }
    }

    public function delete($id)
    {
        $r = Reservation::find($id);
        if ($r) {
            $r->delete();
            $this->load();
            session()->flash('message', 'Reservation deleted');
        }
    }

    public function render()
    {
        return view('livewire.admin.reservations-list');
    }
}
