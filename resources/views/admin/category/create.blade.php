<x-admin.header :title="'product Categories'" />
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="flex-grow-1">
                    <h5 class="mb-4 card-title">Product Categories</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">Create</h4>
            </div>

            <div class="card-body">
                <p class="text-muted">Create the new category for products categories.</p>
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">Category Title <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="category" class="form-control @error('name') is-invalid @enderror" placeholder="Enter category title">

                        @error('name')
                        <div class="invalid-response" style="display:flex">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subcategory" class="form-label">parent Category Title <span class="text-danger">*</span></label>
                        <!-- <input type="text" name="parent_id" id="subcategory" class="form-control" placeholder="Enter sub category title" value=""> -->
                        <select name="parent_id" id="subcategory" class="form-control">
                            <option value="">Select parent Category</option>
                            @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}">
                                {{ $parent->name }}
                            </option>
                            @endforeach
                        </select>


                    </div>

                    <div class="mb-1 text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<x-admin.footer />