<x-admin.header :title="'Product'" />
   

<div class="container-fluid">

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data"
          id="productForm">

        @csrf

        {{-- Sticky Header --}}
        <div class="card mb-4 shadow-sm border-0 sticky-top z-3">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h4 class="mb-1 fw-bold">Create Product</h4>
                        <p class="text-muted mb-0">
                            Create simple or variant products professionally.
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
                            Save Product
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
                        <h5 class="fw-semibold mb-1">Basic Information</h5>
                        <p class="text-muted mb-0">
                            Product title, descriptions and organization.
                        </p>
                    </div>

                    <div class="card-body">

                        {{-- Product Title --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Product Name
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control form-control-mid"
                                   placeholder="Enter product name"
                                   value="{{ old('title') }}">

                            @error('title')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Short Description
                            </label>

                            <textarea name="short_description"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Short product summary">{{ old('short_description') }}</textarea>
                        </div>

                        {{-- Full Description --}}
                        <div class="mb-0">
                            <label class="form-label fw-semibold">
                                Product Description
                            </label>

                            <textarea name="product_decscription"
                                      class="ckeditor-classic"
                                      rows="8">{{ old('product_decscription') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- VARIANT SECTION --}}
                <div id="variantSection" class="d-none">
                  @include('admin.products.partials.variants-table')
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
                                           class="me-3 productTypeRadio">
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
                                           class="me-3 productTypeRadio">
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

                        {{-- Categories --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Categories
                            </label>

                            <select class="form-control"
                                    multiple
                                    name="categories[]"
                                    id="productCategories">

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Tags --}}
                        <div>
                            <label class="form-label fw-semibold">
                                Tags
                            </label>
                            <select class="form-control"
                                    multiple
                                    name="tags[]"
                                    id="productTags">
                                @foreach($allTags as $tag)
                                    <option value="{{ $tag->id }}">
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

                        {{-- Main Image --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Featured Image
                            </label>

                            <div class="border rounded-3 p-3 text-center">

                                <img id="productImagePreview"
                                     src="{{ asset('admin/images/new-document.png') }}"
                                     class="img-fluid rounded mb-3"
                                     style="max-height: 220px">

                                <input type="file"
                                       name="product_image"
                                       class="form-control"
                                       accept="image/*">

                            </div>

                        </div>

                        {{-- Gallery --}}
                        <div>

                            <label class="form-label fw-semibold">
                                Gallery Images
                            </label>

                            <input type="file"
                                   multiple
                                   name="gallery_images[]"
                                   class="form-control"
                                   accept="image/*">

                        </div>

                    </div>

                </div>

                {{-- SIMPLE PRODUCT INFO --}}
                <div id="simpleProductSection"
                     class="card border-0 shadow-sm mb-4 d-none">

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
                                   class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Price
                            </label>

                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Sale Price
                            </label>

                            <input type="number"
                                   step="0.01"
                                   name="sell_price"
                                   class="form-control">

                        </div>

                        <div>

                            <label class="form-label fw-semibold">
                                Stock
                            </label>

                            <input type="number"
                                   name="stock"
                                   class="form-control">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>
</div>
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
    window.attributesData = {!! json_encode($attributesJson) !!};
    $(document).ready(function () {
        let variants = [];
        /*
        |--------------------------------------------------------------------------
        | ATTRIBUTE VALUE SELECTORS
        |--------------------------------------------------------------------------
        */

        $('#variantAttributesSelect').on('change', function () {
            let selected = $(this).val() || [];
            $('#attributeValuesContainers').html('');
            selected.forEach(function(attrId) {
                let attribute = window.attributesData.find(function(item) {
                    return String(item.id) === String(attrId);
                });
                if (!attribute) {
                    return;
                }
                let html = `
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">

                            <label class="form-label fw-semibold mb-3">
                                ${attribute.name} Values
                            </label>
                            <div class="d-flex flex-wrap gap-2">
                `;
                attribute.values.forEach(function(value) {
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
                    name: combo.map(c => c.label).join(' / '),
                    values: combo.map(c => c.id),
                    sku: '',
                    price: '',
                    sale_price: '',
                    stock: '',
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
                html += `
                    <tr>
                        <td>
                            <strong>
                                ${variant.name}
                            </strong>
                            ${variant.values.map(value => `
                                <input type="hidden"
                                       name="variants[${index}][values][]"
                                       value="${value}">
                            `).join('')}
                            <input type="hidden"
                                   name="variants[${index}][name]"
                                   value="${variant.name}">

                        </td>
                        <td>
                            <input type="text"
                                   name="variants[${index}][sku]"
                                   class="form-control"
                                   value="${variant.sku}">

                        </td>
                        <td>
                            <input type="number"
                                   step="0.01"
                                   name="variants[${index}][price]"
                                   class="form-control">

                        </td>
                        <td>

                            <input type="number"
                                   step="0.01"
                                   name="variants[${index}][sell_price]"
                                   class="form-control">

                        </td>
                        <td>
                            <input type="number"
                                   name="variants[${index}][stock]"
                                   class="form-control">

                        </td>
                        <td>
                            <input type="file"
                                   name="variants[${index}][image]"
                                   class="form-control">

                        </td>
                        <td>
                            <select name="variants[${index}][status]"
                                    class="form-select">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
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
            if (variants.length) {
                $('#bulkVariantActions').removeClass('d-none');
            }

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

        /*
        |--------------------------------------------------------------------------
        | BULK APPLY
        |--------------------------------------------------------------------------
        */

        $('#applyBulkAction').on('click', function () {
            let price = $('#bulkPrice').val();
            let salePrice = $('#bulkSalePrice').val();
            let stock = $('#bulkStock').val();

            $('#variantsTableBody tr').each(function () {
                if (price) {
                    $(this).find('input[name*="[price]"]').val(price);
                }
                if (salePrice) {
                    $(this).find('input[name*="[sell_price]"]').val(salePrice);
                }
                if (stock) {
                    $(this).find('input[name*="[stock]"]').val(stock);
                }
            });
        });
    });
</script>
<script src="{{ asset('admin/js/pages/ecommerce-create-product.init.js') }}"></script>
<x-admin.footer />