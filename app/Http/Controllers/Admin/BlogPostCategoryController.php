<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogPostCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPostCategory::query();

        if ($request->filled('search')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $categories = $query->latest()->paginate(10)->withQueryString();
        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog.categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|unique:blog_post_categories,name',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        BlogPostCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('blog.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(BlogPostCategory $blog_category)
    {
        return view('admin.blog.categories.edit', ['category' => $blog_category]);
    }

    public function update(Request $request, BlogPostCategory $blog_category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|unique:blog_post_categories,name,' . $blog_category->id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog_category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('blog.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogPostCategory $blog_category)
    {
        $blog_category->delete();
        return redirect()->route('blog.categories.index')->with('success', 'Category deleted successfully.');
    }
}
