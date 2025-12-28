<x-layouts.app :title="$product->name">

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">

                <div class="col-md-12">
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>

                    <div class="fs-5 mb-4">
                        <span>${{ $product->price }}</span>
                    </div>

                    
                    <form action="{{ route('cart_items.store') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        
                        <input type="hidden" name="quantity" value="1">

                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            Add to cart
                        </button>
                    </form>

                    
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-link px-0">
                            ← 回商品列表
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-layouts.app>