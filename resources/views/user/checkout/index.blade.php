<x-header :meta="array(
    'title' => 'Checkout -  E-commerce Store',
    'description' => 'Secure checkout'
)" />

<main class="ko-container py-5">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Checkout</h2>
            <p class="text-muted mb-0">Complete your purchase securely</p>
        </div>
    </div>

    <form method="POST" action="{{ route('checkout.place') }}">
        @csrf

        <div class="row g-4">
            <!-- LEFT : Billing Details -->
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
                                    class="form-control"
                                    placeholder="John Doe"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="john@example.com"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    placeholder="+91 98765 43210"
                                    required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Full Address</label>
                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control"
                                    placeholder="House no, Street, City, State, Pincode"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT : Order Summary -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-4">Order Summary</h5>

                        @foreach($cart as $item)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img
                                        src="{{ asset('storage/'.$item['image']) }}"
                                        width="50"
                                        height="50"
                                        class="rounded"
                                        style="object-fit: cover">

                                    <div>
                                        <div class="fw-medium">{{ $item['name'] }}</div>
                                        <small class="text-muted">
                                            Qty: {{ $item['quantity'] }}
                                        </small>
                                    </div>
                                </div>

                                <div class="fw-semibold">
                                    ₹{{ number_format($item['price'] * $item['quantity']) }}
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>₹{{ number_format($total) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span class="text-success">Free</span>
                        </div>

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
</main>

<x-footer />
