<x-admin.header :title="'Payment Gateway Settings'" />

<div class="col-xl-12">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-nowrap">
            <h4 class="mb-0 card-title">Payment Gateway Settings</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Configure your payment gateways and currency settings.</p>

            {{-- @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}

            <form action="{{ route('settings.payment.update') }}" method="POST">
                @csrf

                {{-- GENERAL SETTINGS --}}
                <div class="card mb-4 border">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">
                            <i class="bi bi-gear me-2"></i>General Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Currency</label>
                                <select name="payment_currency" class="form-select">
                                    <option value="INR" @selected(($settings['payment_currency'] ?? '') == 'INR')>INR — Indian Rupee</option>
                                    <option value="USD" @selected(($settings['payment_currency'] ?? '') == 'USD')>USD — US Dollar</option>
                                    <option value="EUR" @selected(($settings['payment_currency'] ?? '') == 'EUR')>EUR — Euro</option>
                                    <option value="GBP" @selected(($settings['payment_currency'] ?? '') == 'GBP')>GBP — British Pound</option>
                                </select>
                                @error('payment_currency')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Payment Mode</label>
                                <select name="payment_mode" class="form-select">
                                    <option value="sandbox" @selected(($settings['payment_mode'] ?? '') == 'sandbox')>Sandbox / Test</option>
                                    <option value="live"    @selected(($settings['payment_mode'] ?? '') == 'live')>Live</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                   name="cod_enabled" value="1"
                                   id="codSwitch"
                                   @checked($settings['cod_enabled'] ?? false)>
                            <label class="form-check-label" for="codSwitch">
                                Enable Cash on Delivery (COD)
                            </label>
                        </div>
                    </div>
                </div>

                {{-- STRIPE --}}
                <div class="card mb-4 border">
                    <div class="card-header d-flex align-items-center justify-content-between flex-nowrap">
                        <h5 class="mb-0 card-title">
                            <i class="bi bi-credit-card me-2"></i>Stripe
                        </h5>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox"
                                   name="stripe_enabled" value="1"
                                   id="stripeSwitch"
                                   @checked($settings['stripe_enabled'] ?? false)>
                            <label class="form-check-label" for="stripeSwitch">Enable</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Publishable Key</label>
                                <input type="text"
                                       name="stripe_key"
                                       class="form-control @error('stripe_key') is-invalid @enderror"
                                       placeholder="pk_live_... or pk_test_..."
                                       value="{{ $settings['stripe_key'] ?? '' }}">
                                @error('stripe_key')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Secret Key</label>
                                <div class="input-group">
                                    <input type="password"
                                           name="stripe_secret"
                                           id="stripeSecret"
                                           class="form-control"
                                           placeholder="sk_live_... or sk_test_...">
                                    <button class="btn btn-outline-secondary" type="button"
                                            onclick="toggleVisibility('stripeSecret', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @if(!empty($settings['stripe_secret']))
                                    <small class="text-muted">
                                        <i class="bi bi-check-circle text-success me-1"></i>
                                        Secret key saved. Leave blank to keep existing.
                                    </small>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Webhook Secret</label>
                                <div class="input-group">
                                    <input type="password"
                                           name="stripe_webhook_secret"
                                           id="stripeWebhook"
                                           class="form-control"
                                           placeholder="whsec_...">
                                    <button class="btn btn-outline-secondary" type="button"
                                            onclick="toggleVisibility('stripeWebhook', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @if(!empty($settings['stripe_webhook_secret']))
                                    <small class="text-muted">
                                        <i class="bi bi-check-circle text-success me-1"></i>
                                        Webhook secret saved. Leave blank to keep existing.
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RAZORPAY --}}
                <div class="card mb-4 border">
                    <div class="card-header d-flex align-items-center justify-content-between flex-nowrap">
                        <h5 class="mb-0 card-title">
                            <i class="bi bi-wallet2 me-2"></i>Razorpay
                        </h5>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox"
                                   name="razorpay_enabled" value="1"
                                   id="razorpaySwitch"
                                   @checked($settings['razorpay_enabled'] ?? false)>
                            <label class="form-check-label" for="razorpaySwitch">Enable</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Key ID</label>
                                <input type="text"
                                       name="razorpay_key_id"
                                       class="form-control @error('razorpay_key_id') is-invalid @enderror"
                                       placeholder="rzp_live_... or rzp_test_..."
                                       value="{{ $settings['razorpay_key_id'] ?? '' }}">
                                @error('razorpay_key_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Key Secret</label>
                                <div class="input-group">
                                    <input type="password"
                                           name="razorpay_key_secret"
                                           id="razorpaySecret"
                                           class="form-control"
                                           placeholder="Your Razorpay secret">
                                    <button class="btn btn-outline-secondary" type="button"
                                            onclick="toggleVisibility('razorpaySecret', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @if(!empty($settings['razorpay_key_secret']))
                                    <small class="text-muted">
                                        <i class="bi bi-check-circle text-success me-1"></i>
                                        Secret saved. Leave blank to keep existing.
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Settings
                    </button>
                    <a href="{{ route('view.admin.dashboard') }}" class="btn btn-light">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function toggleVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>

<x-admin.footer />