<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-semibold mb-1">Product Variants</h5>
                <p class="text-muted mb-0">
                    Generate and manage variant combinations.
                </p>
            </div>

            <button type="button"
                    id="generateVariants"
                    class="btn btn-primary">
                <i class="ph-plus me-1"></i>
                Generate Variants
            </button>
        </div>
    </div>

    <div class="card-body">

        {{-- ATTRIBUTES --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Variant Attributes
            </label>
            <select class="form-control"
                    id="variantAttributesSelect"
                    name="product_attributes[]"
                    multiple>
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}">
                        {{ $attribute->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- ATTRIBUTE VALUES --}}
        <div id="attributeValuesContainers"></div>

        {{-- BULK ACTIONS --}}
        <div id="bulkVariantActions"
             class="card bg-light border-0 mb-4 d-none">

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <label class="form-label">
                            Bulk Price
                        </label>
                        <input type="number"
                               step="0.01"
                               id="bulkPrice"
                               class="form-control">

                    </div>

                    <div class="col-lg-3">
                        <label class="form-label"> Bulk Sale Price</label>
                        <input type="number"
                               step="0.01"
                               id="bulkSalePrice"
                               class="form-control">
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">
                            Bulk Stock
                        </label>
                        <input type="number"
                               id="bulkStock"
                               class="form-control">
                    </div>

                    <div class="col-lg-3 d-flex align-items-end">
                        <button type="button" id="applyBulkAction" class="btn btn-dark w-100"> Apply To All Variants</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- VARIANTS TABLE --}}
        <div class="table-responsive">
            <table class="table align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="25%">Variant</th>
                        <th width="15%">SKU</th>
                        <th width="10%"> Price</th>
                        <th width="10%">Sale Price</th>
                        <th width="10%">Stock</th>
                        <th width="15%">Image</th>
                        <th width="10%">Status</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody id="variantsTableBody">
                    {{-- Dynamic Rows --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
