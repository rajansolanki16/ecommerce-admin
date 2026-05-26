<x-admin.header :title="'Blog Authors'" />

<x-page-title title="Blog Authors" :breadcrumbs="['Blog', 'Authors']" />

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pb-0">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-6">
                        <div>
                            <h4 class="card-title mb-1">Author Management</h4>
                            <p class="text-muted mb-0">Manage the authors who can be assigned to blog posts.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-lg-end flex-wrap gap-2">
                            <a href="{{ route('blog.authors.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle align-baseline me-1"></i> Add Author
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('blog.authors.index') }}">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <div class="search-box">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search authors by name or email...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <button class="btn btn-primary">Search</button>
                            <a href="{{ route('blog.authors.index') }}" class="btn btn-light">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table align-middle table-hover nowrap w-100">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Posts</th>
                            <th>Joined</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->email }}</td>
                                <td>{{ $author->posts_count }}</td>
                                <td>{{ $author->created_at->format('d M, Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('blog.authors.edit', $author->id) }}" class="btn btn-subtle-secondary btn-icon btn-sm rounded-circle">
                                            <i class="ph-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-subtle-danger btn-icon btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteAuthorModal{{ $author->id }}">
                                            <i class="ph-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteAuthorModal{{ $author->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header border-0 pb-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center px-4 pb-4">
                                            <div class="mb-4">
                                                <div class="avatar-lg mx-auto">
                                                    <div class="avatar-title bg-danger-subtle text-danger rounded-circle fs-1">
                                                        <i class="ph-trash"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="mb-2">Delete Author?</h4>
                                            <p class="text-muted mb-4">You are about to permanently delete <strong>{{ $author->name }}</strong>. This action cannot be undone.</p>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('blog.authors.destroy', $author->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="ph-trash me-1"></i> Yes, Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    No authors found. Create one to assign to your blog posts.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row align-items-center mt-3">
                    <div class="col-sm">
                        <p class="text-muted mb-0">
                            Showing
                            <span class="fw-semibold">{{ $authors->firstItem() }}</span>
                            to
                            <span class="fw-semibold">{{ $authors->lastItem() }}</span>
                            of
                            <span class="fw-semibold">{{ $authors->total() }}</span>
                            results
                        </p>
                    </div>
                    <div class="col-sm-auto">
                        {{ $authors->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />
