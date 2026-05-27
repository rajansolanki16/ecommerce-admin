<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with(['user', 'product'])->latest()->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(string $id)
    {
        $review = ProductReview::findOrFail($id);
        $review->update(['is_approved' => true]);
        return redirect()->route('reviews.index')->with('success', 'Review approved successfully.');
    }

    public function reject(string $id)
    {
        $review = ProductReview::findOrFail($id);
        $review->update(['is_approved' => false]);
        return redirect()->route('reviews.index')->with('success', 'Review rejected.');
    }

    public function destroy(string $id)
    {
        $review = ProductReview::findOrFail($id);
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
