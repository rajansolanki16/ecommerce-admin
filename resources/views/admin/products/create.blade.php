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
                                            <label for="productType" class="form-label">Product Type <span class="text-danger">*</span></label>
                                            <select class="form-control"
                                                
                                                
                                                name="product_type"
                                                id="productType">
                                                <option value="">Select Type</option>
                                                @foreach ($productTypes as $type)
                                                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_type')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror    
                                        </div>

                                        <div class="mb-3">
                                        <label for="productCategories" class="form-label">
                                                Categories 
                                            </label>

                                            <select class="form-control"
                                                    name="categories[]"
                                                    id="productCategories"
                                                    multiple
                                                    
                                                    
                                                    >
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                       
                                        <div class="mb-3">
                                            <label for="shortDecs" class="form-label">Short Description </label>
                                            <textarea class="form-control" name="short_description" id="shortDecs" rows="3">
                                                {{ old('short_description') }}
                                            </textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <!-- SKU -->
                                            <div class="col-lg-6">
                                                <div>
                                                    <label class="form-label">SKU Number</label>
                                                    <input type="text"
                                                        name="sku_number"
                                                        value="{{ old('sku_number') }}"
                                                        class="form-control"
                                                        placeholder="SKU-ABC-001">
                                                    @error('sku_number')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="productTags" class="form-label">Tags</label>
                                                <select class="form-control"
                                                        name="tags[]"
                                                        id="productTags"
                                                        multiple
                                                        
                                                        
                                                        >
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
                                        </div><br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="productStatus" class="form-label">Status</label>
                                                <select class="form-control"
                                                        name="status"
                                                        id="productStatus"
                                                        
                                                        -search-false>
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
                                                            
                                                            -search-false>
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
                                        <textarea class="ckeditor-classic" name="product_decscription" id="productDescription" rows="5">{{ old('product_decscription') }}</textarea>
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
                                                src="{{ asset('admin/images/new-document.png') }}"
                                                class="img-thumbnail mb-3"
                                                style="max-height: 180px">

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
                                        <label class="form-label">Gallery Images </label>

                                        <input type="file"
                                            name="gallery_images[]"
                                            class="form-control"
                                            multiple
                                            accept="image/*"
                                            onchange="previewMultipleImages(event)">

                                        <div class="row mt-3" id="galleryPreview"></div>

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

            <div class="row"  id="vec_general_Info_Section" style="display: none">
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
                                            <div>
                                                <label class="form-label">Stock Status <span class="text-danger">*</span></label>
                                                <select name="stock_status"
                                                        class="form-control"
                                                        
                                                        -search-false>
                                                    <option value="">Select Status</option>
                                                    <option value="instock" {{ old('stock_status') === 'instock' ? 'selected' : '' }}>
                                                        In Stock
                                                    </option>
                                                    <option value="outstock" {{ old('stock_status') === 'outstock' ? 'selected' : '' }}>
                                                        Out of Stock
                                                    </option>
                                                </select>

                                                @error('stock_status')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

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
                                        
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Sell Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number"
                                                        step="0.01"
                                                        name="sell_price"
                                                        value="{{ old('sell_price') }}"
                                                        class="form-control"
                                                        placeholder="Special price">
                                                </div>
                                                @error('sell_price')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Sell Price Start Date</label>
                                                <input type="date"
                                                    name="sell_price_start_date"
                                                    value="{{ old('sell_price_start_date') }}"
                                                    class="form-control">
                                                @error('sell_price_start_date')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Sell Price End Date</label>
                                                <input type="date"
                                                    name="sell_price_end_date"
                                                    value="{{ old('sell_price_end_date') }}"
                                                    class="form-control">
                                                @error('sell_price_end_date')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Info Note -->
                                        <div class="col-lg-12">
                                            <div class="alert alert-info mb-0">
                                                <i class="ph-info me-1"></i>
                                                Sell price will override the regular price during the selected date range.
                                            </div>
                                        </div>    
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
                                        
                                    </div><!--end row-->
                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <!-- Shipping Info -->
            <div class="row">
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
                                                <input type="number"
                                                    step="0.01"
                                                    name="weight"
                                                    value="{{ old('weight') }}"
                                                    class="form-control"
                                                    placeholder="e.g. 1.5">
                                                @error('weight')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Length -->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Length (cm)</label>
                                                <input type="number"
                                                    step="0.01"
                                                    name="length"
                                                    value="{{ old('length') }}"
                                                    class="form-control"
                                                    placeholder="e.g. 30">
                                                @error('length')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Width -->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Width (cm)</label>
                                                <input type="number"
                                                    step="0.01"
                                                    name="width"
                                                    value="{{ old('width') }}"
                                                    class="form-control"
                                                    placeholder="e.g. 20">
                                                @error('width')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Height -->
                                        <div class="col-lg-4">
                                            <div>
                                                <label class="form-label">Height (cm)</label>
                                                <input type="number"
                                                    step="0.01"
                                                    name="height"
                                                    value="{{ old('height') }}"
                                                    class="form-control"
                                                    placeholder="e.g. 10">
                                                @error('height')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Free Shipping -->
                                        <div class="col-lg-8 d-flex align-items-center">
                                            <div class="form-check form-switch mt-4">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    name="free_shipping"
                                                    value="1"
                                                    {{ old('free_shipping') ? 'checked' : '' }}>
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

            
            {{-- Variant Section --}}
            <div class="row" id="variantSection" style="display:none;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xxl-4">
                                    <h5 class="card-title mb-3">Product Variants</h5>
                                    <p class="text-muted">
                                        Select one attribute and create multiple variants.
                                    </p>
                                </div>

                                <div class="col-xxl-8">
                                    {{-- Attribute Type --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Variant Attribute</label>
                                        <select class="form-control"
                                                id="variantAttributeSelect">
                                            <option value="">Select Attribute</option>
                                            @foreach($attributes as $attribute)
                                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3" id="attributeValuesWrapper" style="display:none;">
                                        <label class="form-label fw-semibold">Attribute Values</label>
                                        <select class="form-control"
                                                id="variantAttributeValues"
                                                multiple
                                                
                                                >
                                        </select>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary mb-4" id="generateVariants">
                                        <i class="ph-plus"></i> Generate Variants
                                    </button>

                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Variant</th>
                                                    <th>SKU</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>Sell Price</th>
                                                    <th>Shipping</th>
                                                    <th>Image</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="variantTableBody"></tbody>
                                        </table>
                                    </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Variant Section --}}

            <div class="hstack gap-2 justify-content-end mb-3">
               <a href="{{ route('products.index') }}" class="btn btn-danger">
                    <i class="ph-x align-middle"></i> Cancel
                </a>
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
    <script>
