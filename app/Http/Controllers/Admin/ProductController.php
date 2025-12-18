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
  public function index()
{
    $products = Product::with('categories')->latest()->paginate(10);

    return view('admin.products.index', compact('products'));
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
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'title'             => 'required|string|max:255',
            'categories'        => 'required|array',
            'categories.*'      => 'exists:categories,id',
            'product_type'      => 'required|in:0,1',
            'short_description' => 'required|string',
            'price'             => 'required|numeric',
           'product_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::transaction(function () use ($request) {

            /** 🔹 MAIN IMAGE */
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
            

            /** 🔹 CREATE PRODUCT */
            $product = Product::create([
                'product_title'        => $request->title,
                'slug'                 => Str::slug($request->title),
                'product_type'         => $request->product_type === 'simple' ? 0 : 1,
                'short_description'    => $request->short_description,
                'product_decscription' => $request->product_description,
                'brand'                => $request->brand,
                'exchangeable'         => $request->boolean('exchangeable'),
                'refundable'           => $request->boolean('refundable'),
                'manufacturer_name'    => $request->manufacturer_name,
                'manufacturer_brand'   => $request->manufacturer_brand,
                'stock'                => $request->stock,
                'price'                => $request->price,
                'discount'             => $request->discount,
                'status'               => $request->status,
                'visibility'           => $request->visibility,
                'product_image'        => $mainImagePath,
                'gallery_images'       => json_encode($galleryImages),
            ]);

            /** 🔹 SYNC CATEGORIES */
            $product->categories()->sync($request->categories);

            /** 🔹 HANDLE TAGS (Choices.js) */
            if ($request->filled('tags')) {
                $tags = collect(explode(',', $request->tags))
                    ->map(fn ($tag) => trim($tag))
                    ->filter()
                    ->map(function ($tagName) {
                        return Tag::firstOrCreate(['name' => $tagName])->id;
                    });

                $product->tags()->sync($tags);
            }
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
