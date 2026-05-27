{{-- resources/views/admin/brands/create.blade.php --}}

<x-admin.header :title="'Create Brand'" />

<x-page-title
    title="Create Brand"
    :breadcrumbs="['Admin', 'Brands', 'Create']"
/>

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">{{ __('brand.Create_New_Brand') }}</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">{{ __('brand.Fill_Form_Create_Brand') }}</p>
                <form action="{{ route('brands.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('brand.Name') }}<span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('brand.Enter_Brand_Name') }}"
                            value="{{ old('name') }}"
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
                        >{{ old('description') }}</textarea>
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
                            checked
                        >
                        <label class="form-check-label" for="is_active">
                            {{ __('brand.Active') }}
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-save-line align-middle me-1"></i>{{ __('brand.Create_Brand') }}
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
