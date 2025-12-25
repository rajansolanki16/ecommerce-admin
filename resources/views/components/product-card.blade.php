@foreach($products as $product)
<div class="ko-col-4">
    <div class="ko-roomitem-inner">

        <img src="{{ $product->product_image 
            ? asset('storage/'.$product->product_image) 
            : asset('assets/images/no-image.png') }}"
            class="thumbnail">

        <div class="ko-roompricing-info">
            <div class="ko-roompricing-infoinner">
                <div class="label">
                    {{ optional($product->categories)->pluck('name')->join(', ') ?: 'Uncategorized' }}
                </div>
                <h3 class="price">₹{{ $product->price }}</h3>
                <!-- <a class="wishlist-btn" data-product-id="{{ $product->id }}">🤍</a> -->
                <!-- <a class="wishlist-btn" data-product-id="{{ $product->id }}"><i class="bi bi-heart-fill" style="font-size:24px;color:white;"></i></a> -->
                <a class="wishlist-btn {{ $product->is_wishlisted ? 'added' : '' }}"
                    data-product-id="{{ $product->id }}">

                    <i class="bi {{ $product->is_wishlisted ? 'bi-heart-fill text-danger' : 'bi-heart-fill' }}"
                        style="font-size:24px;color:white;"></i>
                </a>

            </div>
        </div>

        <div class="ko-roomdetails-info">
            <div class="ko-roomdetails-infoinner">
                <h3 class="title">{{ $product->product_title }}</h3>
                <p>{{ $product->short_description }}</p>
                <h3 class="price">₹{{ $product->price }}</h3>
            </div>
        </div>

    </div>
</div>
@endforeach