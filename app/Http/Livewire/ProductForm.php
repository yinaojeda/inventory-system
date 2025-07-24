<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductForm extends Component
{
    use LivewireAlert;

    public $productId;
    public $name;
    public $description;
    public $price;
    public $quantity;
    public $category_id;

    public $categories;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:1',
        'quantity' => 'required|integer|min:1',
        'category_id' => 'required|exists:categories,id',
    ];

    protected $listeners = ['editProduct'];

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function save()
    {
        $this->validate();

        Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'category_id' => $this->category_id,
            ]
        );

        $this->alert('success', $this->productId ? 'Product updated!' : 'Product created!');
        $this->resetForm();

        $this->emit('productSaved'); 
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->quantity = $product->quantity;
        $this->category_id = $product->category_id;
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

    public function render()
    {
        return view('livewire.product-form');
    }
}