$(document).ready(function () {

    const attributes = @json($attributes);
    let valueChoices = null;

    /* ===============================
       ATTRIBUTE → VALUES LOAD
    =============================== */
    $('#variantAttributeSelect').on('change', function () {

        const attributeId = $(this).val();
        const $valuesSelect = $('#variantAttributeValues');

        $valuesSelect.empty();
        $('#attributeValuesWrapper').hide();

        if (!attributeId) return;

        const attribute = attributes.find(a => a.id == attributeId);

        if (!attribute || !Array.isArray(attribute.values)) {
            console.warn('No values found');
            return;
        }

        console.log('ATTRIBUTES FROM PHP:', @json($attributes));

        // Destroy previous Choices
        if (valueChoices) {
            valueChoices.destroy();
            valueChoices = null;
        }

        $.each(attribute.values, function (_, val) {
            $valuesSelect.append(
                `<option value="${val.id}">${val.value}</option>`
            );
        });

        $('#attributeValuesWrapper').show();

        // Init Choices AFTER options added
        valueChoices = new Choices('#variantAttributeValues', {
            removeItemButton: true,
            searchEnabled: true,
        });
    });

    /* ===============================
       GENERATE VARIANTS
    =============================== */
    $('#generateVariants').on('click', function () {

        const selected = $('#variantAttributeValues option:selected');

        if (!selected.length) {
            alert('Select at least one attribute value');
            return;
        }

        const $tbody = $('#variantTableBody');
        $tbody.empty();

        selected.each(function (index) {

            const valueId = $(this).val();
            const valueText = $(this).text();

            $tbody.append(`
                <tr>
                    <td><strong>${valueText}</strong></td>

                    <td>
                        <input type="text"
                               name="variants[${index}][sku]"
                               class="form-control">
                    </td>

                    <td>
                        <input type="number" step="0.01"
                               name="variants[${index}][price]"
                               class="form-control">
                    </td>

                    <td>
                        <input type="number"
                               name="variants[${index}][stock]"
                               class="form-control">
                    </td>

                    <td>
                        <input type="number" step="0.01"
                               name="variants[${index}][sell_price]"
                               class="form-control mb-1">

                        <input type="date"
                               name="variants[${index}][sell_price_start_date]"
                               class="form-control mb-1">

                        <input type="date"
                               name="variants[${index}][sell_price_end_date]"
                               class="form-control">
                    </td>

                    <td>
                        <input type="number" step="0.01"
                               name="variants[${index}][weight]"
                               class="form-control mb-1"
                               placeholder="Weight">

                        <div class="d-flex gap-1">
                            <input type="number" step="0.01"
                                   name="variants[${index}][length]"
                                   class="form-control" placeholder="L">

                            <input type="number" step="0.01"
                                   name="variants[${index}][width]"
                                   class="form-control" placeholder="W">

                            <input type="number" step="0.01"
                                   name="variants[${index}][height]"
                                   class="form-control" placeholder="H">
                        </div>

                        <div class="form-check mt-1">
                            <input type="checkbox"
                                   name="variants[${index}][free_shipping]"
                                   value="1"
                                   class="form-check-input">
                            <label class="form-check-label">Free Shipping</label>
                        </div>
                    </td>

                    <td>
                        <input type="file"
                               name="variants[${index}][image]"
                               class="form-control">
                    </td>

                    <td>
                        <button type="button"
                                class="btn btn-sm btn-danger remove-variant">
                            ✕
                        </button>
                    </td>

                    <input type="hidden"
                           name="variants[${index}][attribute_value_id]"
                           value="${valueId}">
                </tr>
            `);
        });
    });

    /* ===============================
       REMOVE VARIANT
    =============================== */
    $(document).on('click', '.remove-variant', function () {
        $(this).closest('tr').remove();
    });

});

$(document).ready(function () {

    const attributes = @json($attributes);
    let valueChoices;

    // INIT ONCE — EMPTY SELECT
    valueChoices = new Choices('#variantAttributeValues', {
        removeItemButton: true,
        searchEnabled: true,
        shouldSort: false
    });

    $('#variantAttributeSelect').on('change', function () {

        const attributeId = $(this).val();
        const attribute = attributes.find(a => a.id == attributeId);

        console.log('Selected Attribute:', attribute);

        valueChoices.clearStore();
        valueChoices.clearChoices();

        if (!attribute || !attribute.values.length) {
            $('#attributeValuesWrapper').hide();
            return;
        }

        const choicesData = attribute.values.map(v => ({
            value: v.id,
            label: v.value
        }));

        valueChoices.setChoices(choicesData, 'value', 'label', true);

        $('#attributeValuesWrapper').show();
    });

});

    </script>
    <script src="{{ asset('admin/js/pages/ecommerce-create-product.init.js') }}"></script>
<x-admin.footer />