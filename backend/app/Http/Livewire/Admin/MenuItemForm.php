<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\MenuItem;
use App\Models\Category;

class MenuItemForm extends Component
{
    public $itemId;
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $image_url;
    public $is_available = true;
    public $is_featured = false;
    public $display_order = 0;

    public $categories = [];

    public function mount($id = null)
    {
        $this->categories = Category::where('is_active', true)->orderBy('display_order')->get();
        if ($id) {
            $it = MenuItem::find($id);
            if ($it) {
                $this->itemId = $it->id;
                $this->category_id = $it->category_id;
                $this->name = $it->name;
                $this->description = $it->description;
                $this->price = $it->price;
                $this->image_url = $it->image_url;
                $this->is_available = $it->is_available;
                $this->is_featured = $it->is_featured;
                $this->display_order = $it->display_order;
            }
        }
    }

    public function save()
    {
        $data = $this->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer',
        ]);

        if ($this->itemId) {
            $it = MenuItem::find($this->itemId);
            $it->update($data);
            session()->flash('message', 'Menu item updated');
            return redirect()->route('admin.menu.list');
        }

        MenuItem::create($data);
        session()->flash('message', 'Menu item created');
        return redirect()->route('admin.menu.list');
    }

    public function render()
    {
        return view('livewire.admin.menu-item-form');
    }
}
