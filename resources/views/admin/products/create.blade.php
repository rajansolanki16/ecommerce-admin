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
                                                    id="vec_productCategories"
                                                    multiple>
                                                @forelse ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @empty
                                                    <option disabled>No categories found</option>
                                                @endforelse
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
                                            <div class="mb-3">
                                                <label class="form-label">Tags</label>
                                                <select id="productTags" name="tags[]" class="form-control" multiple>
                                                    @foreach ($allTags as $tag)
                                                        <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id) || (isset($product) && $product->tags->contains($tag->id))) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="productStatus" class="form-label">Status</label>
                                                <select class="form-control"
                                                        name="status"
                                                        id="productStatus">
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
                                                    <select class="form-control" name="visibility" id="productVisibility">
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
            <div class="row" id="vec_shipping_section">
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
                                                <label class="form-label">Length</label>
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
                                                <label class="form-label">Width</label>
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
                                                <label class="form-label">Height</label>
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
                                        Select one or more attributes and create variants (combinations of chosen values).
                                    </p>
                                </div>

                                <div class="col-xxl-8">
                                    {{-- Attribute Type --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Variant Attributes</label>
                                        <select class="form-control" id="variantAttributesSelect" name="product_attributes[]" multiple>
                                            @forelse($attributes as $attribute)
                                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                            @empty
                                                <option disabled>No attributes found</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div id="attributeValuesContainers" class="mb-3"></div>

                                    <button type="button" class="btn btn-outline-primary mb-4" id="generateVariants">
                                        <i class="ph-plus"></i> Generate Variants
                                    </button>

                                    <div id="variantsList" class="mt-4">
                                        <!-- Variants will be rendered here -->
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
        window.attributesData = {!! $attributesJson !!};
        window.errors = {!! json_encode($errors->getMessages() ?? []) !!};

        $(document).ready(function(){
            const $attrSelect = $('#variantAttributesSelect');
            const $containers = $('#attributeValuesContainers');
            const $generateBtn = $('#generateVariants');
            const $variantsList = $('#variantsList');

            function createValuesMultiSelect(attribute) {
                const $wrapper = $('<div>').addClass('mb-3');
                const $label = $('<label>').addClass('form-label fw-semibold').text(attribute.name + ' values');
                $wrapper.append($label);

                const $select = $('<select>')
                    .addClass('form-control')
                    .attr('multiple', true)
                    .data('attributeId', attribute.id);

                attribute.values.forEach(v => {
                    $('<option>').val(v.id).text(v.value).appendTo($select);
                });

                $wrapper.append($select);

                if (window.Choices) {
                    setTimeout(() => {
                        try {
                            new Choices($select[0], {
                                searchEnabled: true,
                                removeItemButton: true,
                                shouldSort: false,
                                placeholderValue: 'Select values',
                                itemSelectText: ''
                            });
                        } catch (e) { }
                    }, 30);
                }
                return $wrapper;
            }

            function onAttributesChange() {
                $containers.empty();
                const selected = $attrSelect.val() || [];
                selected.forEach(id => {
                    const attribute = window.attributesData.find(a => String(a.id) === String(id));
                    if (attribute) {
                        $containers.append(createValuesMultiSelect(attribute));
                    }
                });
            }

            function cartesian(arrays) {
                return arrays.reduce((a, b) => a.flatMap(d => b.map(e => d.concat([e]))), [[]]);
            }

            function getFieldError(idx, fieldName) {
                const errorKey = `variants.${idx}.${fieldName}`;
                return window.errors[errorKey] ? window.errors[errorKey][0] : null;
            }

            function renderFieldGroup(label, fieldClass, fieldName, inputType = 'text', colClass = 'col-md-6') {
                let html = `<div class="${colClass} mb-3"><label class="form-label">${label}</label>`;
                if (inputType === 'textarea') {
                    html += `<textarea class="form-control ${fieldClass}" rows="3" data-field="${fieldName}"></textarea>`;
                } else {
                    const step = inputType === 'number' ? '0.01' : 'any';
                    const accept = inputType === 'file' ? 'accept="image/*"' : '';
                    html += `<input type="${inputType}" step="${step}" class="form-control ${fieldClass}" value="" data-field="${fieldName}" ${accept}>`;
                }
                html += '<div class="invalid-feedback d-block" style="display: none;"></div></div>';
                return html;
            }

            function renderTable() {
                $variantsList.empty();

                window.variantsStore.forEach((variant, idx) => {
                    const $card = $('<div>').addClass('card mb-3 border-start border-start-3 border-primary');

                    const $header = $('<div>')
                        .addClass('card-header bg-light d-flex justify-content-between align-items-center')
                        .css('cursor', 'pointer')
                        .html(`
                            <div>
                                <h6 class="mb-0"><strong>${variant.name}</strong></h6>
                                <small class="text-muted">SKU: ${variant.sku || '-'} | Price: $${variant.price || '-'} | Stock: ${variant.stock || 0}</small>
                            </div>
                            <div><i class="ph-caret-down" style="transition: transform 0.3s;"></i></div>
                        `);

                    const $body = $('<div>').addClass('card-body').hide();

                    // Basic Info
                    const basicHtml = `
                        <div class="mb-4 pb-4 border-bottom">
                            <h6 class="mb-3 fw-semibold">Basic Info</h6>
                            <div class="row">
                                ${renderFieldGroup('SKU', 'variant-sku', 'sku', 'text', 'col-md-6')}
                                ${renderFieldGroup('Price', 'variant-price', 'price', 'number', 'col-md-6')}
                            </div>
                            <div class="row">
                                ${renderFieldGroup('Stock', 'variant-stock', 'stock', 'number', 'col-md-6')}
                                ${renderFieldGroup('Sell Price', 'variant-sell-price', 'sell_price', 'number', 'col-md-6')}
                            </div>
                        </div>
                    `;

                    // Shipping Info
                    const shippingHtml = `
                        <div class="mb-4 pb-4 border-bottom">
                            <h6 class="mb-3 fw-semibold">Shipping Info</h6>
                            <div class="row">
                                ${renderFieldGroup('Shipping Cost', 'variant-shipping', 'shipping', 'text', 'col-md-6')}
                                ${renderFieldGroup('Shipping Address', 'variant-shipping-addr', 'shipping_address', 'text', 'col-md-6')}
                            </div>
                            <div class="row">
                                ${renderFieldGroup('Weight', 'variant-weight', 'weight', 'number', 'col-md-4')}
                                ${renderFieldGroup('Length', 'variant-length', 'length', 'number', 'col-md-4')}
                                ${renderFieldGroup('Width', 'variant-width', 'width', 'number', 'col-md-4')}
                            </div>
                            <div class="row">
                                ${renderFieldGroup('Height', 'variant-height', 'height', 'number', 'col-md-6')}
                            </div>
                        </div>
                    `;

                    // General Info
                    const generalHtml = `
                        <div class="mb-4 pb-4 border-bottom">
                            <h6 class="mb-3 fw-semibold">General Info</h6>
                            ${renderFieldGroup('', 'variant-general-info', 'general_info', 'textarea', 'col-12')}
                        </div>
                    `;

                    // Image
                    const imageHtml = `
                        <div class="mb-4 pb-4 border-bottom">
                            <h6 class="mb-3 fw-semibold">Image</h6>
                            ${renderFieldGroup('', 'variant-image', 'image', 'file', 'col-12')}
                        </div>
                    `;

                    // Flags
                    const flagsHtml = `
                        <div class="mb-3">
                            <h6 class="mb-3 fw-semibold">Options</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input variant-exchangeable" ${variant.exchangeable ? 'checked' : ''} data-idx="${idx}">
                                        <label class="form-check-label">Exchangeable</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input variant-refundable" ${variant.refundable ? 'checked' : ''} data-idx="${idx}">
                                        <label class="form-check-label">Refundable</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input variant-free-shipping" ${variant.free_shipping ? 'checked' : ''} data-idx="${idx}">
                                        <label class="form-check-label">Free Shipping</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $body.html(basicHtml + shippingHtml + generalHtml + imageHtml + flagsHtml);

                    const $footer = $('<div>')
                        .addClass('card-footer bg-light')
                        .html(`<button type="button" class="btn btn-sm btn-danger delete-variant-btn" data-idx="${idx}"><i class="ph-trash me-1"></i>Delete Variant</button>`);

                    $card.append($header, $body, $footer);
                    $variantsList.append($card);

                    // Populate field values and display errors
                    const fieldMap = {
                        'variant-sku': 'sku',
                        'variant-price': 'price',
                        'variant-stock': 'stock',
                        'variant-sell-price': 'sell_price',
                        'variant-shipping': 'shipping',
                        'variant-shipping-addr': 'shipping_address',
                        'variant-weight': 'weight',
                        'variant-length': 'length',
                        'variant-width': 'width',
                        'variant-height': 'height',
                        'variant-general-info': 'general_info'
                    };

                    Object.entries(fieldMap).forEach(([className, fieldName]) => {
                        const $input = $body.find(`.${className}`);
                        if ($input.length) {
                            $input.val(variant[fieldName] || '').data('idx', idx).on('change', updateVariant);

                            const error = getFieldError(idx, fieldName);
                            if (error) {
                                $input.addClass('is-invalid');
                                $input.closest('div').find('.invalid-feedback').text(error).show();
                            }
                        }
                    });

                    // File input
                    const $imageInput = $body.find('.variant-image');
                    if ($imageInput.length) {
                        $imageInput.data('idx', idx).on('change', updateVariant);
                        const imageError = getFieldError(idx, 'image');
                        if (imageError) {
                            $imageInput.addClass('is-invalid');
                            $imageInput.closest('div').find('.invalid-feedback').text(imageError).show();
                        }
                    }

                    // Toggle expand/collapse
                    $header.on('click', function() {
                        const isVisible = $body.is(':visible');
                        $body.toggle();
                        $(this).find('i').css('transform', isVisible ? 'rotate(0deg)' : 'rotate(180deg)');
                    });
                });

                // Attach event listeners
                $variantsList.on('change', '.variant-exchangeable, .variant-refundable, .variant-free-shipping', updateVariantCheckbox);
                $variantsList.on('click', '.delete-variant-btn', deleteVariant);
            }

            function updateVariant(e) {
                const idx = $(this).data('idx');
                const variant = window.variantsStore[idx];
                const $this = $(this);

                if ($this.hasClass('variant-sku')) variant.sku = $this.val();
                else if ($this.hasClass('variant-price')) variant.price = $this.val();
                else if ($this.hasClass('variant-stock')) variant.stock = $this.val();
                else if ($this.hasClass('variant-sell-price')) variant.sell_price = $this.val();
                else if ($this.hasClass('variant-shipping')) variant.shipping = $this.val();
                else if ($this.hasClass('variant-shipping-addr')) variant.shipping_address = $this.val();
                else if ($this.hasClass('variant-weight')) variant.weight = $this.val();
                else if ($this.hasClass('variant-length')) variant.length = $this.val();
                else if ($this.hasClass('variant-width')) variant.width = $this.val();
                else if ($this.hasClass('variant-height')) variant.height = $this.val();
                else if ($this.hasClass('variant-general-info')) variant.general_info = $this.val();
                else if ($this.hasClass('variant-image')) variant.image = $this[0].files[0] || null;

                // Clear error styling
                $this.removeClass('is-invalid').closest('div').find('.invalid-feedback').hide();
            }

            function updateVariantCheckbox(e) {
                const idx = $(this).data('idx');
                const variant = window.variantsStore[idx];
                const $this = $(this);

                if ($this.hasClass('variant-exchangeable')) variant.exchangeable = $this.is(':checked') ? 1 : 0;
                else if ($this.hasClass('variant-refundable')) variant.refundable = $this.is(':checked') ? 1 : 0;
                else if ($this.hasClass('variant-free-shipping')) variant.free_shipping = $this.is(':checked') ? 1 : 0;
            }

            function deleteVariant(e) {
                const idx = $(this).data('idx');
                if (confirm('Delete this variant?')) {
                    window.variantsStore.splice(idx, 1);
                    renderTable();
                }
            }

            function generateTable() {
                window.variantsStore = [];

                const $selects = $containers.find('select');
                if (!$selects.length) return alert('Select attributes and values first');

                const valueLists = $selects.toArray().map(s => {
                    return Array.from($(s).find('option:selected')).map(o => ({
                        id: o.value,
                        text: o.textContent
                    }));
                });

                if (valueLists.some(l => l.length === 0)) return alert('Choose at least one value for each selected attribute');

                const combos = cartesian(valueLists);

                combos.forEach((combo, idx) => {
                    window.variantsStore.push({
                        name: combo.map(c => c.text).join(' / '),
                        values: combo.map(c => c.id),
                        sku: '',
                        price: '',
                        stock: 0,
                        sell_price: '',
                        shipping: '',
                        shipping_address: '',
                        general_info: '',
                        weight: '',
                        length: '',
                        width: '',
                        height: '',
                        exchangeable: 0,
                        refundable: 0,
                        free_shipping: 0,
                        image: null
                    });
                });

                renderTable();
            }

            $attrSelect.on('change', onAttributesChange);
            $generateBtn.on('click', generateTable);

            // On form submit, inject hidden inputs for variants
            $('#productForm').on('submit', function(e) {
                const $variantsContainer = $('<div>').hide();

                window.variantsStore.forEach((variant, idx) => {
                    Object.keys(variant).forEach(key => {
                        if (key === 'name' || key === 'image') return;

                        if (key === 'values') {
                            variant.values.forEach(val => {
                                $('<input>')
                                    .attr({
                                        type: 'hidden',
                                        name: `variants[${idx}][values][]`,
                                        value: val
                                    })
                                    .appendTo($variantsContainer);
                            });
                        } else {
                            $('<input>')
                                .attr({
                                    type: 'hidden',
                                    name: `variants[${idx}][${key}]`,
                                    value: variant[key]
                                })
                                .appendTo($variantsContainer);
                        }
                    });
                });

                $(this).append($variantsContainer);
            });
        });
    </script>
    <script src="{{ asset('admin/js/pages/ecommerce-create-product.init.js') }}"></script>
<x-admin.footer />