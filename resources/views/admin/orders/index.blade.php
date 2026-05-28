<x-admin.header :title="'Orders'" />

<div class="col-xl-12">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-nowrap">
            <h4 class="mb-0 card-title">Orders</h4>
            <div>
                <a href="{{ route('view.admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">Back</a>
            </div>
        </div>
        <div class="card-body">
            <p class="text-muted">List of all orders. Click "View" to see details.</p>

            <div class="table-responsive">
                <table class="table align-middle table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->items->count() }}</td>
                            <td>{{ number_format($order->total, 2) }}</td>
                            <td>{{ optional($order->latestPayment())->method ?? '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'complete' ? 'success' : ($order->status == 'processing' ? 'warning' : 'secondary') }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ url('admin/orders/'.$order->id.'/view') }}" class="btn btn-sm btn-primary">View</a>
                                <select class="form-select form-select-sm d-inline-block order-status" data-id="{{ $order->id }}" style="width:130px">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="complete" {{ $order->status == 'complete' ? 'selected' : '' }}>Complete</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">{{ $orders->links() }}</div>
        </div>
    </div>
</div>

<x-admin.footer />

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.order-status').forEach(function(el){
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
    });
</script>
@endpush
