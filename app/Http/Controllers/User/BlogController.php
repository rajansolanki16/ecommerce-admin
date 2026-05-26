<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::with(['category', 'author'])
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('blogs', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = BlogPost::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('blog-detail', compact('blog'));
    }
}
