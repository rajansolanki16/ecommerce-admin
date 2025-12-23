<x-header :meta="array('title'=> getSetting('page_rooms_meta_title'), 'description'=> getSetting('page_rooms_meta_description'))" />


<main>
    <!-- banner section -->
    <section class="ko-banner">
        <div class="ko-container">
            <div class="ko-banner-content">
                <h2>Products</h2>
                <!-- {!! getSetting('page_rooms_description') !!} -->
                <nav>
                    <ol class="ko-banner-list">
                        <li><a>Home</a></li>
                        <li><a>prodcts</a></li>
                    </ol>
                </nav>
            </div>
            <div class="ko-container text-end mb-3">
                <a href="{{ route('auth.logout') }}" class="btn btn-danger">
                    Logout
                </a>
            </div>
        </div>
    </section>

    <!-- Product List -->
    <section class="ko-roomlist-section">
        <div class="ko-container">
            <div class="ko-row"
                id="vec_product-grid"
                data-fetch-url="{{ route('user.product') }}">

                <div class="ko-col-12 text-center">
                    Loading products...
                </div>

            </div>
        </div>
    </section>
</main>

<!-- footer start -->

<x-footer />