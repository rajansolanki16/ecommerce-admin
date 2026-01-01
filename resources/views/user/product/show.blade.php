<x-header :meta="[
    'title' => $product->product_title,
    'description' => $product->short_description
]" />
<style>
.variant-btn.active {
    background: #212529;
    color: #fff;
    border-color: #212529;
}

.variant-btn:hover {
    border-color: #212529;
}
</style>

<section class="bg-light py-5">
    <div class="container">

        <div class="row g-5 align-items-start">

            {{-- PRODUCT GALLERY --}}
            <div class="col-lg-6">

                <div class="bg-white rounded-3 shadow-sm p-4">
                    <img id="mainImage"
                         src="{{ asset('storage/'.$product->product_image) }}"
                         class="img-fluid rounded-2 w-100"
                         style="aspect-ratio:1/1;object-fit:cover;">
                </div>

                @if(!empty($product->gallery_images))
                    <div class="d-flex gap-3 mt-3">
                        @foreach($product->gallery_images as $img)
                            <img src="{{ asset('storage/'.$img) }}"
                                 class="border rounded-2 p-1 bg-white"
                                 style="width:80px;height:80px;object-fit:cover;cursor:pointer"
                                 onclick="document.getElementById('mainImage').src=this.src">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- PRODUCT INFORMATION --}}
            <div class="col-lg-6">

                <div class="position-sticky" style="top:90px">

                    {{-- CATEGORY --}}
                    <div class="text-uppercase text-secondary small fw-semibold mb-2">
                        {{ $product->categories->pluck('name')->join(' • ') }}
                    </div>

                    {{-- TITLE --}}
                    <h1 class="fw-bold mb-3 lh-sm">
                        {{ $product->product_title }}
                    </h1>

                    {{-- PRICE --}}
                    <div class="d-flex align-items-center gap-3 mb-4">
                        @if($product->sell_price)
                            <span class="fs-3 fw-bold text-dark">
                                ₹{{ number_format($product->sell_price) }}
                            </span>
                            <span class="text-muted text-decoration-line-through">
                                ₹{{ number_format($product->price) }}
                            </span>
                            <span class="badge bg-light text-success border">
                                {{ round((($product->price - $product->sell_price) / $product->price) * 100) }}% OFF
                            </span>
                        @else
                            <span class="fs-3 fw-bold text-dark">
                                ₹{{ number_format($product->price) }}
                            </span>
                        @endif
                    </div>

                    {{-- SHORT DESCRIPTION --}}
                    <p class="text-muted fs-6 mb-4">
                        {{ $product->short_description }}
                    </p>

                    {{-- VARIANTS --}}
                    @if($product->product_type == \App\Enums\ProductType::VARIANTS->value)
                        <div class="mb-4">

                            @foreach($product->variants->groupBy(fn($v) => $v->attributeValues->first()->attribute->name ?? '') as $attr => $variants)

                                <div class="mb-3">
                                    <label class="fw-semibold d-block mb-2">{{ $attr }}</label>

                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($variants as $variant)
                                            <button type="button"
                                                    class="btn btn-outline-secondary variant-btn px-3 py-2"
                                                    data-price="{{ $variant->sell_price ?? $variant->price }}"
                                                    data-image="{{ $variant->image ? asset('storage/'.$variant->image) : '' }}">
                                                {{ $variant->attributeValues->pluck('value')->join(' / ') }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    @endif

                    {{-- ADD TO CART --}}
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                        @csrf

                        <div class="d-flex gap-3">
                            <input type="number"
                                   name="qty"
                                   value="1"
                                   min="1"
                                   class="form-control w-25">

                            <button class="btn btn-dark btn-lg flex-grow-1 add-to-cart" data-id="{{ $product->id }}">
                                Add to Cart
                            </button>
                        </div>
                    </form>

                    {{-- ASSURANCE --}}
                    <div class="border-top pt-3 text-muted small">
                        <div class="mb-1">• Secure & encrypted payments</div>
                        <div class="mb-1">• 7-day hassle-free returns</div>
                        <div>• Verified authentic products</div>
                    </div>

                </div>
            </div>
        </div>

        {{-- PRODUCT DETAILS --}}
        <div class="bg-white rounded-3 shadow-sm mt-5 p-5">
            <ul class="nav nav-tabs mb-4 border-bottom">
                <li class="nav-item">
                    <button class="nav-link active fw-semibold"
                            data-bs-toggle="tab"
                            data-bs-target="#desc">
                        Product Details
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-semibold"
                            data-bs-toggle="tab"
                            data-bs-target="#shipping">
                        Shipping & Returns
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="desc">
                    <div class="text-muted lh-lg">
                        {!! $product->product_decscription !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="shipping">
                    <p class="text-muted lh-lg">
                        Orders are dispatched within 24–48 business hours.<br>
                        Returns are accepted within 7 days of delivery in original condition.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
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
<x-footer />