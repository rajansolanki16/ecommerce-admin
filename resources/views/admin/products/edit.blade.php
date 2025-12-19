<x-admin.header :title="'Product'" />
    <div class="container-fluid">
        <form id="productForm" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                                           <input type="text" name="title" class="form-control" value="{{ old('title', $product->product_title) }}">  
                                                @error('title')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror                                              
                                        </div>
                                        <div class="mb-3">
                                            <label for="productType" class="form-label">Product Type <span class="text-danger">*</span></label>
                                            <select name="product_type" id="productType" class="form-control" data-choices>
                                                @foreach ($productTypes as $type)
                                                    <option value="{{ $type->value }}" 
                                                        {{ old('product_type', $product->product_type) == $type->value ? 'selected' : '' }}>
                                                        {{ $type->label() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productCategories" class="form-label">
                                                    Categories 
                                                </label>

                                                <select class="form-control" name="categories[]" multiple data-choices data-choices-search="true" data-choices-remove-item>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="row">
                                            <label for="shortDecs" class="form-label">Short Description 
                                            <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            {{-- <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="productBrand" class="form-label">Brand <span class="text-danger">*</span></label>
                                                    <input type="text" name="brand" class="form-control" id="productBrand" value="{{ old('brand', $product->brand) }}">
                                                    @error('short_description')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tags</label>
                                                       <select class="form-control"
                                                                name="tags[]"
                                                                id="productTags"
                                                                multiple
                                                                data-choices
                                                                data-choices-search="true"
                                                                data-choices-remove-item>
                                                            @foreach ($allTags as $tag)
                                                                <option value="{{ $tag->id }}"
                                                                    {{ isset($product) && $product->tags->contains($tag->id) ? 'selected' : '' }}>
                                                                    {{ $tag->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('tags')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">SKU Number</label>
                                                <input type="text"
                                                    name="sku_number"
                                                    class="form-control"
                                                    value="{{ old('sku_number', $product->sku_number) }}"
                                                    placeholder="SKU-ABC-001">
                                                @error('sku_number')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="productStatus" class="form-label">Status</label>
                                                <select name="status" class="form-control" data-choices>
                                                    @foreach ($productStatuses as $status)
                                                        <option value="{{ $status->value }}" 
                                                            {{ old('status', $product->status) == $status->value ? 'selected' : '' }}>
                                                            {{ $status->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="productVisibility" class="form-label">Visibility</label>
                                                <select name="visibility" class="form-control" data-choices>
                                                    @foreach ($productVisibilities as $visibility)
                                                        <option value="{{ $visibility->value }}" 
                                                            {{ old('visibility', $product->visibility) == $visibility->value ? 'selected' : '' }}>
                                                            {{ $visibility->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('visibility')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
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
                                        <textarea class="ckeditor-classic" name="product_decscription" id="productDescription" rows="5">
                                            {!! old('product_decscription', $product->product_decscription) !!}
                                        </textarea>
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
                                    <div class="mb-4">
                                        <label class="form-label">Product Image <span class="text-danger">*</span></label>

                                        <div class="border rounded p-3 text-center">
                                           <img id="productImagePreview"
                                                src="{{ old('product_image', $product->product_image ? asset('storage/' . $product->product_image) : asset('admin/images/new-document.png')) }}"
                                                class="img-thumbnail mb-3" style="max-height: 180px">

                                            <input type="file"
                                                name="product_image"
                                                class="form-control"
                                                accept="image/*"
                                                onchange="previewSingleImage(event)">
                                        </div>

                                        @error('product_image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            Gallery Images
                                        </label>

                                        <input type="file"
                                            name="gallery_images[]"
                                            class="form-control"
                                            multiple
                                            accept="image/*"
                                            onchange="previewMultipleImages(event)">

                                        <div class="row mt-3" id="galleryPreview">
                                            @foreach ($product->gallery_images ?? [] as $image)
                                                <div class="col-md-3 mb-3">
                                                    <div class="card shadow-sm">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="card-img-top"
                                                            style="height:150px; object-fit:cover">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @error('gallery_images')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row" id="vec_general_Info_Section">
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
                                        <div class="col-lg-4">
                                            <label class="form-label">
                                                Stock <span class="text-danger">*</span>
                                            </label>

                                            <select name="stock"
                                                    class="form-control"
                                                    data-choices
                                                    data-choices-search-false>
                                                <option value="">Select Stock</option>
                                                <option value="1" {{ old('stock', $product->stock) == 1 ? 'selected' : '' }}>
                                                    In Stock
                                                </option>
                                                <option value="0" {{ old('stock', $product->stock) == 0 ? 'selected' : '' }}>
                                                    Out of Stock
                                                </option>
                                            </select>

                                            @error('stock')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label" for="product-price-input">Price</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="product-price-addon">$</span>
                                                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
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
                                                    <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount', $product->discount) }}">
                                                </div>
                                            </div>
                                            @error('discount')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div><!--end col-->
                                          <!-- Sell Price -->
                                        <div class="col-lg-4">
                                            <label class="form-label">Sell Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number"
                                                    step="0.01"
                                                    name="sell_price"
                                                    class="form-control"
                                                    value="{{ old('sell_price', $product->sell_price) }}">
                                            </div>
                                            @error('sell_price')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Sell Price Start Date</label>
                                            <input type="date"
                                                name="sell_price_start_date"
                                                class="form-control"
                                                value="{{ old('sell_price_start_date', optional($product->sell_price_start_date)->format('Y-m-d')) }}">
                                            @error('sell_price_start_date')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Sell Price End Date</label>
                                            <input type="date"
                                                name="sell_price_end_date"
                                                class="form-control"
                                                value="{{ old('sell_price_end_date', optional($product->sell_price_end_date)->format('Y-m-d')) }}">
                                            @error('sell_price_end_date')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row gy-2" >
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch mb-3">
                                                    <input type="checkbox" name="exchangeable" value="1" class="form-check-input" {{ old('exchangeable', $product->exchangeable) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="exchangeableInput">Exchangeable</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch mb-3">
                                                   <input type="checkbox" name="refundable" value="1" class="form-check-input"  {{ old('refundable', $product->refundable) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="refundableInput">Refundable</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row" class="vec_shipping_section">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xxl-4">
                                    <h5 class="card-title mb-3">Shipping</h5>
                                    <p class="text-muted">
                                        Define product shipping details like weight, dimensions and free shipping option.
                                    </p>
                                </div><!--end col-->

                                <div class="col-xxl-8">
                                    <div class="row gy-3">

                                        <!-- Weight -->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Weight (kg)</label>
                                                <input type="number" step="0.01" name="weight" value="{{ old('weight', $product->weight) }}" class="form-control">
                                                @error('weight')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Length -->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Length (cm)</label>
                                                <input type="number" step="0.01" name="length" value="{{ old('length', $product->length) }}" class="form-control">
                                                @error('length')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Width -->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Width (cm)</label>
                                                <input type="number" step="0.01" name="width" value="{{ old('width', $product->width) }}" class="form-control">
                                                @error('width')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Height -->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Height (cm)</label>
                                                <input type="number" step="0.01" name="height" value="{{ old('height', $product->height) }}" class="form-control">
                                                @error('height')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Free Shipping -->
                                        <div class="col-lg-8 d-flex align-items-center">
                                            <div class="form-check form-switch mt-4">
                                                <input class="form-check-input" type="checkbox" name="free_shipping" value="1"
                                                   {{ old('free_shipping', $product->free_shipping) ? 'checked' : '0' }}>
                                                <label class="form-check-label">
                                                    Free Shipping
                                                </label>
                                            </div>
                                        </div>

                                    </div><!--end row-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="hstack gap-2 justify-content-end mb-3">
               <a href="{{ route('products.index') }}" class="btn btn-danger">
                    <i class="ph-x align-middle"></i> Cancel
                </a>
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

    <script src="{{ asset('admin/js/pages/ecommerce-create-product.init.js') }}"></script>
    @stack('scripts')
<x-admin.footer />