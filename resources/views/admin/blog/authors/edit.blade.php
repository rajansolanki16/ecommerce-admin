<x-admin.header :title="'Edit Blog Author'" />

<x-page-title title="Edit Author" :breadcrumbs="['Blog', 'Authors', 'Edit']" />

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('blog.authors.update', $author->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Author Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $author->email) }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" name="website" id="website" value="{{ old('website', $author->website) }}" class="form-control @error('website') is-invalid @enderror">
                        @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea name="bio" id="bio" rows="4" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $author->bio) }}</textarea>
                        @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Author</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />
