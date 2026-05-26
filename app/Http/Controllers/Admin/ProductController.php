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
use App\Models\ProductVariant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = ProductAttribute::with('values')->get();
        $attributesJson = $attributes->map(function ($a) {
            return [
                'id' => $a->id,
                'name' => $a->name,
                'values' => $a->values->map(function ($v) {
                    return ['id' => $v->id, 'value' => $v->value,];
                })->values(),
            ];
        })->values();

        return view('admin.products.create', [
            'productTypes'       => ProductType::cases(),
            'productStatuses'    => ProductStatus::cases(),
            'productVisibilities' => ProductVisibility::cases(),
            'categories'         => Category::orderBy('name')->get(),
            'allTags'            => Tag::orderBy('name')->get(),
            'attributes'         => $attributes,
            'attributesJson'     => $attributesJson,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* ===============================
        * Single-pass validation
        * =============================== */
        $isSimple   = $request->input('product_type') == ProductType::SIMPLE->value;
        $isVariants = $request->input('product_type') == ProductType::VARIANTS->value;

        $validated = $request->validate([
            // Core
            'title'                => 'required|string|max:255|unique:products,product_title',
            'sku_number'           => 'nullable|string|max:255|unique:products,sku_number',
            'product_type'         => 'required|integer',
            'short_description'    => 'required|string',
            'product_decscription' => 'required|string',

            // Relations
            'categories'           => 'nullable|array',
            'categories.*'         => 'exists:categories,id',
            'tags'                 => 'nullable|array',
            'tags.*'               => 'exists:tags,id',

            // Pricing
            'price'                => 'required|numeric|min:0',
            'discount'             => 'nullable|numeric|min:0|max:100',
            'sell_price'           => 'nullable|numeric|min:0',
            'sell_price_start_date'=> 'nullable|date',
            'sell_price_end_date'  => 'nullable|date|after_or_equal:sell_price_start_date',

            // Shipping
            'weight'               => 'nullable|numeric|min:0',
            'length'               => 'nullable|numeric|min:0',
            'width'                => 'nullable|numeric|min:0',
            'height'               => 'nullable|numeric|min:0',

            // Stock (simple only)
            'stock'                => 'nullable|integer|min:0',
           // 'stock_status'         => 'nullable|string|in:instock,outstock',

            // Images — required only for simple products
            'product_image'        => [
                $isSimple ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'gallery_images'       => 'nullable|array',
            'gallery_images.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            // Variants — required only for variant products
            'product_attributes'          => [$isVariants ? 'required' : 'nullable', 'array', 'min:1'],
            'product_attributes.*'        => 'exists:product_attribute,id',
            'variants'                    => [$isVariants ? 'required' : 'nullable', 'array', 'min:1'],
            'variants.*.values'           => 'nullable|array|min:1',
            'variants.*.values.*'         => 'exists:attribute_values,id',
            'variants.*.sku'              => 'nullable|string|max:255',
            'variants.*.price'            => 'nullable|numeric|min:0',
            'variants.*.stock'            => 'nullable|integer|min:0',
            'variants.*.sell_price'       => 'nullable|numeric|min:0',
            'variants.*.shipping'         => 'nullable|string|max:255',
            'variants.*.shipping_address' => 'nullable|string|max:255',
            'variants.*.general_info'     => 'nullable|string',
            'variants.*.weight'           => 'nullable|numeric|min:0',
            'variants.*.length'           => 'nullable|numeric|min:0',
            'variants.*.width'            => 'nullable|numeric|min:0',
            'variants.*.height'           => 'nullable|numeric|min:0',
            'variants.*.image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'variants.*.exchangeable'     => 'nullable|boolean',
            'variants.*.refundable'       => 'nullable|boolean',
            'variants.*.free_shipping'    => 'nullable|boolean',
        ], [
            'product_image.required'        => 'A product image is required.',
            'product_image.image'           => 'The product image must be a valid image.',
            'product_image.mimes'           => 'The product image must be jpg, jpeg, png, or webp.',
            'product_image.max'             => 'The product image must not exceed 4MB.',
            'product_attributes.required'   => 'At least one attribute is required for variant products.',
            'variants.required'             => 'At least one variant is required for variant products.',
            'variants.*.price.numeric'      => 'Variant price must be a valid number.',
            'variants.*.price.min'          => 'Variant price must be 0 or greater.',
            'variants.*.stock.integer'      => 'Variant stock must be a whole number.',
            'variants.*.stock.min'          => 'Variant stock must be 0 or greater.',
            'variants.*.image.image'        => 'Variant image must be a valid image file.',
            'variants.*.image.mimes'        => 'Variant image must be jpg, jpeg, png, or webp.',
            'variants.*.image.max'          => 'Variant image must not exceed 4MB.',
        ]);

        /* ===============================
        * Build Product
        * =============================== */
        $product = new Product();

        $product->product_title        = $validated['title'];
        $product->slug                 = Str::slug($validated['title']);
        $product->sku_number           = $validated['sku_number'] ?? null;
        $product->product_type         = $validated['product_type'];
        $product->short_description    = $validated['short_description'];
        $product->product_decscription = $validated['product_decscription'];
        $product->status               = $request->input('status', 1);
        $product->visibility           = $request->input('visibility', 1);
        $product->exchangeable         = $request->boolean('exchangeable');
        $product->refundable           = $request->boolean('refundable');
        $product->free_shipping        = $request->boolean('free_shipping');

        if ($isSimple) {
            $product->price                 = $validated['price'];
            $product->discount              = $validated['discount'] ?? 0;
            $product->stock                 = $validated['stock'] ?? 0;
       //    $product->stock_status          = $validated['stock_status'] ?? 'instock';
            $product->sell_price            = $validated['sell_price'] ?? null;
            $product->sell_price_start_date = $validated['sell_price_start_date'] ?? null;
            $product->sell_price_end_date   = $validated['sell_price_end_date'] ?? null;
            $product->weight                = $validated['weight'] ?? null;
            $product->length                = $validated['length'] ?? null;
            $product->width                 = $validated['width'] ?? null;
            $product->height                = $validated['height'] ?? null;
        } else {
            // Variant product — pricing/stock lives on each variant
            $product->price                 = $validated['price'];
            $product->discount              = 0;
            $product->stock                 = 0;
            $product->sell_price            = null;
            $product->sell_price_start_date = null;
            $product->sell_price_end_date   = null;
            $product->weight                = null;
            $product->length                = null;
            $product->width                 = null;
            $product->height                = null;
        }

        // Ensure `product_image` and `gallery_images` are set before inserting (DB requires product_image)
        if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {
            $product->product_image = $request->file('product_image')->store('products', 'public');
        } else {
            $product->product_image = '';
        }

        // Prepare gallery images array if provided
        $gallery = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                if ($image && $image->isValid()) {
                    $gallery[] = $image->store('products/gallery', 'public');
                }
            }
        }
        $product->gallery_images = $gallery;

        $product->save();

        /* ===============================
        * Relations
        * =============================== */
        $product->categories()->sync($validated['categories'] ?? []);
        $product->tags()->sync($validated['tags'] ?? []);

        /* ===============================
        * Variants
        * =============================== */
        if ($isVariants) {
            $product->attributes()->sync($validated['product_attributes'] ?? []);

            // Delete any stale variants (shouldn't exist on create, safe on update)
            $product->variants()->delete();

            foreach (($validated['variants'] ?? []) as $idx => $variant) {
                $pvData = [
                    'product_id'       => $product->id,
                    'sku'              => $variant['sku'] ?? null,
                    'price'            => $variant['price'] ?? 0,
                    'stock'            => $variant['stock'] ?? 0,
                    'sell_price'       => $variant['sell_price'] ?? null,
                    'shipping'         => $variant['shipping'] ?? null,
                    'shipping_address' => $variant['shipping_address'] ?? null,
                    'general_info'     => $variant['general_info'] ?? null,
                    'weight'           => $variant['weight'] ?? null,
                    'length'           => $variant['length'] ?? null,
                    'width'            => $variant['width'] ?? null,
                    'height'           => $variant['height'] ?? null,
                    'status'           => $variant['status'] ?? $product->status,
                    'visibility'       => $variant['visibility'] ?? $product->visibility,
                    'exchangeable'     => isset($variant['exchangeable']) ? (bool)$variant['exchangeable'] : $product->exchangeable,
                    'refundable'       => isset($variant['refundable'])   ? (bool)$variant['refundable']   : $product->refundable,
                    'free_shipping'    => isset($variant['free_shipping']) ? (bool)$variant['free_shipping'] : $product->free_shipping,
                ];

                // Variant image — stored in public disk directly (not Spatie)
                if ($request->hasFile("variants.{$idx}.image")) {
                    $file = $request->file("variants.{$idx}.image");
                    if ($file->isValid()) {
                        $pvData['image'] = $file->store('products/variants', 'public');
                    }
                }

                $pv = ProductVariant::create($pvData);

                if (!empty($variant['values'])) {
                    $pv->attributeValues()->sync($variant['values']);
                }
            }
        } else {
            $product->variants()->delete();
            $product->attributes()->detach();
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

        $attributes = ProductAttribute::with('values')->get();

        $attributesJson = $attributes->map(function ($a) {
            return [
                'id' => $a->id,
                'name' => $a->name,
                'values' => $a->values->map(function ($v) {
                    return ['id' => $v->id, 'value' => $v->value];
                })->values(),
            ];
        })->values();

        $product->load(['variants' => function ($query) {
            $query->with('attributeValues');
        }]);

        $variantsData = $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'name' => $variant->attributeValues->pluck('value')->join(' / ') ?: 'Variant #' . $variant->id,
                'values' => $variant->attributeValues->pluck('id')->toArray(),
                'sku' => $variant->sku,
                'price' => $variant->price,
                'stock' => $variant->stock,
                'sell_price' => $variant->sell_price,
                'shipping' => $variant->shipping,
                'shipping_address' => $variant->shipping_address,
                'general_info' => $variant->general_info,
                'weight' => $variant->weight,
                'length' => $variant->length,
                'width' => $variant->width,
                'height' => $variant->height,
                'exchangeable' => $variant->exchangeable,
                'refundable' => $variant->refundable,
                'free_shipping' => $variant->free_shipping,
                'image' => $variant->image,
            ];
        });

        $variantsJson = json_encode($variantsData);

        return view('admin.products.edit', [
            'product'            => $product,
            'categories'         => Category::all(),
            'productTypes'       => ProductType::cases(),
            'productStatuses'    => ProductStatus::cases(),
            'productVisibilities' => ProductVisibility::cases(),
            'allTags'            => Tag::orderBy('name')->get(),
            'attributes'         => $attributes,
            'attributesJson'     => $attributesJson,
            'variantsJson'       => $variantsJson,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255|unique:products,product_title,' . $product->id,
            'categories'        => 'nullable|array',
            'product_type'      => 'required',
            'short_description' => 'required|string',
            'price'             => 'nullable|numeric',
            'stock'             => 'nullable|integer',
            'product_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $prodType = $validated['product_type'] ?? $request->input('product_type');
        if ($prodType == ProductType::SIMPLE->value || $prodType == ProductType::SIMPLE) {
            $request->validate([
                'price' => 'nullable|numeric|min:0', 
                'stock' => 'required|integer',
            ]);
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

        if ($prodType == ProductType::SIMPLE->value || $prodType == ProductType::SIMPLE) {
            $product->stock    = $validated['stock'];
            $product->price    = $validated['price'] ?? 0;
            $product->discount = $request->discount ?? $product->discount;
        } else {
            $product->stock    = 0;
            $product->price    = 0;
            $product->discount = 0;
        }
        $product->status               = $request->status ?? $product->status;
        $product->visibility           = $request->visibility ?? $product->visibility;
        $product->sell_price           = $request->sell_price ?? $product->sell_price;
        $product->sell_price_start_date = $request->sell_price_start_date ?? $product->sell_price_start_date;
        $product->sell_price_end_date  = $request->sell_price_end_date ?? $product->sell_price_end_date;
        $product->weight               = $request->weight ?? $product->weight;
        $product->length               = $request->length ?? $product->length;
        $product->width                = $request->width ?? $product->width;
        $product->height               = $request->height ?? $product->height;
        $product->save();

        /* ---------- IMAGES (store paths on model) ---------- */
        if ($request->hasFile('product_image')) {
            // delete previous main image from public disk if present
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }

            $path = $request->file('product_image')->store('products', 'public');
            $product->product_image = $path;
            $product->save();
        }

        if ($request->hasFile('gallery_images')) {
            $gallery = $product->gallery_images ?? [];
            foreach ($request->file('gallery_images') as $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('products/gallery', 'public');
                    $gallery[] = $path;
                }
            }
            $product->gallery_images = $gallery;
            $product->save();
        }

        /* ---------- RELATIONS ---------- */
        $product->categories()->sync($validated['categories'] ?? []);
        $product->tags()->sync($request->tags ?? []);

        /* ---------- VARIANTS ---------- */
        if ($prodType == ProductType::VARIANTS->value || $prodType == ProductType::VARIANTS) {
            if ($request->filled('product_attributes')) {
                $product->attributes()->sync($request->product_attributes);
            }

            $product->variants()->delete();
            if ($request->filled('variants') && is_array($request->variants)) {
                foreach ($request->variants as $idx => $variant) {
                    $values = $variant['values'] ?? [];

                    $pvData = [
                        'product_id' => $product->id,
                        'sku'        => $variant['sku'] ?? null,
                        'price'      => $variant['price'] ?? null,
                        'stock'      => $variant['stock'] ?? 0,
                        'sell_price' => $variant['sell_price'] ?? null,
                        'shipping'   => $variant['shipping'] ?? null,
                        'weight'     => $variant['weight'] ?? null,
                        'length'     => $variant['length'] ?? null,
                        'width'      => $variant['width'] ?? null,
                        'height'     => $variant['height'] ?? null,
                        'status'     => $variant['status'] ?? $product->status,
                        'visibility' => $variant['visibility'] ?? $product->visibility,
                        'exchangeable'  => (int) ($variant['exchangeable'] ?? 0),
                        'refundable'    => (int) ($variant['refundable'] ?? 0),
                        'free_shipping' => (int) ($variant['free_shipping'] ?? 0),
                        'shipping_address' => $variant['shipping_address'] ?? null,
                        'general_info'     => $variant['general_info'] ?? null,
                    ];

                    if ($request->hasFile("variants.$idx.image")) {
                        $file = $request->file("variants.$idx.image");
                        if ($file && $file->isValid()) {
                            $pvData['image'] = $file->store('products/variants', 'public');
                        }
                    }

                    $pv = ProductVariant::create($pvData);
                    if (!empty($values)) {
                        $pv->attributeValues()->sync($values);
                    }
                }
            }
        } else {
            $product->variants()->delete();
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function updateVariants(Request $request, Product $product)
    {
        $variants = $request->variants ?? [];

        foreach ($variants as $variantData) {

            $variant = $product->variants()
                ->updateOrCreate(
                    ['id' => $variantData['id'] ?? null],
                    [
                        'sku'           => $variantData['sku'] ?? null,
                        'price'         => $variantData['price'] ?? 0,
                        'stock'         => $variantData['stock'] ?? 0,
                        'sell_price'    => $variantData['sell_price'] ?? null,
                        'weight'        => $variantData['weight'] ?? null,
                        'length'        => $variantData['length'] ?? null,
                        'width'         => $variantData['width'] ?? null,
                        'height'        => $variantData['height'] ?? null,
                        'exchangeable'  => (int) ($variantData['exchangeable'] ?? 0),
                        'refundable'    => (int) ($variantData['refundable'] ?? 0),
                        'free_shipping' => (int) ($variantData['free_shipping'] ?? 0),
                    ]
                );

            if (!empty($variantData['values'])) {
                $variant->attributeValues()->sync($variantData['values']);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Variants updated successfully'
        ]);
    }


    public function removeVariant(Request $request, Product $product)
    {
        $variantId = $request->variant_id;

        $variant = ProductVariant::where('id', $variantId)
            ->where('product_id', $product->id)
            ->firstOrFail();

        if ($variant->image && Storage::disk('public')->exists($variant->image)) {
            Storage::disk('public')->delete($variant->image);
        }

        $variant->delete();

        return response()->json([
            'success' => 'true',
            'variant_id' => $variantId
        ]);
    }

   public function destroy(Product $product)
    {
        $product->delete(); 
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function generateVariants(Request $request)
    {
        $attributes = $request->input('attributes'); 

        if (empty($attributes)) {
            return response()->json(['html' => '']);
        }

        $lists = [];

        foreach ($attributes as $attr) {
            $lists[] = collect($attr['values'])->map(function ($valId) use ($attr) {
                return [
                    'attribute_id' => $attr['attribute_id'],
                    'value_id'     => $valId,
                    'value_name'   => $attr['values_map'][$valId] ?? ''
                ];
            })->toArray();
        }

        // Cartesian product
        $variants = collect($lists)->reduce(function ($carry, $item) {
            if (empty($carry)) return array_map(fn($i) => [$i], $item);

            $result = [];
            foreach ($carry as $c) {
                foreach ($item as $i) {
                    $result[] = array_merge($c, [$i]);
                }
            }
            return $result;
        }, []);

        return response()->json([
            'html' => view('admin.products.partials.variants-html', compact('variants'))->render()
        ]);
    }


    public function userShow(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->where('visibility', 1)
            ->with([
                'categories',
                'tags',
                'variants.attributeValues.attribute'
            ])
            ->firstOrFail();

        return view('user.product.show', compact('product'));
    }
}
