<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductsList extends Component
{
    use LivewireAlert;

    public $products;

    protected $listeners = [
        'productSaved' => 'refreshProducts',
        'confirmDelete' => 'refreshProducts',
        'productDeleted' => 'refreshProducts',
        'deleteProduct',
    ];

    public $productId;

    public function mount()
    {
        $this->refreshProducts();
    }

    public function refreshProducts()
    {
        $this->products = Product::with('category')->orderBy('name')->get();
    }
    public function resetForm()
    {
        $this->productId = null;
        $this->name = '';
        $this->description = '';
        $this->price = null;
        $this->quantity = null;
        $this->category_id = null;
        $this->resetValidation();
    }

    public function confirmDelete($id)
    {
        $this->productId = $id;
        $this->alert('warning', 'Are you sure?', [
            'text' => 'This action cannot be undone.',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'onConfirmed' => 'deleteProduct',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancel',
            'timer' => null,
        ]);
    }

    public function deleteProduct()
    {
        Product::findOrFail($this->productId)->delete();
        $this->alert('success', 'Product deleted!');
        $this->resetForm();
        $this->emit('productDeleted');
    }

    public function editProduct($id)
    {
        $this->emit('editProduct', $id);
    }

    public function render()
    {
        return view('livewire.products-list');
    }
}
