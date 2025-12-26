<x-header :meta="array(
    'title' => getSetting('page_rooms_meta_title'),
    'description' => getSetting('page_rooms_meta_description')
)" />

<main class="bg-light">

    {{-- HERO --}}
    <section class="ko-banner py-5 border-bottom bg-white">
        <div class="ko-container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="fw-bold mb-1">Shop Products</h1>
                    <p class="text-muted mb-0">
                        Premium quality. Best prices. Fast delivery.
                    </p>

                    <nav aria-label="breadcrumb" class="mt-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('wishlist.index') }}" class="btn btn-outline-dark me-2">
                        ❤️ Wishlist
                    </a>

                    @auth
                        <a href="{{ route('auth.logout') }}" class="btn btn-outline-danger">
                            Logout
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- FILTER BAR --}}
    <section class="bg-white sticky-top border-bottom z-2">
        <div class="ko-container py-3">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <strong class="me-2">All Products</strong>
                    <span class="text-muted small">
                        ({{ $products->total() ?? '' }} items)
                    </span>
                </div>

                <div class="col-md-6 text-md-end">
                    <select class="form-select d-inline-block w-auto">
                        <option value="latest">Latest</option>
                        <option value="price_asc">Price: Low → High</option>
                        <option value="price_desc">Price: High → Low</option>
                        <option value="popular">Popularity</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    {{-- PRODUCT GRID --}}
    <section class="py-5">
        <div class="ko-container">
            <div class="row g-4"
                 id="vec_product-grid"
                 data-fetch-url="{{ route('user.product') }}"
                 data-wishlist-url="{{ route('wishlist.toggle') }}">

                @include('components.product-card')

            </div>

            {{-- PAGINATION --}}
           <div class="col-12">
                <div class="d-flex justify-content-center mt-4">
                    {!! $products->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </section>

    {{-- TRUST STRIP --}}
    <section class="bg-white py-5 border-top">
        <div class="ko-container">
            <div class="row text-center gy-4">
                <div class="col-md-4">
                    <div class="trust-item">
                        <span class="icon">🚚</span>
                        <h6 class="fw-semibold mt-2">Free Shipping</h6>
                        <p class="text-muted small mb-0">
                            On orders above ₹999
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="trust-item">
                        <span class="icon">🔒</span>
                        <h6 class="fw-semibold mt-2">Secure Payments</h6>
                        <p class="text-muted small mb-0">
                            100% protected checkout
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="trust-item">
                        <span class="icon">💬</span>
                        <h6 class="fw-semibold mt-2">24/7 Support</h6>
                        <p class="text-muted small mb-0">
                            Always here to help
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<x-footer />
