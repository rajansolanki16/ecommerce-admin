<x-admin.header :title="'Product Category Listings'" />
<x-page-title
    title="Product Categories"
    :breadcrumbs="['Products', 'Categories']"
/>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" id="categoryList">
            {{-- Header --}}
            <div class="card-header bg-white border-0 pb-0">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-6">
                        <div>
                            <h4 class="card-title mb-1">
                                Category Management
                            </h4>
                            <p class="text-muted mb-0">
                                Manage all product categories and subcategories
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex justify-content-lg-end flex-wrap gap-2">
                            <a href="{{ route('categories.create') }}"
                               class="btn btn-primary">
                                <i class="bi bi-plus-circle align-baseline me-1"></i>Add Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">
                {{-- Table --}}
                <div class="table-responsive">
                    <table id="categoryTable"
                           class="table align-middle table-hover nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">ID</th>
                                <th> Category</th>
                                <th> Slug </th>
                                <th> Type</th>
                                <th>Created At</th>
                                <th class="text-center" style="width: 120px;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($categories as $category)
                                <tr>
                                    <td>
                                        <span class="fw-semibold text-muted">
                                            #{{ $category->id }}
                                        </span>
                                    </td>

                                    {{-- Category --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-sm flex-shrink-0">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="ri-folder-2-line"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-semibold">
                                                    {{ $category->name }}
                                                </h6>
                                                <small class="text-muted">
                                                    {{ $category->parent_id ? 'Sub Category' : 'Main Category' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Slug --}}
                                    <td>
                                        <span class="badge bg-light text-dark border fw-normal px-3 py-2"> {{ $category->slug }}</span>
                                    </td>

                                    {{-- Type --}}
                                    <td>
                                        @if($category->parent_id)
                                            <span class="badge bg-info-subtle text-info px-3 py-2">Sub Category</span>
                                        @else
                                            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                                Main Category
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Created --}}
                                    <td>
                                        <span class="text-muted">
                                            {{ $category->created_at->format('d M, Y') }}
                                        </span>
                                    </td>

                                    {{-- Action --}}
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                           {{-- Edit --}}
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                               class="btn btn-subtle-secondary btn-icon btn-sm rounded-circle">

                                                <i class="ph-pencil"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <button type="button"
                                                    class="btn btn-subtle-danger btn-icon btn-sm rounded-circle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategoryModal{{ $category->id }}">

                                                <i class="ph-trash"></i>

                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Delete Modal --}}
                                <div class="modal fade"
                                     id="deleteCategoryModal{{ $category->id }}"
                                     tabindex="-1"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg">

                                            {{-- Header --}}
                                            <div class="modal-header border-0 pb-0">
                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                            </div>

                                            {{-- Body --}}
                                            <div class="modal-body text-center px-4 pb-4">
                                                <div class="mb-4">
                                                    <div class="avatar-lg mx-auto">
                                                        <div class="avatar-title bg-danger-subtle text-danger rounded-circle fs-1">
                                                            <i class="ph-trash"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="mb-2">
                                                    Delete Category?
                                                </h4>
                                                <p class="text-muted mb-4">
                                                    You are about to permanently delete
                                                    <strong>{{ $category->name }}</strong>.
                                                    This action cannot be undone.
                                                </p>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button"
                                                            class="btn btn-light"
                                                            data-bs-dismiss="modal">

                                                        Cancel
                                                    </button>
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger">
                                                            <i class="ph-trash me-1"></i>
                                                            Yes, Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center py-5">
                                            <div class="avatar-lg mx-auto mb-3">
                                                <div class="avatar-title bg-light text-primary rounded-circle fs-1">
                                                    <i class="ri-folder-open-line"></i>
                                                </div>
                                            </div>
                                            <h5>No Categories Found</h5>
                                            <p class="text-muted mb-0">
                                                No product categories available right now.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />