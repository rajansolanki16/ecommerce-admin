<x-header :meta="array(
    'title' => getSetting('page_rooms_meta_title'),
    'description' => getSetting('page_rooms_meta_description')
)" />

<main>
    <!-- Banner Section -->
    <section class="ko-banner">
        <div class="ko-container">
            <div class="ko-banner-content">
                <h2>Products</h2>
                <nav>
                    <ol class="ko-banner-list">
                        <li><a>Home</a></li>
                        <li><a>Products</a></li>
                    </ol>
                </nav>
            </div>

            <div class="ko-container text-end mb-3">
                <a href="{{ route('auth.logout') }}" class="btn btn-danger">Logout</a>
                <a href="{{ route('wishlist.index') }}" class="btn btn-danger">My Wishlist</a>
            </div>
        </div>
    </section>

    <!-- Product List -->
    <section class="ko-roomlist-section">
        <div class="ko-container">
            <div class="ko-row"
                 id="vec_product-grid"
                 data-fetch-url="{{ route('user.product') }}"
                 data-wishlist-url="{{ route('wishlist.toggle') }}">

                <!-- AJAX will replace this -->
                <div class="ko-col-12 text-center">
                   
                </div>

            </div>
        </div>
    </section>
</main>

<x-footer />
