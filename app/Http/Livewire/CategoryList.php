<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class CategoryList extends Component
{
    use LivewireAlert;
    public $categories;
    public $categoryId;


    protected $listeners = [
        'categorySaved' => 'refreshCategories',
        'categoryDeleted' => 'refreshCategories',
        'triggerDelete' => 'confirmDelete',
        'editCategory',
        'deleteCategory' => 'deleteCategory',
    ];

    public function mount()
    {
        $this->refreshCategories();
    }

    public function testAlert()
    {
        $this->alert('success', 'This works!');
    }


    public function refreshCategories()
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function confirmDelete($id)
    {
        $this->categoryId = $id;
        $this->alert('warning', 'Are you sure?', [
            'text' => 'This action cannot be undone.',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'onConfirmed' => 'deleteCategory',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancel',
            'timer' => null,
        ]);
    }

    public function deleteCategory()
    {
        Category::findOrFail($this->categoryId)->delete();

        $this->alert('success', 'Category deleted!');
        $this->resetForm();
        $this->emit('categoryDeleted'); 
    }


    public function editCategory($id)
    {
        $this->emit('editCategory', $id); 
    }

    public function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.category-list');
    }
}
