<?php

namespace App\Http\Livewire;

use App\Events\UpdatedCart;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{

    public $total;

    protected $listeners = ['echo:cart,UpdatedCart' => '$refresh'];

    public function mount()
    {
        $this->total = $this->getTotal();
    }


    public function getTotal()
    {
        $products = Auth::user()->cart->products;
        $total = 0;
        foreach ($products as $product) {
            $total = $total + $product->pivot->subtotal;
        }
        return $total;
    }

    public function decreaseQuantity($product_id)
    {
        $pivot = Auth::user()->cart->products->where('id', $product_id)->first()->pivot;

        if ($pivot->quantity > 1) {
            $pivot->quantity = $pivot->quantity - 1;
            $pivot->subtotal = $pivot->quantity * Product::find($product_id)->price;
            $pivot->save();
        } else if($pivot->quantity == 1) {
            $this->removeQuantity($product_id);

            event(new UpdatedCart());
        }
    }

    public function removeQuantity($product_id)
    {
        Auth::user()->cart->products()->detach($product_id);

    }

    public function increaseQuantity($product_id)
    {
        $pivot = Auth::user()->cart->products->where('id', $product_id)->first()->pivot;

        $pivot->quantity = $pivot->quantity + 1;
        $pivot->subtotal = $pivot->quantity * Product::find($product_id)->price;
        $pivot->save();
    }

    public function clearCart()
    {
        Auth::user()->cart->products()->delete();
    }

    public function render()
    {

        $this->total=$this->getTotal();
        $products = Auth::user()->cart->products;
        return view('livewire.cart', [
            'products' => Auth::user()->cart->products,
        ]);
    }

}
