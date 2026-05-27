<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|unique:brands',
            'description' => 'nullable|min:5',
            'is_active' => 'nullable|boolean'
        ];
        $messages = [
            'name.required' => 'Brand name is required.',
            'name.min' => 'Brand name must be at least 3 characters.',
            'name.unique' => 'This brand name already exists.',
            'description.min' => 'Description must be at least 5 characters.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description ?? null;
        $brand->is_active = $request->has('is_active') ? 1 : 0;
        $brand->save();

        if ($brand) {
            return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
        } else {
            return redirect()->back()
                ->withErrors(['brand' => 'Unable to create the brand.'])
                ->withInput();
        }
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
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|min:3|unique:brands,name,' . $id,
            'description' => 'nullable|min:5',
            'is_active' => 'nullable|boolean'
        ];
        $messages = [
            'name.required' => 'Brand name is required.',
            'name.min' => 'Brand name must be at least 3 characters.',
            'name.unique' => 'This brand name already exists.',
            'description.min' => 'Description must be at least 5 characters.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description ?? null;
        $brand->is_active = $request->has('is_active') ? 1 : 0;
        $brand->save();

        if ($brand) {
            return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
        } else {
            return redirect()->back()->withErrors(['brand' => 'Unable to update the brand.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
