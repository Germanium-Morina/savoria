<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $categoryId;
    public $name;
    public $description;
    public $display_order = 0;
    public $is_active = true;

    public function mount($id = null)
    {
        if ($id) {
            $c = Category::find($id);
            if ($c) {
                $this->categoryId = $c->id;
                $this->name = $c->name;
                $this->description = $c->description;
                $this->display_order = $c->display_order;
                $this->is_active = $c->is_active;
            }
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'display_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($this->categoryId) {
            $c = Category::find($this->categoryId);
            $c->update($data);
            session()->flash('message', 'Category updated');
            return redirect()->route('admin.categories.list');
        }

        Category::create($data);
        session()->flash('message', 'Category created');
        return redirect()->route('admin.categories.list');
    }

    public function render()
    {
        return view('livewire.admin.category-form');
    }
}
