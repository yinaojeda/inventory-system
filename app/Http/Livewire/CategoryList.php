<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryList extends Component
{
    public $categories;

    protected $listeners = ['categorySaved' => 'refreshCategories'];

    public function mount()
    {
        $this->refreshCategories();
    }

    public function refreshCategories()
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        $this->refreshCategories();
    }

    public function editCategory($id)
    {
        $this->emit('editCategory', $id); // Tell CategoryForm to load this category
    }

    public function render()
    {
        return view('livewire.category-list');
    }
}
