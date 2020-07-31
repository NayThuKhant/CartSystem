<?php

namespace App\Http\Livewire;


use App\Events\AddedToCart;
use App\Events\UpdatedCart;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Products extends Component
{
    public $keyword='';


    public function mount(){

    }

    public function getProducts(){
        return Product::where('name', 'like', "%{$this->keyword}%")->get();
    }

    public function addToCart($product_id){

        $existing_products=Auth::user()->cart->products()->where('id',$product_id)->first();

        if($existing_products) {

            $pivot = $existing_products->pivot;
            $pivot->quantity +=1;
            $pivot->subtotal=$pivot->quantity*$existing_products->price;
            $pivot->save();
        }
        else{
            Auth::user()->cart->products()->attach($product_id,['quantity'=>1,'subtotal'=>Product::find($product_id)->price]);
        }
        event(new UpdatedCart());

    }



    public function render()
    {
        return view('livewire.products',[
            'products'=>$this->getProducts(),
        ]);
    }
}
