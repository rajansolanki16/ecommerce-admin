<x-admin.header :title="'Coupon create'" />
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="flex-grow-1">
                    <h5 class="mb-4 card-title">{{ __('coupon.Add_coupon') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<form class="store-blogs" action="{{ route('coupons.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-4">
                            <h5 class="mb-3 card-title">{{ __('coupon.Coupon_code') }}</h5>
                            <p class="text-muted">{{ __('coupon.coupon_desc') }}</p>
                        </div>
                        <div class="col-xxl-8">

                            <div class="mb-3">
                                <label for="vec_coupon_code" class="form-label">{{ __('coupon.Coupon_code') }} <span
                                        class="text-danger">{{ __('coupon.required_mark') }}</span></label>
                                <input type="text" name="code" id="vec_coupon_code" class="form-control"
                                    placeholder="Enter coupon code" value="{{ old('code') }}">
                                @error('code')
                                    <span class="form-error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="gap-2 mb-3 hstack justify-content">
                                <button type="button" onclick="vec_generate_coupon_code()"
                                    class="btn btn-secondary">{{ __('coupon.Generate_Code_Button') }}</button>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('coupon.description') }}</label>
                                <input type="text" name="description" id="description" class="form-control"
                                    placeholder="Enter description" value="{{ old('description') }}">
                            </div>

                            <div class="mb-3">
                                <label for="discount_type" class="form-label">{{ __('coupon.discount_type') }} <span
                                        class="text-danger">{{ __('coupon.required_mark') }}</span></label>
                                <select name="type" id="discount_type" class="form-control">
                                    <option value="">Select Discount Type</option>
                                    <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>
                                        Percentage</option>
                                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed
                                    </option>
                                </select>
                                @error('type')
                                    <span class="form-error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">{{ __('coupon.amount') }} <span
                                        class="text-danger">{{ __('coupon.required_mark') }}</span></label>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                                    placeholder="Percentage (1–100) or fixed value" value="{{ old('amount') }}">
                                @error('amount')
                                    <span class="form-error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="min_order_amount" class="form-label">Minimum Order Amount</label>
                                <input type="number" step="0.01" name="min_order_amount" id="min_order_amount"
                                    class="form-control" placeholder="Enter minimum cart total"
                                    value="{{ old('min_order_amount') }}">
                            </div>

                            <div class="mb-3">
                                <label for="max_discount_amount" class="form-label">Maximum Discount Amount</label>
                                <input type="number" step="0.01" name="max_discount_amount" id="max_discount_amount"
                                    class="form-control" placeholder="Cap the discount at this amount"
                                    value="{{ old('max_discount_amount') }}">
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">{{ __('coupon.start_date') }}</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ old('start_date') }}">
                            </div>

                            <div class="mb-3">
                                <label for="expiry_date" class="form-label">{{ __('coupon.end_date') }}</label>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                                    value="{{ old('expiry_date') }}">
                            </div>

                            <div class="mb-3">
                                <label for="max_usage" class="form-label">{{ __('coupon.maximum_usage') }}</label>
                                <input type="number" name="max_usage" id="max_usage" class="form-control"
                                    placeholder="Total uses allowed" value="{{ old('max_usage') }}">
                            </div>

                            <div class="mb-3">
                                <label for="max_usage_per_user" class="form-label">Max Usage Per User</label>
                                <input type="number" name="max_usage_per_user" id="max_usage_per_user"
                                    class="form-control" placeholder="How many times one user can use it"
                                    value="{{ old('max_usage_per_user') }}">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                        value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="gap-2 mb-3 hstack justify-content-end">
                        <button type="submit" name="action" value="store"
                            class="btn btn-primary">{{ __('coupon.Create_Button') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<x-admin.footer />
