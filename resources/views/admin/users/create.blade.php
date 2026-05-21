{{-- resources/views/admin/users/create.blade.php --}}
{{-- Use same design for edit page also --}}

<x-admin.header :title="'Create User'" />

<x-page-title 
    title="Create User" 
    :breadcrumbs="['Users', 'Create']"
/>

<div class="row">

    <div class="col-12">

        <div class="card border-0 shadow-sm">

            {{-- Header --}}
            <div class="card-header bg-light border-bottom">

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                    <div>

                        <h4 class="card-title mb-1">
                            Create New User
                        </h4>

                        <p class="text-muted mb-0">
                            Add user details and assign role
                        </p>

                    </div>

                    <a href="{{ route('users.index') }}"
                       class="btn btn-light border">

                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                        Back

                    </a>

                </div>

            </div>

            {{-- Body --}}
            <div class="card-body">

                <form action="{{ route('users.store') }}"
                      method="POST">

                    @csrf

                    {{-- Basic Information --}}
                    <div class="mb-4">

                        <h5 class="fs-md mb-3">
                            Basic Information
                        </h5>

                        <div class="row g-3">

                            {{-- Name --}}
                            <div class="col-lg-6">

                                <label class="form-label">
                                    Full Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter full name"
                                       value="{{ old('name') }}">

                                @error('name')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                            {{-- Email --}}
                            <div class="col-lg-6">

                                <label class="form-label">
                                    Email Address
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter email address"
                                       value="{{ old('email') }}">

                                @error('email')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- Security --}}
                    <div class="mb-4">

                        <h5 class="fs-md mb-3">
                            Security & Access
                        </h5>

                        <div class="row g-3">

                            {{-- Password --}}
                            <div class="col-lg-6">

                                <label class="form-label">
                                    Password
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="position-relative">

                                    <input type="password"
                                           name="password"
                                           class="form-control pe-5 @error('password') is-invalid @enderror"
                                           placeholder="Enter password"
                                           id="password">

                                    <button type="button"
                                            class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                            onclick="togglePassword()">

                                        <i class="ri-eye-line fs-lg"
                                           id="passwordIcon"></i>

                                    </button>

                                </div>

                                @error('password')

                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                            {{-- Role --}}
                            <div class="col-lg-6">

                                <label class="form-label">
                                    Select Role
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="role"
                                        class="form-select @error('role') is-invalid @enderror">

                                    <option value="">
                                        Choose Role
                                    </option>

                                    @foreach($roles as $role)

                                        <option value="{{ $role->name }}"
                                            {{ old('role') == $role->name ? 'selected' : '' }}>

                                            {{ ucfirst($role->name) }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('role')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- Footer Buttons --}}
                    <div class="border-top pt-4">

                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('users.index') }}"
                               class="btn btn-light">

                                Cancel

                            </a>

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="ri-save-line align-bottom me-1"></i>
                                Create User

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

    function togglePassword() {

        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            passwordIcon.classList.remove('ri-eye-line');
            passwordIcon.classList.add('ri-eye-off-line');

        } else {

            passwordInput.type = 'password';

            passwordIcon.classList.remove('ri-eye-off-line');
            passwordIcon.classList.add('ri-eye-line');

        }

    }

</script>

<x-admin.footer />