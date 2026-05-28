<x-header :meta="array(
    'title' => 'Checkout - E-commerce Store',
    'description' => 'Secure checkout'
)" />

<main class="ko-container py-5">

    @php
        $stripeEnabled = getPaymentSetting('stripe_enabled', false);
        $razorpayEnabled = getPaymentSetting('razorpay_enabled', false);
        $paymentCurrency = strtoupper(getPaymentSetting('payment_currency', 'INR'));
        $stripePublicKey = getPaymentSetting('stripe_key');
        $razorpayKeyId = getPaymentSetting('razorpay_key_id');
    @endphp

    {{-- Flash Messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Checkout</h2>
            <p class="text-muted mb-0">Complete your purchase securely</p>
        </div>
    </div>

    {{-- Coupon Block (outside the order form) --}}
    @if (session('applied_coupon'))
        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span>
                Coupon <strong>{{ session('applied_coupon')['code'] }}</strong> applied
                — you save ₹{{ number_format(session('applied_coupon')['discount'], 2) }}
            </span>
            <form method="POST" action="{{ route('checkout.remove.coupon') }}">
                @csrf
                <button class="btn btn-sm btn-outline-danger">Remove</button>
            </form>
        </div>
    @else
        <form method="POST" action="{{ route('checkout.apply.coupon') }}" class="mb-3">
            @csrf
            <div class="input-group" style="max-width: 400px;">
                <input
                    type="text"
                    name="code"
                    class="form-control"
                    placeholder="Enter coupon code"
                    style="text-transform: uppercase"
                    value="{{ old('code') }}">
                <button class="btn btn-outline-secondary" type="submit">Apply</button>
            </div>
        </form>
    @endif

    {{-- Main Order Form --}}
    <form id="checkoutForm" method="POST" action="{{ route('checkout.place') }}">
        @csrf
        <input type="hidden" name="payment_status" id="paymentStatus" value="pending">
        <input type="hidden" name="transaction_id" id="transactionId" value="">

        <div class="row g-4">

            {{-- LEFT: Billing Details --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-4">Billing Details</h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="John Doe"
                                    value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="john@example.com"
                                    value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="+91 98765 43210"
                                    value="{{ old('phone') }}"
                                    required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Full Address</label>
                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="House no, Street, City, State, Pincode"
                                    required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-4">Payment Method</h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="paymentCod" value="cod" checked>
                            <label class="form-check-label" for="paymentCod">Cash on Delivery</label>
                        </div>

                        @if ($stripeEnabled)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="paymentStripe" value="stripe">
                                <label class="form-check-label" for="paymentStripe">Stripe</label>
                            </div>
                        @endif

                        @if ($razorpayEnabled)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="paymentRazorpay" value="razorpay">
                                <label class="form-check-label" for="paymentRazorpay">Razorpay</label>
                            </div>
                        @endif

                        <div id="stripePaymentSection" class="mt-3" style="display: none;">
                            <label class="form-label">Card details</label>
                            <div id="stripe-card-element" class="form-control"></div>
                            <div class="text-danger small mt-2" id="stripe-card-errors"></div>
                        </div>

                        <div id="razorpayInfo" class="mt-3" style="display: none;">
                            <div class="alert alert-secondary mb-0">
                                You will be redirected to Razorpay checkout after clicking submit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Order Summary --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-4">Order Summary</h5>

                        @foreach ($cart as $item)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img
                                        src="{{ asset('storage/' . $item['image']) }}"
                                        width="50"
                                        height="50"
                                        class="rounded"
                                        style="object-fit: cover"
                                        alt="{{ $item['name'] }}">
                                    <div>
                                        <div class="fw-medium">{{ $item['name'] }}</div>
                                        <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                    </div>
                                </div>
                                <div class="fw-semibold">
                                    ₹{{ number_format($item['price'] * $item['quantity']) }}
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($subtotal) }}</span>
                        </div>

                        @if ($discount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>
                                    Discount
                                    @if (session('applied_coupon'))
                                        ({{ session('applied_coupon')['code'] }})
                                    @endif
                                </span>
                                <span>− ₹{{ number_format($discount) }}</span>
                            </div>
                        @endif

                        <hr>

                        <div class="d-flex justify-content-between fs-5 fw-bold mb-4">
                            <span>Total</span>
                            <span>₹{{ number_format($total) }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            Place Order
                        </button>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                🔒 Secure checkout · Your data is protected
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    @if ($stripeEnabled)
        <script src="https://js.stripe.com/v3/"></script>
    @endif
    @if ($razorpayEnabled)
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif
    <script>
        const checkoutStripePublicKey = {!! json_encode($stripePublicKey) !!};
        const checkoutRazorpayKeyId = {!! json_encode($razorpayKeyId) !!};
        const checkoutCurrency = {!! json_encode($paymentCurrency) !!};
        const checkoutTotal = {!! json_encode(number_format($total, 2, '.', '')) !!};
        const csrfToken = {!! json_encode(csrf_token()) !!};

        const axiosClient = window.axios || {
            post: async (url, data) => {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(data),
                    credentials: 'same-origin',
                });

                const contentType = response.headers.get('content-type') || '';
                let responseBody = null;

                if (contentType.includes('application/json')) {
                    responseBody = await response.json();
                } else {
                    responseBody = await response.text();
                }

                if (!response.ok) {
                    const message = responseBody?.message || responseBody || response.statusText;
                    const error = new Error(message || 'Request failed');
                    error.response = { data: responseBody, status: response.status };
                    throw error;
                }

                return { data: responseBody };
            }
        };

        const form = document.getElementById('checkoutForm');
        const stripeSection = document.getElementById('stripePaymentSection');
        const razorpayInfo = document.getElementById('razorpayInfo');
        const paymentStatus = document.getElementById('paymentStatus');
        const transactionId = document.getElementById('transactionId');
        const submitButton = form.querySelector('button[type="submit"]');
        const stripeErrors = document.getElementById('stripe-card-errors');

        let stripe;
        let stripeCard;

        function setPaymentVisibility() {
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            stripeSection.style.display = method === 'stripe' ? 'block' : 'none';
            razorpayInfo.style.display = method === 'razorpay' ? 'block' : 'none';
            submitButton.textContent = method === 'stripe' ? 'Pay with Stripe' : method === 'razorpay' ? 'Pay with Razorpay' : 'Place Order';

            if (method === 'stripe' && !stripe && checkoutStripePublicKey) {
                stripe = Stripe(checkoutStripePublicKey);
                const elements = stripe.elements();
                stripeCard = elements.create('card', {style: {base: {fontSize: '16px'}}});
                stripeCard.mount('#stripe-card-element');
                stripeCard.on('change', function(event) {
                    stripeErrors.textContent = event.error ? event.error.message : '';
                });
            }
        }

        document.querySelectorAll('input[name="payment_method"]').forEach((radio) => {
            radio.addEventListener('change', setPaymentVisibility);
        });

        setPaymentVisibility();

        async function handleStripePayment(event) {
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            if (method !== 'stripe') {
                return true;
            }

            if (!checkoutStripePublicKey) {
                stripeErrors.textContent = 'Stripe publishable key is not configured.';
                return false;
            }

            if (!stripeCard) {
                stripeErrors.textContent = 'Card field is not ready yet.';
                return false;
            }

            submitButton.disabled = true;
            submitButton.textContent = 'Processing payment...';

            try {
                const response = await axiosClient.post('{{ route('checkout.payment.stripe') }}', {
                    _token: csrfToken,
                });

                const clientSecret = response.data.client_secret;
                const name = form.querySelector('input[name="name"]').value;
                const email = form.querySelector('input[name="email"]').value;
                const phone = form.querySelector('input[name="phone"]').value;

                const result = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: stripeCard,
                        billing_details: {
                            name,
                            email,
                            phone,
                        },
                    },
                });

                if (result.error) {
                    stripeErrors.textContent = result.error.message || 'Stripe payment failed.';
                    submitButton.disabled = false;
                    submitButton.textContent = 'Pay with Stripe';
                    return false;
                }

                if (result.paymentIntent && result.paymentIntent.status === 'succeeded') {
                    paymentStatus.value = 'paid';
                    transactionId.value = result.paymentIntent.id;
                    form.submit();
                    return true;
                }

                stripeErrors.textContent = 'Stripe payment did not complete.';
            } catch (error) {
                stripeErrors.textContent = error.response?.data?.message || error.message || 'Stripe payment failed.';
            }

            submitButton.disabled = false;
            submitButton.textContent = 'Pay with Stripe';
            return false;
        }

        async function handleRazorpayPayment(event) {
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            if (method !== 'razorpay') {
                return true;
            }

            if (!checkoutRazorpayKeyId) {
                alert('Razorpay key is not configured.');
                return false;
            }

            submitButton.disabled = true;
            submitButton.textContent = 'Preparing checkout...';

            try {
                const response = await axiosClient.post('{{ route('checkout.payment.razorpay') }}', {
                    _token: csrfToken,
                });

                const data = response.data;
                const options = {
                    key: data.key,
                    order_id: data.order_id,
                    amount: data.amount,
                    currency: data.currency,
                    name: '{{ getSetting('site_name') ?? 'E-commerce Store' }}',
                    description: 'Order Payment',
                    prefill: {
                        name: form.querySelector('input[name="name"]').value,
                        email: form.querySelector('input[name="email"]').value,
                        contact: form.querySelector('input[name="phone"]').value,
                    },
                    handler: function(response) {
                        paymentStatus.value = 'paid';
                        transactionId.value = response.razorpay_payment_id;
                        form.submit();
                    },
                    modal: {
                        ondismiss: function() {
                            submitButton.disabled = false;
                            submitButton.textContent = 'Pay with Razorpay';
                        }
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            } catch (error) {
                alert(error.response?.data?.message || error.message || 'Unable to start Razorpay checkout.');
                submitButton.disabled = false;
                submitButton.textContent = 'Pay with Razorpay';
            }

            return false;
        }

        form.addEventListener('submit', async function(event) {
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            if (method === 'stripe') {
                event.preventDefault();
                await handleStripePayment(event);
            } else if (method === 'razorpay') {
                event.preventDefault();
                await handleRazorpayPayment(event);
            }
        });
    </script>
</main>

<x-footer />