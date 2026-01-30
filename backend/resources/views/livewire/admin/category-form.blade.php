<div>
    @if (session()->has('message'))
        <div style="background:#e6ffed;padding:8px;margin-bottom:8px">{{ session('message') }}</div>
    @endif
    <h3>{{ $categoryId ? 'Edit' : 'Create' }} Category</h3>
    <form wire:submit.prevent="save">
        <div>
            <label>Name</label>
            <input type="text" wire:model.defer="name" />
        </div>
        <div>
            <label>Description</label>
            <textarea wire:model.defer="description"></textarea>
        </div>
        <div>
            <label>Display order</label>
            <input type="number" wire:model.defer="display_order" />
        </div>
        <div>
            <label>Active</label>
            <input type="checkbox" wire:model.defer="is_active" />
        </div>
        <div style="margin-top:8px">
            <button type="submit">Save</button>
        </div>
    </form>
</div>
