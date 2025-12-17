<x-admin.header :title="'Product'" />
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div id="productList">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-xxl">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Search products, price etc...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl col-sm-6">
                                        <div>
                                            <div class="choices" data-type="select-multiple" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-choices="" data-choices-search-false="" data-choices-removeitem="" multiple="" data-choices-limit="Required Limit" data-choices-text-unique-true="" hidden="" tabindex="-1" data-choice="active"><option value="Boat" data-custom-properties="[object Object]">Boat</option><option value="Puma" data-custom-properties="[object Object]">Puma</option></select><div class="choices__list choices__list--multiple"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Boat" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Boat<button type="button" class="choices__button" aria-label="Remove item: 'Boat'" data-button="">Remove item</button></div><div class="choices__item choices__item--selectable" data-item="" data-id="2" data-value="Puma" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Puma<button type="button" class="choices__button" aria-label="Remove item: 'Puma'" data-button="">Remove item</button></div></div><input type="search" name="search_terms" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Select Brands" placeholder="Select Brands" style="min-width: 14ch; width: 1ch;"></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" aria-multiselectable="true" role="listbox"><div id="choices--azk9-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Adidas" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Adidas</div><div id="choices--azk9-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Realme" data-select-text="Press to select" data-choice-selectable="">Realme</div></div></div></div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl col-sm-6">
                                        <div>
                                            <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" id="idCategory" data-choices="" data-choices-search-false="" data-choices-removeitem="" hidden="" tabindex="-1" data-choice="active"><option value="all" data-custom-properties="[object Object]">Select Category</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="all" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Select Category<button type="button" class="choices__button" aria-label="Remove item: 'all'" data-button="">Remove item</button></div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--idCategory-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Appliances" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Appliances</div><div id="choices--idCategory-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Automotive Accessories" data-select-text="Press to select" data-choice-selectable="">Automotive Accessories</div><div id="choices--idCategory-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Electronics" data-select-text="Press to select" data-choice-selectable="">Electronics</div><div id="choices--idCategory-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Fashion" data-select-text="Press to select" data-choice-selectable="">Fashion</div><div id="choices--idCategory-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="Furniture" data-select-text="Press to select" data-choice-selectable="">Furniture</div><div id="choices--idCategory-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Grocery" data-select-text="Press to select" data-choice-selectable="">Grocery</div><div id="choices--idCategory-item-choice-7" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="7" data-value="Headphones" data-select-text="Press to select" data-choice-selectable="">Headphones</div><div id="choices--idCategory-item-choice-8" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="8" data-value="Kids" data-select-text="Press to select" data-choice-selectable="">Kids</div><div id="choices--idCategory-item-choice-9" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="9" data-value="Luggage" data-select-text="Press to select" data-choice-selectable="">Luggage</div><div id="choices--idCategory-item-choice-10" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="10" data-value="all" data-select-text="Press to select" data-choice-selectable="">Select Category</div><div id="choices--idCategory-item-choice-11" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="11" data-value="Sports" data-select-text="Press to select" data-choice-selectable="">Sports</div><div id="choices--idCategory-item-choice-12" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="12" data-value="Watches" data-select-text="Press to select" data-choice-selectable="">Watches</div></div></div></div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-2 col-sm-6">
                                        <div>
                                            <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" id="idDiscount" data-choices="" data-choices-search-false="" data-choices-removeitem="" hidden="" tabindex="-1" data-choice="active"><option value="all" data-custom-properties="[object Object]">Select All Discount</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="all" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Select All Discount<button type="button" class="choices__button" aria-label="Remove item: 'all'" data-button="">Remove item</button></div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--idDiscount-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="10" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">10% or more</div><div id="choices--idDiscount-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="20" data-select-text="Press to select" data-choice-selectable="">20% or more</div><div id="choices--idDiscount-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="30" data-select-text="Press to select" data-choice-selectable="">30% or more</div><div id="choices--idDiscount-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="40" data-select-text="Press to select" data-choice-selectable="">40% or more</div><div id="choices--idDiscount-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="50" data-select-text="Press to select" data-choice-selectable="">50% or more</div><div id="choices--idDiscount-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="0" data-select-text="Press to select" data-choice-selectable="">Less than 10%</div><div id="choices--idDiscount-item-choice-7" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="7" data-value="all" data-select-text="Press to select" data-choice-selectable="">Select All Discount</div></div></div></div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-auto col-sm-6">
                                        <button type="button" class="btn btn-secondary w-md" onclick="filterData();"><i class="bi bi-funnel align-baseline me-1"></i> Filters</button>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Products <span class="badge bg-dark-subtle text-dark ms-1">254</span></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-subtle-danger d-none" id="remove-actions" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="bi bi-plus-circle align-baseline me-1"></i> Add Product</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="table-active">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="option" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th class="sort cursor-pointer" data-sort="products">Products</th>
                                                <th class="sort cursor-pointer" data-sort="category">Category</th>
                                                <th class="sort cursor-pointer" data-sort="stock">Stock</th>
                                                <th class="sort cursor-pointer" data-sort="price">Price</th>
                                                <th class="sort cursor-pointer" data-sort="orders">Orders</th>
                                                <th class="sort cursor-pointer" data-sort="rating">Rating</th>
                                                <th class="sort cursor-pointer" data-sort="published">Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all"><tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child">
                                                        <label class="form-check-label"></label>
                                                    </div>
                                                </td>
                                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#TB01</a></td>
                                                <td class="products">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-xs bg-light rounded p-1 me-2">
                                                            <img src="assets/images/products/32/img-1.png" alt="" class="img-fluid d-block">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0"><a href="apps-ecommerce-product-details.html" class="text-reset products">Branded T-Shirts</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="discount d-none">Fashion</td>
                                                <td class="category">Fashion</td>
                                                <td class="stock">12</td>
                                                <td class="price">$215.00</td>
                                                <td class="orders">48</td>
                                                <td class="rating">
                                                    <span class="badge bg-warning-subtle text-warning"><i class="bi bi-star-fill align-baseline me-1"></i> 4.9</span>
                                                </td>
                                                <td class="published">12 Oct, 2022</td>
                                                <td>
                                                    <div class="dropdown position-static">
                                                        <button class="btn btn-subtle-secondary btn-sm btn-icon" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                    
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="apps-ecommerce-product-details.html"><i class="ph-eye align-middle me-1"></i> View</a></li>
                                                            <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal" href="#showModal"><i class="ph-pencil align-middle me-1"></i> Edit</a></li>
                                                            <li><a class="dropdown-item remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ph-trash align-middle me-1"></i> Remove</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr></tbody>
                                    </table>
                                </div><!--end table-responsive-->

                                <div class="noresult" style="display: none">
                                    <div class="text-center py-4">
                                        <div class="avatar-md mx-auto mb-4">
                                            <div class="avatar-title bg-light text-primary rounded-circle fs-4xl">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We've searched more than 150+ products We did not find any products for you search.</p>
                                    </div>
                                </div>
                                <!-- end noresult -->

                                <div class="row mt-3 align-items-center" id="pagination-element">
                                    <div class="col-sm">
                                        <div class="text-muted text-center text-sm-start">
                                            Showing <span class="fw-semibold">10</span> of <span class="fw-semibold">35</span> Results
                                        </div>
                                    </div>

                                    <div class="col-sm-auto mt-3 mt-sm-0">
                                        <div class="pagination-wrap hstack gap-2 justify-content-center">
                                            <a class="page-item pagination-prev disabled" href="#">
                                                <i class="mdi mdi-chevron-left align-middle"></i>
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"><li class="active"><a class="page" href="#" data-i="1" data-page="10">1</a></li></ul>
                                            <a class="page-item pagination-next" href="#">
                                                <i class="mdi mdi-chevron-right align-middle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end pagination-element -->
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
        <!-- container-fluid -->
    </div>

