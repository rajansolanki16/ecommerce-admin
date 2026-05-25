<x-admin.header :title="'Edit Product'" />
<div class="container-fluid">
    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data"
          id="productForm">
        @csrf
        @method('PUT')

        {{-- Sticky Header --}}
        <div class="card mb-4 shadow-sm border-0 sticky-top z-3">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 fw-bold">Edit Product</h4>
                        <p class="text-muted mb-0">
                            Update product details, pricing and variants.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('products.index') }}"
                           class="btn btn-light border">
                            Cancel
                        </a>
                        <button type="submit"
                                class="btn btn-primary px-4">
                            <i class="ph-floppy-disk me-1"></i>
                            Update Product
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-8">

                {{-- BASIC INFO --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-semibold mb-1">
                            Basic Information
                        </h5>
                        <p class="text-muted mb-0">
                            Update product title, description and organization.
                        </p>
                    </div>

                    <div class="card-body">

                        {{-- PRODUCT TITLE --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Product Name</label>
                            <input type="text"
                                   name="title"
                                   class="form-control form-control-mid"
                                   placeholder="Enter product name"
                                   value="{{ old('title', $product->product_title) }}">

                            @error('title')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- SHORT DESCRIPTION --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Short Description
                            </label>
                            <textarea name="short_description"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Short product summary">{{ old('short_description', $product->short_description) }}</textarea>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div>
                            <label class="form-label fw-semibold">Product Description</label>
                            <textarea id="productDescription" name="product_decscription"
                                      class="ckeditor-classic"
                                      rows="8">{{ old('product_decscription', $product->product_decscription) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- VARIANTS SECTION --}}
                <div id="variantSection"
                     class="{{ $product->product_type == \App\Enums\ProductType::VARIANTS->value ? '' : 'd-none' }}">
                    @include('admin.products.partials.edit-variants-table') 
                </div>
            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="col-lg-4">

                {{-- PRODUCT TYPE --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-semibold mb-1">
                            Product Type
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="product-type-selector d-grid gap-3">
                            {{-- SIMPLE --}}
                            <label class="border rounded-3 p-3 cursor-pointer product-type-card">
                                <div class="d-flex">
                                    <input type="radio"
                                           name="product_type"
                                           value="{{ \App\Enums\ProductType::SIMPLE->value }}"
                                           class="me-3 productTypeRadio"
                                           {{ old('product_type', $product->product_type) == \App\Enums\ProductType::SIMPLE->value ? 'checked' : '' }}>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">
                                            Simple Product
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            Single inventory and pricing.
                                        </p>
                                    </div>
                                </div>
                            </label>

                            {{-- VARIANT --}}
                            <label class="border rounded-3 p-3 cursor-pointer product-type-card">
                                <div class="d-flex">
                                    <input type="radio"
                                           name="product_type"
                                           value="{{ \App\Enums\ProductType::VARIANTS->value }}"
                                           class="me-3 productTypeRadio"
                                           {{ old('product_type', $product->product_type) == \App\Enums\ProductType::VARIANTS->value ? 'checked' : '' }}>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">
                                            Variant Product
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            Multiple combinations and pricing.
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- ORGANIZATION --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-semibold mb-1">
                            Organization
                        </h5>
                    </div>

                    <div class="card-body">

                        {{-- CATEGORIES --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Categories
                            </label>

                            <select class="form-control"
                                    multiple
                                    name="categories[]"
                                    id="productCategories">

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TAGS --}}
                        <div>

                            <label class="form-label fw-semibold">
                                Tags
                            </label>
                            <select class="form-control"
                                    multiple
                                    name="tags[]"
                                    id="productTags">

                                @foreach($allTags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- MEDIA --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-semibold mb-1">
                            Product Media
                        </h5>
                    </div>
                    <div class="card-body">

                        {{-- FEATURED IMAGE --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Featured Image
                            </label>

                            <div class="border rounded-3 p-3 text-center">

                                <img id="productImagePreview"
                                     src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('admin/images/new-document.png') }}"
                                     class="img-fluid rounded mb-3"
                                     style="max-height:220px">

                                <input type="file"
                                       name="product_image"
                                       class="form-control"
                                       accept="image/*">
                            </div>
                        </div>

                        {{-- GALLERY --}}
                        <div>
                            <label class="form-label fw-semibold">
                                Gallery Images
                            </label>

                            <input type="file"
                                   multiple
                                   name="gallery_images[]"
                                   class="form-control"
                                   accept="image/*">

                            @if(!empty($product->gallery_images))
                                <div class="row mt-3">
                                    @foreach($product->gallery_images as $image)
                                        <div class="col-4 mb-3">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                 class="img-fluid rounded border shadow-sm">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- SIMPLE PRODUCT --}}
                <div id="simpleProductSection"
                     class="card border-0 shadow-sm mb-4 {{ $product->product_type == \App\Enums\ProductType::SIMPLE->value ? '' : 'd-none' }}">

                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-semibold mb-1">
                            Pricing & Inventory
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                SKU
                            </label>
                            <input type="text"
                                   name="sku_number"
                                   class="form-control"
                                   value="{{ old('sku_number', $product->sku_number) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Price
                            </label>
                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   class="form-control"
                                   value="{{ old('price', $product->price) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Sale Price
                            </label>
                            <input type="number"
                                   step="0.01"
                                   name="sell_price"
                                   class="form-control"
                                   value="{{ old('sell_price', $product->sell_price) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold"> Stock</label>
                            <input type="number"
                                   name="stock"
                                   class="form-control"
                                   value="{{ old('stock', $product->stock) }}">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox"
                                           name="exchangeable"
                                           value="1"
                                           class="form-check-input"
                                           {{ old('exchangeable', $product->exchangeable) ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Exchangeable
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox"
                                           name="refundable"
                                           value="1"
                                           class="form-check-input"
                                           {{ old('refundable', $product->refundable) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Refundable
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@php
    $variantData = $product->variants->map(function ($variant) {
        return [
            'id' => $variant->id,
            'name' => $variant->attributeValues
                ->pluck('value')
                ->implode(' / '),
            'values' => $variant->attributeValues
                ->pluck('id')
                ->toArray(),
            'sku' => $variant->sku,
            'price' => $variant->price,
            'stock' => $variant->stock,
            'sell_price' => $variant->sell_price,
            'shipping' => $variant->shipping,
            'shipping_address' => $variant->shipping_address,
            'general_info' => $variant->general_info,
            'weight' => $variant->weight,
            'length' => $variant->length,
            'width' => $variant->width,
            'height' => $variant->height,
            'image' => $variant->image,
            'status' => $variant->status,
            'visibility' => $variant->visibility,
            'exchangeable' => $variant->exchangeable,
            'refundable' => $variant->refundable,
            'free_shipping' => $variant->free_shipping,
        ];
    })->values();
@endphp
<script>
    window.attributesData = @json($attributesJson ?? []);
    let variants = @json($variantData);
</script>
<script>
    $(document).ready(function () {
        function toggleProductTypeSections() {
            let type = $('input[name="product_type"]:checked').val();
            if (type == "{{ \App\Enums\ProductType::SIMPLE->value }}") {
                $('#simpleProductSection').removeClass('d-none');
                $('#variantSection').addClass('d-none');
            } else {
                $('#simpleProductSection').addClass('d-none');
                $('#variantSection').removeClass('d-none');
            }
        }

        $('.productTypeRadio').on('change', function () {
            toggleProductTypeSections();
        });
        toggleProductTypeSections();
    });
</script>
<script>
    $(document).ready(function () {
        /*
        |--------------------------------------------------------------------------
        | TOGGLE PRODUCT TYPE
        |--------------------------------------------------------------------------
        */
        function toggleProductTypeSections() {
            let type = $('input[name="product_type"]:checked').val();
            if (type == "{{ \App\Enums\ProductType::SIMPLE->value }}") {
                $('#simpleProductSection').removeClass('d-none');
                $('#variantSection').addClass('d-none');
            } else {
                $('#simpleProductSection').addClass('d-none');
                $('#variantSection').removeClass('d-none');
            }
        }

        $('.productTypeRadio').on('change', function () {
            toggleProductTypeSections();
        });

        toggleProductTypeSections();
        /*
        |--------------------------------------------------------------------------
        | LOAD EXISTING VARIANTS
        |--------------------------------------------------------------------------
        */

        renderVariants();

        /*
        |--------------------------------------------------------------------------
        | ATTRIBUTE SELECT
        |--------------------------------------------------------------------------
        */

        $('#variantAttributesSelect').on('change', function () {
            let selected = $(this).val() || [];
            $('#attributeValuesContainers').html('');
            selected.forEach(attrId => {
                let attribute = window.attributesData.find(
                    a => a.id == attrId
                );
                if (!attribute) return;
                let html = `
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <label class="form-label fw-semibold mb-3">
                                ${attribute.name} Values
                            </label>
                            <div class="d-flex flex-wrap gap-2">
                `;
                attribute.values.forEach(value => {
                    html += `
                        <label class="border rounded-pill px-3 py-2 cursor-pointer">
                            <input type="checkbox"
                                   class="variant-value-checkbox me-1"
                                   data-attribute="${attribute.id}"
                                   value="${value.id}"
                                   data-label="${value.value}">
                            ${value.value}
                        </label>
                    `;
                });
                html += `
                            </div>
                        </div>
                    </div>
                `;

                $('#attributeValuesContainers').append(html);
            });
        });

        /*
        |--------------------------------------------------------------------------
        | GENERATE VARIANTS
        |--------------------------------------------------------------------------
        */

        $('#generateVariants').on('click', function () {
            let groups = [];
            $('#attributeValuesContainers .card').each(function () {
                let values = [];
                $(this).find('.variant-value-checkbox:checked').each(function () {
                    values.push({
                        id: $(this).val(),
                        label: $(this).data('label')
                    });
                });

                if (values.length) {
                    groups.push(values);
                }
            });

            if (!groups.length) {
                alert('Select attribute values first.');
                return;
            }

            let combinations = cartesian(groups);
            variants = combinations.map((combo, index) => {
                return {
                    id: '',
                    name: combo.map(c => c.label).join(' / '),
                    values: combo.map(c => c.id),
                    sku: '',
                    price: '',
                    sale_price: '',
                    stock: '',
                    image: '',
                    status: 1
                };

            });
            renderVariants();
        });

        /*
        |--------------------------------------------------------------------------
        | CARTESIAN
        |--------------------------------------------------------------------------
        */
        function cartesian(arr) {
            return arr.reduce((a, b) => {
                return a.flatMap(d => {
                    return b.map(e => {
                        return d.concat([e]);
                    });
                });
            }, [[]]);

        }
        /*
        |--------------------------------------------------------------------------
        | RENDER VARIANTS
        |--------------------------------------------------------------------------
        */

        function renderVariants() {
            let html = '';
            variants.forEach((variant, index) => {
                let imagePreview = '';
                if (variant.image) {
                    imagePreview = `
                        <div class="mb-2">
                            <img src="/storage/${variant.image}"
                                 class="rounded border"
                                 width="50">
                        </div>
                    `;
                }

                html += `
                    <tr>
                        <td>
                            <strong>
                                ${variant.name}
                            </strong>

                            <input type="hidden"
                                   name="variants[${index}][id]"
                                   value="${variant.id ?? ''}">

                            ${variant.values.map(value => `
                                <input type="hidden"
                                       name="variants[${index}][values][]"
                                       value="${value}">
                            `).join('')}

                        </td>
                        <td>
                            <input type="text"
                                   name="variants[${index}][sku]"
                                   class="form-control"
                                   value="${variant.sku ?? ''}">

                        </td>
                        <td>
                            <input type="number"
                                   step="0.01"
                                   name="variants[${index}][price]"
                                   class="form-control"
                                   value="${variant.price ?? ''}">
                        </td>
                        <td>
                            <input type="number"
                                   step="0.01"
                                   name="variants[${index}][sell_price]"
                                   class="form-control"
                                   value="${variant.sell_price ?? ''}">

                        </td>
                        <td>
                            <input type="number"
                                   name="variants[${index}][stock]"
                                   class="form-control"
                                   value="${variant.stock ?? ''}">

                        </td>
                        <td>
                            ${imagePreview}

                            <input type="file"
                                   name="variants[${index}][image]"
                                   class="form-control">
                        </td>
                        <td>
                            <select name="variants[${index}][status]"
                                    class="form-select">

                                <option value="1"
                                    ${variant.status == 1 ? 'selected' : ''}>
                                    Active
                                </option>

                                <option value="0"
                                    ${variant.status == 0 ? 'selected' : ''}>
                                    Inactive
                                </option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button type="button"
                                    class="btn btn-sm btn-danger removeVariant"
                                    data-index="${index}">
                                <i class="ph-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#variantsTableBody').html(html);
        }
        /*
        |--------------------------------------------------------------------------
        | REMOVE VARIANT
        |--------------------------------------------------------------------------
        */
        $(document).on('click', '.removeVariant', function () {
            let index = $(this).data('index');
            variants.splice(index, 1);
            renderVariants();
        });
    });
</script>
@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#productDescription'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
<x-admin.footer />