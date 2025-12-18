<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\ProductType;
use App\Enums\ProductVisibility;
use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('categories');

        if ($request->filled('search')) {
            $query->where('product_title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.products.create', [
        'productTypes'       => ProductType::cases(),
        'productStatuses'    => ProductStatus::cases(),
        'productVisibilities'=> ProductVisibility::cases(),
        'categories'         => Category::orderBy('name')->get(),
        'allTags'            => Tag::orderBy('name')->get(),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'categories'        => 'nullable',
            'product_type'      => 'required',
            'short_description' => 'required|string',
            'price'             => 'required|numeric',
            'product_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $mainImagePath = null;
        if ($request->hasFile('product_image')) {
            $mainImagePath = $request->file('product_image')->store('products/main', 'public');
        }

        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products/gallery', 'public');
            }
        }
        $product = new Product();
        $product->product_title        = $validated['title'];
        $product->slug                 = Str::slug($validated['title']);
        $product->product_type         = $validated['product_type'];
        $product->short_description    = $validated['short_description'];
        $product->product_decscription = $request->product_decscription ?? null;
        $product->brand                = $request->brand ?? null;
        $product->exchangeable         = $request->boolean('exchangeable');
        $product->refundable           = $request->boolean('refundable');
        $product->manufacturer_name    = $request->manufacturer_name ?? null;
        $product->manufacturer_brand   = $request->manufacturer_brand ?? null;
        $product->stock                = $request->stock ?? 0;
        $product->price                = $validated['price'];
        $product->discount             = $request->discount ?? 0;
        $product->status               = $request->status ?? null;
        $product->visibility           = $request->visibility ?? null;
        $product->product_image        = $mainImagePath;
        $product->gallery_images       = json_encode($galleryImages);
        $product->save();
        $product->categories()->sync($validated['categories']);
        $product->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('categories');
        return view('admin.products.show', compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product'            => $product,
            'categories'         => Category::all(),
            'productTypes'       => ProductType::cases(),
            'productStatuses'    => ProductStatus::cases(),
            'productVisibilities'=> ProductVisibility::cases(),
            'allTags'            => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'categories'        => 'nullable',
            'product_type'      => 'required',
            'short_description' => 'required|string',
            'price'             => 'required|numeric',
            'product_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
         
        ]);

        if ($request->hasFile('product_image')) {
            $product->product_image = $request->file('product_image')->store('products/main', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $galleryImages = $product->gallery_images ? json_decode($product->gallery_images, true) : [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products/gallery', 'public');
            }
            $product->gallery_images = json_encode($galleryImages);
        }

        $product->product_title        = $validated['title'];
        $product->slug                 = Str::slug($validated['title']);
        $product->product_type         = $validated['product_type'];
        $product->short_description    = $validated['short_description'];
        $product->product_decscription = $request->product_decscription ?? $product->product_decscription;
        $product->brand                = $request->brand ?? $product->brand;
        $product->exchangeable         = $request->boolean('exchangeable');
        $product->refundable           = $request->boolean('refundable');
        $product->manufacturer_name    = $request->manufacturer_name ?? $product->manufacturer_name;
        $product->manufacturer_brand   = $request->manufacturer_brand ?? $product->manufacturer_brand;
        $product->stock                = $request->stock ?? $product->stock;
        $product->price                = $validated['price'];
        $product->discount             = $request->discount ?? $product->discount;
        $product->status               = $request->status ?? $product->status;
        $product->visibility           = $request->visibility ?? $product->visibility;
        $product->save();

        $product->categories()->sync($validated['categories']);
        $product->tags()->sync($request->tags ?? []);
        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Product $product)
    {
        $product->delete(); 
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
