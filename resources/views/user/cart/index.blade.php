<x-header :meta="array('title'=> getSetting('page_rooms_meta_title'), 'description'=> getSetting('page_rooms_meta_description'))" />

<main class="ko-container py-4">
    <section class="ko-bann">
        <div class="ko-container">
            <div class="ko-banner-content">
                <h2>🛒</h2>
            </div>
        </div>
        <h2 class="mb-6">My Cart</h2>
        @if(empty($cart))
        <p>Your cart is empty.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach($cart as $item)
                @php
                $total = $item['price'] * $item['quantity'];
                $grandTotal += $total;
                @endphp
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$item['image']) }}" width="60">
                        {{ $item['name'] }}
                    </td>
                    <td>₹{{ $item['price'] }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                                class="form-control form-control-sm"
                                style="width:70px"
                                onchange="this.form.submit()">
                        </form>
                    </td>

                    <td>₹{{ $total }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-end">Grand Total: ₹{{ $grandTotal }}</h4>
        <a href="{{ route('wishlist.index') }}"
            class="btn btn-sm btn-outline-secondary ">
            ← Back to Wishlist
        </a>
        @endif
        </div>
    </section>
</main>

<x-footer />