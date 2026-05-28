<x-admin.header :title="'Order Details'" />

<div class="col-xl-12">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-nowrap">
            <h4 class="mb-0 card-title">Order #{{ $order->id }}</h4>
            <div>
                <a href="{{ url('admin/orders') }}" class="btn btn-sm btn-outline-secondary">Back to list</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Customer</h5>
                    <p class="mb-1"><strong>Name:</strong> {{ $order->user->name ?? $order->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Shipping</h5>
                    <p class="mb-1">{{ $order->address }}</p>
                    <p class="mb-1"><strong>Created:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p class="mb-1"><strong>Status:</strong>
                        <select class="form-select d-inline-block order-status" data-id="{{ $order->id }}" style="width:160px">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="complete" {{ $order->status == 'complete' ? 'selected' : '' }}>Complete</option>
                        </select>
                    </p>
                </div>
            </div>

            <h5>Items</h5>
            <div class="table-responsive mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->product_title ?? $item->name }}</td>
                            <td>{{ $item->product->sku_number ?? '—' }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>Payment</h5>
                    @php($payment = $order->latestPayment())
                    <p class="mb-1"><strong>Method:</strong> {{ optional($payment)->method ?? '—' }}</p>
                    <p class="mb-1"><strong>Transaction:</strong> {{ optional($payment)->transaction_id ?? '—' }}</p>
                    <p class="mb-1"><strong>Status:</strong> {{ optional($payment)->status ?? '—' }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <h5>Totals</h5>
                    <p class="mb-1"><strong>Subtotal:</strong> {{ number_format($order->subtotal ?? $order->total, 2) }}</p>
                    <p class="mb-1"><strong>Total:</strong> {{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const el = document.querySelector('.order-status');
        if(!el) return;
        el.addEventListener('change', function(){
            const id = this.dataset.id;
            const status = this.value;
            fetch(`{{ url('/admin/orders') }}/${id}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status })
            }).then(r => r.json()).then(res => {
                if(res.success){
                    // optional: show toast
                }
            }).catch(err => console.error(err));
        });
    });
</script>
@endpush