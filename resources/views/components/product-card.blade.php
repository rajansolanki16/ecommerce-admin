@foreach($products as $product)
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="card h-100 border-0 shadow-sm product-card">

        <!-- Product Image -->
        <div class="position-relative">
            <img
                src="{{ $product->product_image
                        ? asset('storage/'.$product->product_image)
                        : asset('assets/images/no-image.png') }}"
                class="card-img-top"
                alt="{{ $product->product_title }}"
                style="height:220px;object-fit:cover;">

            <!-- Wishlist -->
            <a class="wishlist-btn position-absolute top-0 end-0 m-2
                {{ $product->is_wishlisted ? 'added' : '' }}"
                data-product-id="{{ $product->id }}">

                <i class="bi {{ $product->is_wishlisted ? 'bi-heart-fill text-danger' : 'bi-heart' }}"
                    style="font-size:20px;"></i>
            </a>
        </div>

        <!-- Product Body -->
        <div class="card-body">

            <!-- Category -->
            <span class="badge bg-light text-dark mb-2 d-inline-block">
                {{ optional($product->categories)->pluck('name')->join(', ') ?: 'Uncategorized' }}
            </span>

            <!-- Title -->
            <h6 class="fw-semibold mb-1">
                {{ $product->product_title }}
            </h6>

            <!-- Description -->
            <p class="text-muted small mb-2">
                {{ Str::limit($product->short_description, 60) }}
            </p>

            <!-- Price + CTA -->
            <div class="d-flex justify-content-between align-items-center">
                <strong class="text-dark">
                    ₹{{ number_format($product->price) }}
                </strong>

                <a href="#"
                    class="btn btn-sm btn-dark">
                    View
                </a>
            </div>

        </div>
    </div>
</div>
@endforeach


<div class="col-12">
    <div class="d-flex justify-content-center mt-4">
        {!! $products->links('pagination::bootstrap-5') !!}
    </div>
</div>