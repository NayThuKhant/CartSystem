<div class="container-fluid">
    <div class="row">

        @forelse($products as $product)
            <div class="col-12 mb-2 pb-2 border-bottom">
                <div class="row">
                    <div class="col-4">
                        <img class="card-img-top" src="https://picsum.photos/280/180?item={{$product->id}}"
                             alt="Card image cap">
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-6 overflow-hidden">
                                <p class="text-nowrap">{{$product->name}}</p>
                            </div>

                            <div class="col-6">
                                MMK {{$product->price}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 overflow-hidden">
                                <p class="text-nowrap font-weight-bold font-italic">{{$product->pivot->subtotal}}</p>
                            </div>

                            <div class="col-8">

                                <button class="btn btn-danger btn-sm" wire:click="removeQuantity({{$product->id}})"><i
                                        class="fa fa-trash"></i></button>

                                <button class="btn btn-sm btn-success" wire:click="decreaseQuantity({{$product->id}})">
                                    <i class="fa fa-minus"></i>
                                </button>
                                {{$product->pivot->quantity}}
                                <button class="btn btn-sm btn-success" wire:click="increaseQuantity({{$product->id}})">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-12 mb-2 pb-2 border-bottom">
                <div class="row">
                    There's nothing in cart
                </div>
            </div>

        @endforelse



        @if(!$products->isEmpty())

            <div class="form-control border-0 text-right font-weight-bolder font-italic">
                <input type="text" wire:model="total" class="text-right border-0"> Kyat
            </div>

            <div class="form-control border-0 btn-group">
                <button class="form-control btn btn-danger mx-1" wire:click="clearCart">Clear Cart</button>
                <button class="form-control btn btn-success mx-1">Order Now</button>
            </div>
        @endif

    </div>
</div>

