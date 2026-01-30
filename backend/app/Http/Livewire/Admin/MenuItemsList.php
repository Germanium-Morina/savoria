<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\MenuItem;

class MenuItemsList extends Component
{
    public $items;

    public function mount()
    {
        $this->loadItems();
    }

    public function loadItems()
    {
        $this->items = MenuItem::with('category')->orderBy('display_order')->get();
    }

    public function delete($id)
    {
        $it = MenuItem::find($id);
        if ($it) {
            $it->delete();
            $this->loadItems();
            session()->flash('message', 'Menu item deleted');
        }
    }

    public function render()
    {
        return view('livewire.admin.menu-items-list');
    }
}
