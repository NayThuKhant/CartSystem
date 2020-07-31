<div class="container-fluid">

    <input type="text" id="search_input" class="form-control" placeholder="Search..." wire:model="keyword">

    <div class="row">

        @foreach($products as $product)

           <div class="col-md-4 my-3">
                <div class="card ">
                    <img class="card-img-top" src="https://picsum.photos/280/150?item={{$product->id}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p>{{$product->price}} kyats</p>




                            <form wire:submit.prevent="addToCart({{$product->id}})">
                                <button type="submit" class="btn btn-success btn-sm float-right" style="border-radius: 50%">
                                    <i class="fa fa-2x fa-plus"></i>
                                </button>
                            </form>

                    </div>

            </div>
           </div>

        @endforeach

    </div>
</div>
