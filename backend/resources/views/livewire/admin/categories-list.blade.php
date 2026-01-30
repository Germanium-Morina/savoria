<div>
    @if (session()->has('message'))
        <div style="background:#e6ffed;padding:8px;margin-bottom:8px">{{ session('message') }}</div>
    @endif
    <h3>Categories</h3>
    <a href="{{ route('admin.categories.create') }}">Create Category</a>
    <table style="width:100%;border-collapse:collapse;margin-top:8px">
        <thead>
            <tr>
                <th style="text-align:left">ID</th>
                <th style="text-align:left">Name</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $c->id) }}">Edit</a>
                        <button wire:click="delete({{ $c->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
