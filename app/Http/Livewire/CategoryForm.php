<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $categoryId;
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected $listeners = ['editCategory'];

    public function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            ['name' => $this->name]
        );

        $this->emit('categorySaved'); // To notify the list to refresh
        $this->resetForm();
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
