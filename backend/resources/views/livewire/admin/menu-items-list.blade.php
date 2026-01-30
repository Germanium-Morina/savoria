<div>
    @if (session()->has('message'))
        <div style="background:#e6ffed;padding:8px;margin-bottom:8px">{{ session('message') }}</div>
    @endif
    <h3>Menu Items</h3>
    <a href="{{ route('admin.menu.create') }}">Create Menu Item</a>
    <table style="width:100%;border-collapse:collapse;margin-top:8px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $it)
                <tr>
                    <td>{{ $it->id }}</td>
                    <td>{{ $it->name }}</td>
                    <td>{{ $it->category?->name }}</td>
                    <td>{{ $it->price }}</td>
                    <td>
                        <a href="{{ route('admin.menu.edit', $it->id) }}">Edit</a>
                        <button wire:click="delete({{ $it->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
