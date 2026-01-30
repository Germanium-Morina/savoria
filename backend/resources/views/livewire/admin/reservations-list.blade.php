<div>
    @if (session()->has('message'))
        <div style="background:#e6ffed;padding:8px;margin-bottom:8px">{{ session('message') }}</div>
    @endif
    <h3>Reservations</h3>
    <table style="width:100%;border-collapse:collapse;margin-top:8px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->email }}</td>
                    <td>{{ $r->reservation_date->format('Y-m-d') }}</td>
                    <td>{{ $r->reservation_time }}</td>
                    <td>{{ $r->number_of_guests }}</td>
                    <td>{{ $r->status }}</td>
                    <td>
                        <button wire:click="updateStatus({{ $r->id }}, 'confirmed')">Confirm</button>
                        <button wire:click="updateStatus({{ $r->id }}, 'cancelled')">Cancel</button>
                        <button wire:click="delete({{ $r->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
