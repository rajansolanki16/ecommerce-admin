<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogAuthor;
use App\Models\BlogPost;
use App\Models\BlogPostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author']);

        if ($request->filled('search')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogPostCategory::all();
        $authors = BlogAuthor::all();

        return view('admin.blog.posts.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|unique:blog_posts,title',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'category_id' => 'required|exists:blog_post_categories,id',
            'author_id' => 'required|exists:blog_authors,id',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['title', 'excerpt', 'body', 'category_id', 'author_id', 'status', 'published_at']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        BlogPost::create($data);
        return redirect()->route('blog.posts.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog_post)
    {
        $categories = BlogPostCategory::all();
        $authors = BlogAuthor::all();

        return view('admin.blog.posts.edit', [
            'post' => $blog_post,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }

    public function update(Request $request, BlogPost $blog_post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|unique:blog_posts,title,' . $blog_post->id,
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'category_id' => 'required|exists:blog_post_categories,id',
            'author_id' => 'required|exists:blog_authors,id',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['title', 'excerpt', 'body', 'category_id', 'author_id', 'status', 'published_at']);
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $blog_post->update($data);

        return redirect()->route('blog.posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog_post)
    {
        $blog_post->delete();
        return redirect()->route('blog.posts.index')->with('success', 'Blog post deleted successfully.');
    }
}
