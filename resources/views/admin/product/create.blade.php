<x-admin.header :title="'Add Product'" />

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="flex-grow-1">
                    <h3 class="mb-4 card-title">Add Product</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<form class="store-product" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-4">
                            <h5 class="card-title mb-3">Product Information</h5>
                            <p class="text-muted">Product Information refers to any information held by an organisation about the products it produces, buys, sells or distributes.</p>
                        </div>
                        <div class="col-xxl-8">
                            <form action="#!">
                                <div class="mb-3">
                                    <label for="productTitle" class="form-label">Product Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="productTitle" name="product_title" placeholder="Enter product title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productCategories" class="form-label">Categories <span class="text-danger">*</span></label>
                                    <select class="form-control" data-choices name="productCategories" id="productCategories" name="category[]">
                                        <option value="">Select categories</option>
                                        <option value="Appliances">Appliances</option>
                                        <option value="Automotive Accessories">Automotive Accessories</option>
                                </div>
                                <div class="mb-3">
                                    <label for="productType" class="form-label">Product Type <span class="text-danger">*</span></label>
                                    <select class="form-control" data-choices name="productType" id="productType" name="type">
                                        <option value="">Select Type</option>
                                        <option value="Simple">Simple</option>
                                        <option value="Classified">Classified</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="shortDecs" class="form-label">Short Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="shortDecs" name="short_description" placeholder="Must enter minimum of a 100 characters" rows="3"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="productBrand" class="form-label">Brand <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="productBrand" name="brand" placeholder="Enter brand" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tags</label>
                                    <input class="form-control" name="tag[]" id="choices-text-unique-values" data-choices data-choices-text-unique-true data-choices-removeItem type="text" value="Fashion, Style, Brands, Puma">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" name="exchangeable" type="checkbox" role="switch" id="exchangeableInput">
                                            <label class="form-check-label" for="exchangeableInput">Exchangeable</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" name="refundable" type="checkbox" role="switch" id="refundableInput">
                                            <label class="form-check-label" for="refundableInput">Refundable</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-4">
                            <h5 class="card-title mb-3">Description</h5>
                            <p class="text-muted">Product Information refers to any information held by an organization about the products it produces, buys, sells or distributes.</p>
                        </div><!--end col-->
                        <div class="col-xxl-8">
                            <div>
                                <label class="form-label">Product Description <span class="text-danger">*</span></label>
                                <div class="ckeditor-classic"></div>
                                 <textarea class="form-control" id="productDescription" name="product_description" placeholder="Must enter minimum of a 100 characters" rows="3"></textarea>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-4">
                            <h5 class="card-title mb-3">Images</h5>
                            <p class="text-muted">Product Information refers to any information held by an organization about the products it produces, buys, sells or distributes.</p>
                        </div><!--end col-->
                        <div class="col-xxl-8">
                            <div class="mb-3">
                                <label class="form-label">Product Images <span class="text-danger">*</span></label>
                                <div class="dropzone text-center">
                                    <div class="fallback">
                                        <input name="file" name="product_image" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                        </div>

                                        <h4>Drop product images here or click to upload.</h4>
                                    </div>
                                </div>


                                <!-- end dropzon-preview -->
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gallery Images <span class="text-danger">*</span></label>
                                <div class="dropzone text-center" id="dropzone">
                                    <div class="fallback">
                                        <input name="file" name="gallery_images[]" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                        </div>

                                        <h4>Drop gallery images here or click to upload.</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end dropzon-preview -->
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>
    </div><!--end col-->
    </div><!--end row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-4">
                            <h5 class="card-title mb-3">General Info</h5>
                            <p class="text-muted mb-0">An informational product can be a digital book (or e-book), a digital report, a white paper, a piece of software, audio or video files, a website, an e-zine or a newsletter.</p>
                        </div><!--end col-->
                        <div class="col-xxl-8">
                            <div class="row gy-3">
                                <div class="col-lg-6">
                                    <div>
                                        <label for="manufacturer-name-input" class="form-label">Manufacturer Name</label>
                                        <input type="text" class="form-control" id="manufacturer-name-input" name="manufacturer_name" placeholder="Enter manufacturer name" required>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-6">
                                    <div>
                                        <label class="form-label" for="manufacturer-brand-input">Manufacturer Brand</label>
                                        <input type="text" class="form-control" id="manufacturer-brand-input" name="manufacturer_brand" placeholder="Enter manufacturer brand">
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="productStocks" class="form-label">Stocks <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="productStocks" name="stocks" placeholder="Stocks" required>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label class="form-label" for="product-price-input">Price</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="product-price-addon">$</span>
                                            <input type="text" class="form-control" id="product-price-input" name="price" placeholder="Enter price" aria-label="Price" aria-describedby="product-price-addon" required="">
                                            <div class="invalid-feedback">Please Enter a product price.</div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label class="form-label" for="product-discount-input">Discount</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="product-discount-addon">%</span>
                                            <input type="text" class="form-control" id="product-discount-input" name="discount" placeholder="Enter discount" aria-label="discount" aria-describedby="product-discount-addon">
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-6">
                                    <div>
                                        <label for="choices-publish-status-input" class="form-label">Status</label>
                                        <select class="form-select" id="choices-publish-status-input" name="status" data-choices data-choices-search-false>
                                            <option value="Published" selected>Published</option>
                                            <option value="Scheduled">Scheduled</option>
                                            <option value="Draft">Draft</option>
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-6">
                                    <div>
                                        <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                                        <select class="form-select" id="choices-publish-visibility-input" name="visibility" data-choices data-choices-search-false>
                                            <option value="Public" selected>Public</option>
                                            <option value="Hidden">Hidden</option>
                                        </select>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
    <div class="gap-2 mb-3 hstack justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Cancel</button>
    </div>

</form>




<x-admin.footer />