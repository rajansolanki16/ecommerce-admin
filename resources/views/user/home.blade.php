<x-header :meta="array(
    'title' => getSetting('page_rooms_meta_title'),
    'description' => getSetting('page_rooms_meta_description')
)" />

<main class="bg-light">

    <!-- HERO / BANNER -->
    <section class="ko-banner py-5">
        <div class="ko-container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="fw-bold mb-2">Shop Our Products</h1>
                    <p class="text-muted mb-0">
                        Discover quality products at the best prices
                    </p>

                    <nav class="mt-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('wishlist.index') }}" class="btn btn-outline-dark me-2">
                        ❤️ Wishlist
                    </a>
                    <a href="{{ route('auth.logout') }}" class="btn btn-outline-danger">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- FILTER + SORT BAR -->
    <section class="py-3 border-bottom bg-white">
        <div class="ko-container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <strong>All Products</strong>
                </div>

                <div class="col-md-6 text-md-end">
                    <select class="form-select d-inline-block w-auto">
                        <option>Sort by latest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Popularity</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCT GRID -->
    <section class="ko-roomlist-section py-5">
        <div class="ko-container">
            <div class="row g-4"
                id="vec_product-grid"
          
                data-wishlist-url="{{ route('wishlist.toggle') }}">
              @include('components.product-card')
            </div>
        </div>
    </section>


    <!-- FEATURES STRIP -->
    <section class="bg-white py-5 border-top">
        <div class="ko-container">
            <div class="row text-center">
                <div class="col-md-4">
                    <h5 class="fw-semibold">🚚 Free Shipping</h5>
                    <p class="text-muted small">On all orders above ₹999</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-semibold">🔒 Secure Payment</h5>
                    <p class="text-muted small">100% safe checkout</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-semibold">💬 24/7 Support</h5>
                    <p class="text-muted small">We’re here to help</p>
                </div>
            </div>
        </div>
    </section>

</main>

<x-footer />