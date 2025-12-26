@foreach($products as $product)
<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
    <div class="product-card h-100">

        {{-- IMAGE --}}
        <div class="product-image">
            <a href="{{ route('product.user.show', $product->slug ?? '#') }}">
                <img
                    src="{{ $product->product_image
                            ? asset('storage/'.$product->product_image)
                            : asset('assets/images/no-image.png') }}"
                    alt="{{ $product->product_title }}">
            </a>

            {{-- WISHLIST --}}
            <button
                type="button"
                class="wishlist-btn {{ $product->is_wishlisted ? 'active' : '' }}"
                data-product-id="{{ $product->id }}">

                <i class="bi {{ $product->is_wishlisted ? 'bi-heart-fill' : 'bi-heart' }}"></i>
            </button>
        </div>

        <div class="product-body">
            <div class="product-category">
                {{ optional($product->categories)->pluck('name')->join(', ') ?: 'Uncategorized' }}
            </div>

            {{-- TITLE --}}
            <h6 class="product-title">
                <a href="{{ route('product.user.show', $product->slug ?? '#') }}">
                    {{ $product->product_title }}
                </a>
            </h6>

            {{-- DESCRIPTION --}}
            <p class="product-desc">
                {{ Str::limit($product->short_description, 70) }}
            </p>

            {{-- PRICE --}}
            <div class="product-price">
                ₹{{ number_format($product->price) }}
            </div>

            {{-- ACTIONS --}}
            <div class="product-actions">

                <a href="{{ route('product.user.show', $product->slug ?? '#') }}"
                   class="btn btn-outline-dark btn-sm w-100 mb-2">
                    View Details
                </a>

                <!-- Add to Cart Button -->

                <button type="button" class="btn btn-sm btn-success add-to-cart" data-id="{{ $product->id }}">
                    Add to Cart
                </button>


            </div>

        </div>
        <div class="text-danger  mt-1 cart-error"
            id="cart-error-{{ $product->id }}"
            style="font-size:13px; display:none;">
        </div>
    </div>
</div>
@endforeach
