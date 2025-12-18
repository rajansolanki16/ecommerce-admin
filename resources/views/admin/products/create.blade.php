
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
<x-admin.header :title="'Product'" />
    <div class="container-fluid">
        <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                                    
                                        <div class="mb-3">
                                            <label for="productTitle" class="form-label">Product Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" id="productTitle"
                                                value="{{ old('title') }}" placeholder="Enter product title">  
                                                @error('title')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror                                              
                                        </div>
                                        <div class="mb-3">
                                        <label for="productCategories" class="form-label">
                                                Categories <span class="text-danger">*</span>
                                            </label>

                                            <select class="form-control"
                                                    name="categories[]"
                                                    id="productCategories"
                                                    multiple
                                                    data-choices
                                                    data-choices-search="true"
                                                    data-choices-remove-item>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productType" class="form-label">Product Type <span class="text-danger">*</span></label>
                                            <select class="form-control"
                                                data-choices
                                                data-choices-search="true"
                                                name="product_type"
                                                id="productType">
                                            <option value="">Select Type</option>
                                            @foreach ($productTypes as $type)
                                                <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                            @endforeach
                                            @error('product_type')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="shortDecs" class="form-label">Short Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="short_description" id="shortDecs" rows="3">
                                                {{ old('short_description') }}
                                            </textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="productBrand" class="form-label">Brand <span class="text-danger">*</span></label>
                                                    <input type="text" name="brand" class="form-control" id="productBrand">
                                                    @error('short_description')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="productUnit" class="form-label">Unit <span class="text-danger">*</span></label>
                                                    <select class="form-control" data-choices name="productUnit" id="productUnit">
                                                        <option value="">Select Unit</option>
                                                        <option value="Kilogram">Kilogram</option>
                                                        <option value="Pieces">Pieces</option>
                                                    </select>
                                                </div>
                                                @error('productUnit')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tags</label>
                                            <input class="form-control"
                                                name="tags"
                                                data-choices
                                                data-choices-text-unique-true
                                                data-choices-removeItem
                                                type="text"
                                                value="{{ old('tags') }}">
                                                @error('tags')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch mb-3">
                                                    <input type="checkbox" name="exchangeable" value="1" class="form-check-input">
                                                    <label class="form-check-label" for="exchangeableInput">Exchangeable</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch mb-3">
                                                    <input type="checkbox" name="refundable" value="1" class="form-check-input">
                                                    <label class="form-check-label" for="refundableInput">Refundable</label>
                                                </div>
                                            </div>
                                        </div>
                                    
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
                                        <div class="dropzone dropzone-main text-center">
                                            <div class="fallback">
                                                <input  type="file" name="product_image" multiple="multiple">
                                            </div>
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                </div>
                                        
                                                <h4>Drop product images here or click to upload.</h4>
                                            </div>
                                        </div>
                                        
                                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                                            <li class="mt-2" id="dropzone-preview-list">
                                                <!-- This is used as the file preview template -->
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">   
                                                                <img data-dz-thumbnail class="img-fluid rounded d-block" src="{{ asset('admin/images/new-document.png') }}" alt="Dropzone-Image">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                                                <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- end dropzon-preview -->
                                        @error('product_image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Gallery Images <span class="text-danger">*</span></label>
                                        <div class="dropzone text-center" id="dropzone">
                                            <div class="fallback">
                                                <input type="file" name="gallery_images[]"  multiple="multiple">
                                            </div>
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                </div>
                                    
                                                <h4>Drop gallery images here or click to upload.</h4>
                                            </div>
                                        </div>
                                    
                                        <ul class="list-unstyled mb-0" id="dropzone-preview2">
                                            <li class="mt-2" id="dropzone-preview-list2">
                                                <!-- This is used as the file preview template -->
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img data-dz-thumbnail class="img-fluid rounded d-block" src="{{ asset('admin/images/new-document.png') }}" alt="Dropzone-Image">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                                                <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        @error('gallery_images')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

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
                                                <input type="text" name="manufacturer_name" class="form-control">
                                                @error('manufacturer_name')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-6">
                                            <div>
                                                <label class="form-label" for="manufacturer-brand-input">Manufacturer Brand</label>
                                                <input type="text" name="manufacturer_brand" class="form-control">
                                                @error('manufacturer_brand')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="productStocks" class="form-label">Stocks <span class="text-danger">*</span></label>
                                                <input type="number" name="stock" class="form-control">
                                            </div>
                                            @error('stock')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div><!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label" for="product-price-input">Price</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="product-price-addon">$</span>
                                                    <input type="number" step="0.01" name="price" class="form-control">
                                                    <div class="invalid-feedback">Please Enter a product price.</div>
                                                </div>
                                            </div>
                                            @error('price')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div><!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label" for="product-discount-input">Discount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="product-discount-addon">%</span>
                                                    <input type="number" step="0.01" name="discount" class="form-control">
                                                </div>
                                            </div>
                                            @error('discount')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div><!--end col-->
                                        <div class="col-lg-6">
                                            <label for="productStatus" class="form-label">Status</label>
                                            <select class="form-control"
                                                    name="status"
                                                    id="productStatus"
                                                    data-choices
                                                    data-choices-search-false>
                                                <option value="">Select Status</option>

                                                @foreach ($productStatuses as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ old('status') === $status->value ? 'selected' : '' }}>
                                                        {{ $status->label() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="productVisibility" class="form-label">Visibility</label>
                                                <select class="form-control"
                                                        name="visibility"
                                                        id="productVisibility"
                                                        data-choices
                                                        data-choices-search-false>
                                                    <option value="">Select Visibility</option>

                                                    @foreach ($productVisibilities as $visibility)
                                                        <option value="{{ $visibility->value }}"
                                                            {{ old('visibility') === $visibility->value ? 'selected' : '' }}>
                                                            {{ $visibility->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('visibility')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="hstack gap-2 justify-content-end mb-3">
                <button class="btn btn-danger"><i class="ph-x align-middle"></i> Cancel</button>
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-choices]').forEach(function (el) {

            if (el.classList.contains('choices-initialized')) return;

            const searchEnabled = el.dataset.choicesSearch !== 'false';
            const removeItem = el.hasAttribute('data-choices-remove-item');
            const isMultiple = el.hasAttribute('multiple');

            new Choices(el, {
                searchEnabled: searchEnabled,
                removeItemButton: removeItem,
                shouldSort: false,
                placeholderValue: 'Select categories',
                itemSelectText: '',
            });

            el.classList.add('choices-initialized');
        });
    });
     
    Dropzone.autoDiscover = false;

    const mainDropzone = new Dropzone(".dropzone-main", {
        url: "#",
        autoProcessQueue: false,
        uploadMultiple: false,
        paramName: "product_image",
        maxFiles: 1,
        addRemoveLinks: true
    });

    const galleryDropzone = new Dropzone("#dropzone", {
        url: "#",
        autoProcessQueue: false,
        uploadMultiple: true,
        paramName: "gallery_images[]",
        addRemoveLinks: true
    });

    document.getElementById("productForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        if (mainDropzone.files.length) {
            formData.append("product_image", mainDropzone.files[0]);
        }

        galleryDropzone.files.forEach(file => {
            formData.append("gallery_images[]", file);
        });

        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        }).then(res => {
            if (res.redirected) window.location.href = res.url;
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/js/pages/ecommerce-create-product.init.js') }}"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>
    @stack('scripts')
<x-admin.footer />