<x-header :meta="array('title'=> getSetting('page_rooms_meta_title'), 'description'=> getSetting('page_rooms_meta_description'))" />

<main class="">
    <section class="ko-banner">
        <div class="ko-container">
            <div class="ko-banner-content">
                <h2><i class="bi bi-heart-fill" style="font-size:60px;color:red;"></i></a></h2>
                <!-- {!! getSetting('page_rooms_description') !!} -->
                <nav>
                    <ol class="ko-banner-list">
                        <li><a href="{{ route('user.home') }}">Home</a></li>
                        <li><a>wishlist</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section>
        <h2 class="mb-6">My Wishlist</h2>
        @if(!$wishlists->isEmpty())
        <div class="text-end mb-3">
            <a href="{{ route('cart.index') }}" class="btn btn-secondary">
                🛒 Cart ({{ count(session('cart', [])) }})
            </a>
        </div>
        @endif

        @if($wishlists->isEmpty())
        <p>No products in your wishlist.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th width="60"></th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $item)
                <tr>
                    <!-- DELETE ICON -->
                    <td class="text-center align-middle">
                        <i class="bi bi-trash vec_wishlist_remove"
                            data-id="{{ $item->id }}"
                            style="font-size:20px;color:#d1d1d1;cursor:pointer;"></i>
                    </td>

                    <!-- Product Image + Name  -->
                    <td>
                        <div class="position-relative d-inline-block">
                            <img
                                src="{{ $item->product->product_image 
                                ? asset('storage/'.$item->product->product_image) 
                            : asset('assets/images/no-image.png') }}"
                                alt="{{ $item->product->product_title }}"
                                width="80"
                                class="rounded">
                        </div>
                        <span class="fw-semibold">
                            {{ $item->product->product_title }}
                        </span>
                    </td>
                    <!-- <td>{{ $item->product->product_title }}</td> -->
                    <td>₹{{ $item->product->price }}</td>
                    <td>
                        @if($item->product->stock > 0)
                        <span class="text-success">In Stock</span>
                        @else
                        <span class="text-danger">Out of Stock</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <button class="btn btn-sm btn-primary">
                                Add to Cart
                            </button>
                        </form>

                        {{-- OUT OF STOCK MESSAGE (only for this product) --}}
                        @if(session('error') && session('error_product_id') == $item->product->id)
                        <div class="text-danger mt-1" style="font-size:13px;">
                            {{ session('error') }}
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </section>
</main>

<x-footer />