    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="{{ route('view.admin.dashboard') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img class="mt-3" src="{{ publicPath(getSetting("site_logo_light")) }}" alt="" height="80">
                </span>
            </a>
            <button type="button" class="p-0 btn btn-sm fs-3xl header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <!-- ITEMS -->
        <div id="scrollbar">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    <!-- MAIN -->
                    <li class="menu-title"><span data-key="t-main">Main</span></li>

                    <!-- DASHBOARD -->
                    <li class="nav-item">
                        <a href="{{ route('view.admin.dashboard') }}" class="nav-link menu-link">
                            <i class="ri-dashboard-line"></i><span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>

                    <!-- SALES & ORDERS -->
                    <li class="menu-title"><span data-key="t-sales">Sales & Orders</span></li>

                    <!-- Orders -->
                    <li class="nav-item">
                        <a href="{{ route('orders.show') }}" class="nav-link menu-link">
                            <i class="ri-shopping-cart-line"></i>
                            <span data-key="t-orders">Orders</span>
                            <span class="badge badge-pill bg-danger float-end">3</span>
                        </a>
                    </li>

                    <!-- CATALOG & PRODUCTS -->
                    <li class="menu-title"><span data-key="t-catalog">Catalog & Products</span></li>

                    <!-- Products -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                            <i class="ri-shopping-bag-line"></i>
                            <span data-key="t-products">Products</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarProducts">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('products.create') }}" class="nav-link">Add Product</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('products.index') }}" class="nav-link">All Products</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarTags" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTags">
                            <i class="ri-settings-3-line"></i>
                            <span data-key="t-tags">Tags</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarTags">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('tags.create') }}" class="nav-link">Add Tags</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tags.index') }}" class="nav-link">All Tags</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Brands -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarBrands" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBrands">
                            <i class="ri-bookmark-line"></i>
                            <span data-key="t-brands">Brands</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarBrands">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('brands.create') }}" class="nav-link">Add Brand</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('brands.index') }}" class="nav-link">All Brands</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Categories -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategories">
                            <i class="ri-folder-3-line"></i>
                            <span data-key="t-categories">Categories</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCategories">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('categories.create') }}" class="nav-link">Add Category</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link">All Categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Attributes -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAttributes" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAttributes">
                            <i class="ri-settings-3-line"></i>
                            <span data-key="t-attributes">Attributes</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAttributes">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('product_attributes.create') }}" class="nav-link">Add Attribute</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('product_attributes.index') }}" class="nav-link">All Attributes</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Coupons -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCoupons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCoupons">
                            <i class="ri-coupon-3-line"></i>
                            <span data-key="t-coupons">Coupons</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCoupons">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('coupons.create') }}" class="nav-link">Create Coupon</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('coupons.index') }}" class="nav-link">All Coupons</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- BLOG -->
                    <li class="menu-title"><span data-key="t-blog">Blog</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarBlog" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBlog">
                            <i class="ri-file-list-3-line"></i>
                            <span data-key="t-blog">Blog</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarBlog">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('blog.posts.create') }}" class="nav-link">Add Post</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog.posts.index') }}" class="nav-link">All Posts</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog.categories.create') }}" class="nav-link">Add Category</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog.categories.index') }}" class="nav-link">All Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog.authors.create') }}" class="nav-link">Add Author</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog.authors.index') }}" class="nav-link">All Authors</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- CUSTOMER & COMMUNITY -->
                    <li class="menu-title"><span data-key="t-customer">Customers & Community</span></li>

                    <!-- Users -->
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link menu-link">
                            <i class="ri-user-3-line"></i><span data-key="t-users">Users</span>
                        </a>
                    </li>

                    <!-- Wishlist -->
                    <li class="nav-item">
                        <a href="{{ route('wishlist.show') }}" class="nav-link menu-link">
                            <i class="ri-heart-line"></i><span data-key="t-wishlist">Wishlists</span>
                        </a>
                    </li>

                    <!-- Reviews -->
                    <li class="nav-item">
                        <a href="{{ route('wishlist.show') }}" class="nav-link menu-link">
                            <i class="ri-star-line"></i><span data-key="t-reviews">Reviews & Ratings</span>
                        </a>
                    </li>

                    <!-- PAYMENTS & CHECKOUT -->
                    <li class="menu-title"><span data-key="t-payments">Payments & Checkout</span></li>

                    <!-- Payment Options -->
                   {{--  ADD THIS --}}
                    <li class="nav-item">
                        <a href="{{ route('view.settings.payment') }}" class="nav-link menu-link">
                            <i class="ri-secure-payment-line"></i>
                            <span data-key="t-payment-gateways">Payment Gateways</span>
                        </a>
                    </li>

                    <!-- ADMINISTRATION -->
                    <li class="menu-title"><span data-key="t-administration">Administration</span></li>

                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSettings" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSettings">
                            <i class="ri-settings-2-line"></i>
                            <span data-key="t-settings">Settings</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSettings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('view.settings.general') }}" class="nav-link">General Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('view.settings.ecommerce') }}" class="nav-link">E-Commerce</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('view.settings.about') }}" class="nav-link">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('view.settings.home') }}" class="nav-link">Home Page</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('view.settings.pages') }}" class="nav-link">Pages</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('view.settings.env') }}" class="nav-link">Environment</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Support & Help -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSupport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSupport">
                            <i class="ri-question-line"></i>
                            <span data-key="t-support">Support & Help</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSupport">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('faqs.create') }}" class="nav-link">Add FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('faqs.index') }}" class="nav-link">All FAQs</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <div class="sidebar-background"></div>
    </div>

    <div class="vertical-overlay"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;

    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#')) return;

        // Convert full URL to just the path (handles both http://... and /admin/...)
        let linkPath;
        try {
            linkPath = new URL(href, window.location.origin).pathname;
        } catch(e) {
            linkPath = href;
        }

        // Exact match only — prevents /admin matching /admin/users etc.
        const isActive = currentPath === linkPath;

        if (!isActive) return;

        link.classList.add('active');
        link.closest('.nav-item')?.classList.add('active');

        // Open parent collapse if this link is inside one
        const parentCollapse = link.closest('.collapse.menu-dropdown');
        if (parentCollapse) {
            parentCollapse.classList.add('show');

            const toggleLink = document.querySelector(
                `[data-bs-toggle="collapse"][aria-controls="${parentCollapse.id}"]`
            );
            if (toggleLink) {
                toggleLink.classList.add('active');
                toggleLink.setAttribute('aria-expanded', 'true');
                toggleLink.closest('.nav-item')?.classList.add('active');
            }
        }
    });
});

</script>