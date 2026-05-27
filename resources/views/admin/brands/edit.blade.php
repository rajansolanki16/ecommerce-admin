{{-- resources/views/admin/brands/edit.blade.php --}}

<x-admin.header :title="'Edit Brand'" />

<x-page-title
    title="Edit Brand"
    :breadcrumbs="['Admin', 'Brands', 'Edit']"
/>

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">{{ __('brand.Edit_Brand') }}</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">{{ __('brand.Update_Brand_Details') }}</p>
                <form action="{{ route('brands.update', $brand->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('brand.Name') }}<span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('brand.Enter_Brand_Name') }}"
                            value="{{ old('name', $brand->name) }}"
                            required
                        >
                        @error('name')
                        <div class="invalid-response" style="display:flex">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('brand.Description') }}</label>
                        <textarea
                            name="description"
                            id="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="{{ __('brand.Enter_Brand_Description') }}"
                            rows="4"
                        >{{ old('description', $brand->description) }}</textarea>
                        @error('description')
                        <div class="invalid-response" style="display:flex">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check form-switch">
                        <input
                            type="checkbox"
                            name="is_active"
                            id="is_active"
                            class="form-check-input"
                            value="1"
                            {{ old('is_active', $brand->is_active) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="is_active">
                            {{ __('brand.Active') }}
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-save-line align-middle me-1"></i>{{ __('brand.Update_Brand') }}
                        </button>
                        <a href="{{ route('brands.index') }}" class="btn btn-light">
                            {{ __('brand.Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />
