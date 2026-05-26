<x-admin.header :title="'Edit Blog Post'" />

<x-page-title title="Edit Post" :breadcrumbs="['Blog', 'Posts', 'Edit']" />

<div class="row">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('blog.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control @error('title') is-invalid @enderror">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="category_id">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="author_id">Author <span class="text-danger">*</span></label>
                            <select name="author_id" id="author_id" class="form-control @error('author_id') is-invalid @enderror">
                                <option value="">Select author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $post->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="excerpt">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="body">Body <span class="text-danger">*</span></label>
                            <textarea name="body" id="body" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body', $post->body) }}</textarea>
                            @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="published_at">Published At</label>
                            <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" class="form-control @error('published_at') is-invalid @enderror">
                            @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="featured_image">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control @error('featured_image') is-invalid @enderror">
                            @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            @if($post->featured_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="Featured image" class="img-fluid rounded" style="max-height: 120px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />
