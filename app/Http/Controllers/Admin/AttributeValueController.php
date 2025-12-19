<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute_values;
use App\Models\Product_Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'value' => 'required|unique:attribute_values,value'
        ];

        $messages = [
            'value.required' => 'The attribute value field is required.',
            'value.unique' => 'This attribute value is already exist'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $attributeValue = new Attribute_values();
        $attributeValue->product_attribute_id = $request->product_attribute_id;
        $attributeValue->value = $request->value;
        $attributeValue->slug = Str::slug($request->value);
        $attributeValue->save();


        if ($attributeValue) {
            return redirect()->back()->with('success', 'Attribute value added successfully.');
        }

        return redirect()->back()
            ->withErrors(['attribute_values' => 'Unable to add attribute value.'])
            ->withInput();
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

        $edit_value = Attribute_values::findOrFail($id);

        $attribute = Product_Attribute::with('values')
            ->findOrFail($edit_value->product_attribute_id);

        return view(
            'admin.productattribute.edit',
            compact('attribute', 'edit_value')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $valueModel = Attribute_values::findOrFail($id);

        $rules = [
            'value' => 'required|max:255|unique:attribute_values,value,' . $id . ',id,product_attribute_id,' . $valueModel->product_attribute_id,
        ];

        $messages = [
            'value.required' => 'The attribute value field is required.',
            'value.unique' => 'This attribute value already exists.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $valueModel->value = $request->value;
        $valueModel->slug  = Str::slug($request->value);
        $valueModel->save();

        return redirect()
            ->route('product_attributes.edit', $valueModel->product_attribute_id)
            ->with('success', 'Attribute value updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $attributeValue = Attribute_values::find($id);
        $attributeValue->delete();
        return redirect()->back()->with('success', 'Attribute value deleted successfully.');
    }
}
