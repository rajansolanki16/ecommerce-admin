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
use App\Models\ProductAttribute;
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
            'attributes'        =>  ProductAttribute::with('values')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                     => 'required|string|max:255',
            'sku_number'                => 'nullable|string|max:255|unique:products,sku_number',

            'categories'                => 'nullable|array',
            'categories.*'              => 'exists:categories,id',

            'tags'                      => 'nullable|array',
            'tags.*'                    => 'exists:tags,id',

            'product_type'              => 'required|integer',
            'short_description'         => 'nullable|string',

            'price'                     => 'required|numeric|min:0',
            'discount'                  => 'nullable|numeric|min:0',

            'sell_price'                => 'nullable|numeric|min:0',
            'sell_price_start_date'     => 'nullable|date',
            'sell_price_end_date'       => 'nullable|date|after_or_equal:sell_price_start_date',

            'weight'                    => 'nullable|numeric|min:0',
            'length'                    => 'nullable|numeric|min:0',
            'width'                     => 'nullable|numeric|min:0',
            'height'                    => 'nullable|numeric|min:0',

            'product_image'             => 'required|image|mimes:jpg,jpeg,png,webp',
            'gallery_images.*'          => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        /* ===============================
        Upload Images
        =============================== */

        $mainImagePath = null;
        if ($request->hasFile('product_image')) {
            $mainImagePath = $request->file('product_image')
                ->store('products/main', 'public');
        }

        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products/gallery', 'public');
            }
        }

        /* ===============================
        Create Product
        =============================== */

        $product = new Product();

        $product->product_title        = $validated['title'];
        $product->slug                 = Str::slug($validated['title']);
        $product->sku_number           = $validated['sku_number'] ?? null;

        $product->product_type         = $validated['product_type'];
        $product->short_description    = $validated['short_description'];
        $product->product_decscription = $request->product_decscription;

        $product->brand                = $request->brand;
        $product->manufacturer_name    = $request->manufacturer_name;
        $product->manufacturer_brand   = $request->manufacturer_brand;

        $product->exchangeable         = $request->boolean('exchangeable');
        $product->refundable           = $request->boolean('refundable');
        $product->free_shipping        = $request->boolean('free_shipping');

        $product->stock                = $request->stock ?? 0;

        $product->price                = $validated['price'];
        $product->discount             = $validated['discount'] ?? 0;

        $product->sell_price           = $validated['sell_price'] ?? null;
        $product->sell_price_start_date= $validated['sell_price_start_date'] ?? null;
        $product->sell_price_end_date  = $validated['sell_price_end_date'] ?? null;

        $product->weight               = $validated['weight'] ?? null;
        $product->length               = $validated['length'] ?? null;
        $product->width                = $validated['width'] ?? null;
        $product->height               = $validated['height'] ?? null;

        $product->status               = $request->status ?? 1;
        $product->visibility           = $request->visibility ?? 1;

        $product->product_image        = $mainImagePath;
        $product->gallery_images       = $galleryImages;

        $product->save();

        /* ===============================
        Sync Relations
        =============================== */

        if (!empty($validated['categories'])) {
            $product->categories()->sync($validated['categories']);
        }

        if ($request->filled('tags')) {
            $product->tags()->sync($request->tags);
        }

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
            'categories'        => 'nullable|array',
            'product_type'      => 'required',
            'short_description' => 'required|string',
            'price'             => 'required|numeric',
            'stock'             => 'required|in:0,1',
            'product_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        /* ---------- MAIN IMAGE ---------- */
        if ($request->hasFile('product_image')) {
            $product->product_image = $request
                ->file('product_image')
                ->store('products/main', 'public');
        }

        /* ---------- GALLERY IMAGES ---------- */
        if ($request->hasFile('gallery_images')) {
            $galleryImages = $product->gallery_images ?? [];

            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products/gallery', 'public');
            }

            $product->gallery_images = $galleryImages;
        }

        /* ---------- PRODUCT DATA ---------- */
        $product->product_title        = $validated['title'];
        $product->slug                 = Str::slug($validated['title']);
        $product->product_type         = $validated['product_type'];
        $product->short_description    = $validated['short_description'];
        $product->product_decscription = $request->product_decscription ?? $product->product_decscription;

        $product->exchangeable         = $request->boolean('exchangeable');
        $product->refundable           = $request->boolean('refundable');
        $product->free_shipping        = $request->boolean('free_shipping');

        $product->stock                = $validated['stock']; 
        $product->price                = $validated['price'];
        $product->discount             = $request->discount ?? $product->discount;
        
        $product->status               = $request->status ?? $product->status;
        $product->visibility           = $request->visibility ?? $product->visibility;

        $product->sell_price           = $request->sell_price ?? $product->sell_price;
        $product->sell_price_start_date= $request->sell_price_start_date ?? $product->sell_price_start_date;
        $product->sell_price_end_date  = $request->sell_price_start_date ?? $product->sell_price_start_date;

        $product->weight               = $request->weight ?? $product->weight;
        $product->length               = $request->length ?? $product->length;
        $product->width                = $request->width ?? $product->width;
        $product->height               = $request->height ?? $product->height;
        $product->save();

        /* ---------- RELATIONS ---------- */
        $product->categories()->sync($validated['categories'] ?? []);
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
