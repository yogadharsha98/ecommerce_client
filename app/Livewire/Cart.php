<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Carts;

class Cart extends Component
{
    public $cartCount;

    protected $listeners = ['addToCart' => 'updateCartCount'];

    public function mount($cartCount)
    {
        $this->cartCount = $cartCount; // Initialize cart count from passed data
    }

    public function updateCartCount()
    {
        $this->cartCount = Carts::where('user_id', auth()->id())->count(); // Update cart count
        session(['cartCount' => $this->cartCount]); // Store updated cart count in session
    }

    public function render()
    {
        return view('livewire.livewire');
    }
}
