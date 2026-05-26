<x-header :meta="array('title'=> $blog->title, 'description'=> \Illuminate\Support\Str::limit(strip_tags($blog->excerpt ?: $blog->body), 160))" />

<main>
    <section class="ko-banner" style="background-image: url('{{ publicPath('images/cart-banner.webp') }}');">
        <div class="ko-container">
            <div class="ko-banner-content">
                <h2>{{ $blog->title }}</h2>
                <p>{{ $blog->category->name ?? 'Blog' }} | {{ $blog->author->name ?? 'Admin' }} | {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</p>
                <nav>
                    <ol class="ko-banner-list">
                        <li><a href="{{ route('view.home') }}">Home</a></li>
                        <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li class="active">{{ $blog->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="ko-blog-single py-5">
        <div class="ko-container">
            <div class="ko-blog-single-content">
                @if($blog->featured_image)
                    <div class="ko-blog-single-img mb-4">
                        <img src="{{ publicPath($blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid" />
                    </div>
                @endif

                <div class="ko-blog-single-meta mb-3">
                    <span class="text-muted">Category: {{ $blog->category->name ?? 'Uncategorized' }}</span>
                    <span class="text-muted ms-3">Author: {{ $blog->author->name ?? 'Admin' }}</span>
                    <span class="text-muted ms-3">Published: {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
                </div>

                <div class="ko-blog-single-body">
                    {!! $blog->body !!}
                </div>
            </div>
        </div>
    </section>
</main>

<x-footer />
