<x-header :meta="[
    'title' => $product->product_title,
    'description' => $product->short_description
]" />

<div class="bg-light py-5">
    <div class="container">

        <div class="row g-5">

            {{-- LEFT : GALLERY --}}
            <div class="col-lg-6">

                <div class="bg-white rounded shadow-sm p-3">
                    <img id="mainImage"
                         src="{{ asset('storage/'.$product->product_image) }}"
                         class="img-fluid rounded w-100"
                         style="aspect-ratio:1/1;object-fit:cover;">
                </div>

                @if(!empty($product->gallery_images))
                <div class="d-flex gap-2 mt-3">
                    @foreach($product->gallery_images as $img)
                        <img src="{{ asset('storage/'.$img) }}"
                             class="border rounded p-1 bg-white"
                             style="width:70px;height:70px;object-fit:cover;cursor:pointer"
                             onclick="document.getElementById('mainImage').src=this.src">
                    @endforeach
                </div>
                @endif
            </div>

            {{-- RIGHT : PRODUCT INFO --}}
            <div class="col-lg-6">

                <div class="position-sticky" style="top:90px">

                    {{-- CATEGORY --}}
                    <div class="text-uppercase text-muted small mb-2">
                        {{ $product->categories->pluck('name')->join(' • ') }}
                    </div>

                    {{-- TITLE --}}
                    <h1 class="fw-bold mb-3">
                        {{ $product->product_title }}
                    </h1>

                    {{-- PRICE --}}
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if($product->sell_price)
                            <span class="fs-3 fw-bold text-dark">
                                ₹{{ number_format($product->sell_price) }}
                            </span>
                            <span class="text-muted text-decoration-line-through">
                                ₹{{ number_format($product->price) }}
                            </span>
                            <span class="badge bg-success">
                                {{ round((($product->price - $product->sell_price) / $product->price) * 100) }}% OFF
                            </span>
                        @else
                            <span class="fs-3 fw-bold text-dark">
                                ₹{{ number_format($product->price) }}
                            </span>
                        @endif
                    </div>

                    {{-- SHORT DESC --}}
                    <p class="text-muted mb-4">
                        {{ $product->short_description }}
                    </p>

                    {{-- VARIANTS --}}
                    @if($product->product_type == \App\Enums\ProductType::VARIANTS->value)
                        <div class="mb-4">

                            @foreach($product->variants->groupBy(fn($v) => $v->attributeValues->first()->attribute->name ?? '') as $attr => $variants)

                                <label class="fw-semibold d-block mb-2">{{ $attr }}</label>

                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($variants as $variant)
                                        <button type="button"
                                                class="btn btn-outline-dark variant-btn"
                                                data-price="{{ $variant->sell_price ?? $variant->price }}"
                                                data-image="{{ $variant->image ? asset('storage/'.$variant->image) : '' }}">
                                            {{ $variant->attributeValues->pluck('value')->join(' / ') }}
                                        </button>
                                    @endforeach
                                </div>

                            @endforeach

                        </div>
                    @endif

                    {{-- ADD TO CART --}}
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                        @csrf

                        <div class="d-flex gap-3 align-items-center">
                            <input type="number"
                                   name="qty"
                                   value="1"
                                   min="1"
                                   class="form-control w-25">

                            <button class="btn btn-dark btn-lg px-5">
                                🛒 Add to Cart
                            </button>
                        </div>
                    </form>

                    {{-- TRUST BADGES --}}
                    <div class="border-top pt-3 small text-muted">
                        <div>✔ Secure Payments</div>
                        <div>✔ Easy Returns</div>
                        <div>✔ 100% Authentic Products</div>
                    </div>

                </div>
            </div>
        </div>

        {{-- TABS --}}
        <div class="bg-white rounded shadow-sm mt-5 p-4">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">
                        Description
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping">
                        Shipping & Returns
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="desc">
                    <div class="text-muted">
                        {!! nl2br(e($product->product_decscription)) !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="shipping">
                    <p class="text-muted">
                        Orders are shipped within 24–48 hours.  
                        Returns accepted within 7 days of delivery.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- VARIANT JS --}}
<script>
document.querySelectorAll('.variant-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        document.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const price = this.dataset.price;
        const image = this.dataset.image;

        if (price) {
            document.querySelector('.fs-3').innerText = '₹' + price;
        }

        if (image) {
            document.getElementById('mainImage').src = image;
        }
    });
});
</script>
