{{-- resources/views/admin/users/index.blade.php --}}

<x-admin.header :title="'Users'" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

<x-page-title title="Users Index" :breadcrumbs="['Users', 'Index']" />

<div class="row">
    <div class="col-12">
        <div class="card" id="userList">

            {{-- Card Header --}}
            <div class="card-header">
                <div class="row align-items-center gy-3">
                    {{-- Search --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="search-box">
                            <input type="text" class="form-control search"
                                placeholder="Search users by name, email or role...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>

                    {{-- Right Actions --}}
                    <div class="col-md-auto ms-md-auto">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            {{-- Delete Multiple --}}
                            <button class="btn btn-subtle-danger d-none" id="remove-actions">

                                <i class="ri-delete-bin-2-line"></i>

                            </button>

                            {{-- Sort Dropdown --}}
                            <div class="dropdown card-header-dropdown sortble-dropdown flex-shrink-0">

                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown">

                                    <span class="text-muted dropdown-title">
                                        Sort By
                                    </span>

                                    <i class="mdi mdi-chevron-down ms-1"></i>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <button class="dropdown-item sort" data-sort="user_name">

                                        Name

                                    </button>

                                    <button class="dropdown-item sort" data-sort="email">

                                        Email

                                    </button>

                                    <button class="dropdown-item sort" data-sort="role">

                                        Role

                                    </button>

                                    <button class="dropdown-item sort" data-sort="created">

                                        Created Date

                                    </button>

                                </div>

                            </div>

                            {{-- Add User --}}
                            <a href="{{ route('users.create') }}" class="btn btn-primary add-btn">

                                <i class="bi bi-plus-circle align-baseline me-1"></i>

                                Add User

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Card Body --}}
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">

                        {{-- Table Head --}}
                        <thead class="text-muted table-light">

                            <tr>

                                <th style="width: 50px;">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" id="checkAll">

                                        <label class="form-check-label" for="checkAll"></label>

                                    </div>

                                </th>

                                <th class="sort cursor-pointer" data-sort="user_name">

                                    User

                                </th>

                                <th class="sort cursor-pointer" data-sort="email">

                                    Email

                                </th>

                                <th class="sort cursor-pointer" data-sort="role">

                                    Role

                                </th>

                                <th class="sort cursor-pointer" data-sort="status">

                                    Status

                                </th>

                                <th class="sort cursor-pointer" data-sort="created">

                                    Created Date

                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>

                        {{-- Table Body --}}
                        <tbody class="list form-check-all">

                            @forelse($users as $user)
                                <tr>

                                    {{-- Checkbox --}}
                                    <th>

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" name="chk_child">

                                            <label class="form-check-label"></label>

                                        </div>

                                    </th>

                                    {{-- User --}}
                                    <td class="user_name">

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="avatar-xs">

                                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">

                                                    {{ strtoupper(substr($user->name, 0, 1)) }}

                                                </div>

                                            </div>

                                            <div>

                                                <h6 class="mb-0">
                                                    {{ $user->name }}
                                                </h6>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Email --}}
                                    <td class="email">

                                        {{ $user->email }}

                                    </td>

                                    {{-- Role --}}
                                    <td class="role">

                                        @php
                                            $role = $user->getRoleNames()->first();
                                        @endphp

                                        @if ($role == 'admin')
                                            <span class="badge bg-danger-subtle text-danger">
                                                Admin
                                            </span>
                                        @elseif($role == 'vendor')
                                            <span class="badge bg-info-subtle text-info">
                                                Vendor
                                            </span>
                                        @else
                                            <span class="badge bg-success-subtle text-success">
                                                Customer
                                            </span>
                                        @endif

                                    </td>

                                    {{-- Status --}}
                                    <td class="status">

                                        <span class="badge bg-success-subtle text-success">
                                            Active
                                        </span>

                                    </td>

                                    {{-- Created --}}
                                    <td class="created">

                                        {{ $user->created_at->format('d M, Y') }}

                                    </td>

                                    {{-- Actions --}}
                                    <td>

                                        <ul class="d-flex gap-2 list-unstyled mb-0">

                                            {{-- Edit --}}
                                            <li>

                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-subtle-secondary btn-icon btn-sm edit-item-btn">

                                                    <i class="ph-pencil"></i>

                                                </a>

                                            </li>

                                            {{-- Delete --}}
                                            <li>
                                                <button type="button" class="btn btn-subtle-danger btn-icon btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteUserModal{{ $user->id }}">

                                                    <i class="ph-trash"></i>
                                                </button>
                                            </li>

                                        </ul>

                                    </td>

                                </tr>

                                <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content border-0">

                                            {{-- Header --}}
                                            <div class="modal-header bg-danger-subtle">

                                                <h5 class="modal-title text-danger">
                                                    Delete User
                                                </h5>

                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>

                                            </div>

                                            {{-- Body --}}
                                            <div class="modal-body text-center p-4">

                                                <div class="mb-4">

                                                    <div class="avatar-md mx-auto">

                                                        <div
                                                            class="avatar-title bg-danger-subtle text-danger rounded-circle fs-1">

                                                            <i class="ph-trash"></i>

                                                        </div>

                                                    </div>

                                                </div>

                                                <h4 class="mb-2">
                                                    Are you sure?
                                                </h4>

                                                <p class="text-muted mb-0">

                                                    You are about to delete
                                                    <strong>{{ $user->name }}</strong>.

                                                    This action cannot be undone.

                                                </p>

                                            </div>

                                            {{-- Footer --}}
                                            <div class="modal-footer justify-content-center border-top-0 pb-4">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="ph-trash me-1"></i>
                                                        Yes, Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center py-4">
                                            <i class="ph-users fs-1 text-primary"></i>

                                            <h5 class="mt-2">
                                                No Users Found
                                            </h5>

                                            <p class="text-muted mb-0">
                                                No users available right now.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- No Result --}}
                    <div class="noresult" style="display: none">
                        <div class="text-center py-4">
                            <i class="ph-magnifying-glass fs-1 text-primary"></i>
                            <h5 class="mt-2">
                                Sorry! No Result Found
                            </h5>
                            <p class="text-muted mb-0">
                                No matching users found.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                    <div class="text-muted">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }}
                        of {{ $users->total() }} results
                    </div>
                    <div>
                        {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />
