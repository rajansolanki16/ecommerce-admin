<x-admin.header :title="'Product Details'" />

<div class="container-fluid">

    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $product->product_title }}</h4>
                <div class="page-title-right">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row g-3">
                        <!-- Image -->
                        <div class="col-md-4">
                            <img src="{{ $product->product_image ? asset('storage/'.$product->product_image) : asset('admin/images/no-image.png') }}" 
                                 class="img-fluid rounded" alt="Product Image">
                        </div>

                        <!-- Info -->
                        <div class="col-md-8">
                            <h5>Product Information</h5>
                            <p><strong>Title:</strong> {{ $product->product_title }}</p>
                            <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
                            <p><strong>Stock:</strong> {{ $product->stock ?? 0 }}</p>
                            <p><strong>Categories:</strong> 
                                {{ $product->categories->pluck('name')->join(', ') ?: '-' }}
                            </p>
                            <p><strong>Description:</strong></p>
                            <div>{!! $product->description !!}</div>

                            <div class="mt-3">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil"></i> Edit Product
                                </a>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />
