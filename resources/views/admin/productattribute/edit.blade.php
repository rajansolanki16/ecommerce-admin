<x-admin.header :title="'Product Edit Tags'" />
<div class="card">
    <div class="card-header d-flex align-items-center">
        <div class="flex-grow-1">
            <h5 class="mb-4 card-title">{{ __('attribute.product_attributes') }}</h5>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">{{ __('attribute.edit_Product_Attribute') }}</h4>
            </div>

            <div class="card-body">
                <p class="text-muted">{{ __('attribute.Product_Attribute_Update_Description') }}</p>
                <form action="{{ route('product_attributes.update', $attribute->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tag" class="form-label">{{ __('attribute.Product_Attribute_Name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="tag" class="form-control @error('name') is-invalid @enderror" placeholder="Enter tag title" value="{{ old('name', isset($attribute) ? $attribute->name : '') }}">

                        @error('name')
                        <div class="invalid-response" style="display:flex">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="gap-2 mb-3 hstack justify-content-end">
                        <button type="submit" class="btn btn-primary">{{ __('attribute.Update') }}</button>
                        <a href="{{ route('product_attributes.index') }}" class="btn btn-danger">{{ __('attribute.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Attribute values -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="flex-grow-1">
                    <h5 class="mb-4 card-title">{{ __('values.product_attributes_value') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">{{ __('values.product_create_edit_title') }}</h4>
            </div>

            <div class="card-body">
                <p class="text-muted">{{ __('values.product_attributes_value_description') }}</p>
                <form
                    action="{{ isset($edit_value)
        ? route('attribute_values.update', $edit_value->id)
        : route('attribute_values.store') }}"
                    method="post">

                    @csrf
                    @if(isset($edit_value))
                    @method('PUT')
                    @endif

                    <input type="hidden" name="product_attribute_id" value="{{ $attribute->id }}">
                    <label for="values" class="form-label">{{ __('values.attribute_value') }}<span class="text-danger">{{ __('values.required_mark') }}</span></label>
                    <input type="text"
                        name="value"
                        class="form-control @error('value') is-invalid @enderror"
                        value="{{ old('value', $edit_value->value ?? '') }}">

                    @error('value')
                    <div class="invalid-response" style="display:flex">{{ $message }}</div>
                    @enderror

                    <div class="mb-5 text-end">
                        <button type="submit" class="btn btn-primary">{{ __('values.Submit') }}</button>
                        @if(isset($edit_value))
                        <a href="{{ route('product_attributes.edit', $attribute->id) }}"
                            class="btn btn-danger">{{ __('values.cancel') }}</a>
                        @endif

                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">{{ __('values.product_attribute_value_listing') }}</h4>
            </div>

            <div class="card-body">
                <p class="text-muted"> {{ __('values.product_attribute_value_listing_des') }}</p>
                <div class="table-responsive">
                    <table id="fixed-header" class="table align-middle table-bordered dt-responsive nowrap table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Attribute</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attribute->values as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->value }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>
                                    <div class="dropdown position-static">
                                        <button class="btn btn-subtle-secondary btn-sm btn-icon" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{ route('attribute_values.edit', $value->id) }}" class="dropdown-item edit-item-btn"><i class="align-middle ph-pencil me-1"></i>Edit</a></li>
                                            <li><a href="javascript:void(0)" class="dropdown-item remove-item-btn" data-delete-url="{{ route('attribute_values.destroy', $value->id) }}" onclick="setDeleteFormAction(this)"><i class="align-middle ph-trash me-1"></i> Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteRecordModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-md-5">
                <div class="text-center">
                    <div class="text-danger">
                        <i class="bi bi-trash display-4"></i>
                    </div>
                    <div class="mt-4">
                        <h3 class="mb-2">Are you sure?</h3>
                        <p class="mx-3 mb-0 text-muted fs-lg">Are you sure you want to remove this product Attribute values <b>permanently</b>?</p>
                    </div>
                </div>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="gap-2 mt-4 mb-2 d-flex justify-content-center">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn w-sm btn-danger">Yes!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<x-admin.footer />