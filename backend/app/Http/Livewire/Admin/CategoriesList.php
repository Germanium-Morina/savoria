<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class CategoriesList extends Component
{
    public $categories;

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::orderBy('display_order')->get();
    }

    public function delete($id)
    {
        $c = Category::find($id);
        if ($c) {
            $c->delete();
            $this->loadCategories();
            session()->flash('message', 'Category deleted');
        }
    }

    public function render()
    {
        return view('livewire.admin.categories-list');
    }
}
