<div>
    @if (session()->has('message'))
        <div style="background:#e6ffed;padding:8px;margin-bottom:8px">{{ session('message') }}</div>
    @endif
    <h3>{{ $itemId ? 'Edit' : 'Create' }} Menu Item</h3>
    <form wire:submit.prevent="save">
        <div>
            <label>Category</label>
            <select wire:model.defer="category_id">
                <option value="">-- none --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Name</label>
            <input type="text" wire:model.defer="name" />
        </div>
        <div>
            <label>Description</label>
            <textarea wire:model.defer="description"></textarea>
        </div>
        <div>
            <label>Price</label>
            <input type="number" step="0.01" wire:model.defer="price" />
        </div>
        <div>
            <label>Image URL</label>
            <input type="text" wire:model.defer="image_url" />
        </div>
        <div>
            <label>Available</label>
            <input type="checkbox" wire:model.defer="is_available" />
        </div>
        <div>
            <label>Featured</label>
            <input type="checkbox" wire:model.defer="is_featured" />
        </div>
        <div style="margin-top:8px">
            <button type="submit">Save</button>
        </div>
    </form>
</div>
