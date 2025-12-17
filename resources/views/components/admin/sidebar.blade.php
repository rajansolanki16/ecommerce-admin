    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="{{ route('view.admin.dashboard') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img class="mt-3"  src="{{ publicPath(getSetting("site_logo_light")) }}" alt="" height="80">
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
                    <li class="menu-title"><span>Admin Panel</span></li>

                    <!-- DASHBOARD -->
                    <li class="nav-item">
                        <a href="{{ route('view.admin.dashboard') }}/" class="nav-link menu-link collapsed" >
                            <i class="ri-home-line"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <!-- BLOGS -->
                     <!-- <li class="nav-item">
                        @if(Route::is('blogs.*') || Route::is('blog_categories.*'))
                            <a href="#sidebarBlogs" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarBlogs">
                                <i class="ri-profile-line"></i><span>Blogs</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarBlogs">
                        @else
                            <a href="#sidebarBlogs" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBlogs">
                                <i class="ri-profile-line"></i><span>Blogs</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarBlogs">
                        @endif
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('blogs.create') }}" class="nav-link">Add Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blogs.index') }}" class="nav-link">All Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog_categories.index') }}" class="nav-link">Categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>  -->


                    <!-- PRODUCT -->
                    <li class="nav-item">
                            <a href="#sidebarproduct" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarproduct">
                                <i class="ri-profile-line"></i><span>Product</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarproduct">
                            <div class="collapse menu-dropdown" id="sidebarproduct">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('product.create') }}"  class="nav-link">Add Product</a>
                                </li>
                                <li class="nav-item">
                                    <a href=""  class="nav-link">All Product</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">Categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- END PRODUCT -->

                    <!-- Category -->
                    <li class="nav-item">
                            <a href="#sidebarproduct_category" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarproduct_category">
                                <i class="ri-profile-line"></i><span>Product_category</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarproduct_category">
                            <div class="collapse menu-dropdown" id="sidebarproduct_category">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('categories.create') }}"  class="nav-link">Create</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}"  class="nav-link">Show</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <!-- tags -->
                    <li class="nav-item">
                            <a href="#sidebarproduct_tags" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarproduct_tags">
                                <i class="ri-profile-line"></i><span>Product_tags</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarproduct_tags">
                            <div class="collapse menu-dropdown" id="sidebarproduct_tags">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('tags.create') }}"  class="nav-link">Create</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tags.index') }}"  class="nav-link">Show</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                   
                    <!-- ROOMS -->
                    {{-- <li class="nav-item">
                        @if(Route::is('rooms.*') || Route::is('amenities.*') || Route::is('services.*'))
                            <a href="#sidebarRooms" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarRooms">
                                <i class=" ri-home-8-line"></i><span>Rooms</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarRooms">
                        @else
                            <a href="#sidebarRooms" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRooms">
                                <i class=" ri-home-8-line"></i><span>Rooms</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarRooms">
                        @endif
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('rooms.create') }}" class="nav-link">Add Rooms</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('rooms.index') }}" class="nav-link">All Rooms</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('amenities.index') }}" class="nav-link">Amenities</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('services.index') }}" class="nav-link">Services</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

                    <!-- BOOKINGS -->
                    {{-- <li class="nav-item">
                        @if(Route::is('view.offline_booking') || Route::is('view.bookings') || Route::is('view.transactions') || Route::is('view.booking') || Route::is('view.edit_booking') )
                            <a href="#sidebarBookings" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarBookings">
                                <i class=" ri-calendar-check-fill"></i><span>Bookings</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarBookings">
                        @else
                            <a href="#sidebarBookings" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBookings">
                                <i class=" ri-calendar-check-fill"></i><span>Bookings</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarBookings">
                        @endif
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('view.offline_booking') }}" class="nav-link">Offline Booking</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view.bookings') }}" class="nav-link">Bookings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view.transactions') }}" class="nav-link">Transactions</a>
                                    </li>
                                </ul>
                            </div>
                    </li> --}}

                    <!-- Products -->
                    <!-- <li class="nav-item">
                        @if(Route::is('products.index') || Route::is('products.create') || Route::is('products.edit') || Route::is('products.show'))
                            <a href="#sidebarBookings" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarBookings">
                                <i class=" ri-calendar-check-fill"></i><span>Products</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarBookings">
                        @else
                            <a href="#sidebarBookings" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBookings">
                                <i class=" ri-calendar-check-fill"></i><span>Products</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarBookings">
                        @endif
                                <ul class="nav nav-sm flex-column">
                                     <li class="nav-item">
                                        <a href="{{ route('products.index') }}" class="nav-link">Show</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('products.create') }}" class="nav-link">Create</a>
                                    </li>

                                   
                                </ul>
                            </div>
                    </li> -->

                    <!-- SETTINGS -->
                    {{-- <li class="nav-item">
                        @if(Route::is('view.settings.*') || Route::is('faqs.*') )
                            <a href="#sidebarSettings" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarSettings">
                                <i class="ri-home-gear-line"></i><span>Settings</span>
                            </a>
                            <div class="menu-dropdown" id="sidebarSettings">
                        @else
                            <a href="#sidebarSettings" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSettings">
                                <i class="ri-home-gear-line"></i><span>Settings</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarSettings">
                        @endif
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('view.settings.about') }}/" class="nav-link">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view.settings.env') }}/" class="nav-link">ENV</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('faqs.index') }}/" class="nav-link">FAQs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view.settings.general') }}/" class="nav-link">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view.settings.home') }}/" class="nav-link">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view.settings.pages') }}/" class="nav-link">Pages</a>
                                    </li>
                                </ul>
                            </div>
                    </li> --}}

                    <!-- Users -->
                    <li class="nav-item">
                        <a href="{{ route('view.users') }}/" class="nav-link menu-link collapsed" >
                            <i class="ph-user-circle"></i><span>Users</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="sidebar-background"></div>
    </div>
    
    <div class="vertical-overlay"></div>
