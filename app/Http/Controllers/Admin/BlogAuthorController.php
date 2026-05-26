<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogAuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogAuthor::withCount('posts');

        if ($request->filled('search')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $authors = $query->latest()->paginate(10)->withQueryString();
        return view('admin.blog.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.blog.authors.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:blog_authors,email',
            'website' => 'nullable|url',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $author = BlogAuthor::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'bio' => $request->bio,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('blog.authors.index');
    }

    public function edit(BlogAuthor $blog_author)
    {
        return view('admin.blog.authors.edit', ['author' => $blog_author]);
    }

    public function update(Request $request, BlogAuthor $blog_author)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:blog_authors,email,' . $blog_author->id,
            'website' => 'nullable|url',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog_author->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'bio' => $request->bio,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('blog.authors.index');
    }

    public function destroy(BlogAuthor $blog_author)
    {
        $blog_author->delete();
        return redirect()->route('blog.authors.index');
    }
}
