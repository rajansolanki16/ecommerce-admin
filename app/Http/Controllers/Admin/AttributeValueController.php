<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
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
        $validator = Validator::make($request->all(), [
            'value' => 'required|unique:attribute_values,value'
        ], [
            'value.required' => 'The attribute value field is required.',
            'value.unique' => 'This attribute value already exists.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        $attributeValue = new AttributeValue();
        $attributeValue->product_attribute_id = $request->product_attribute_id;
        $attributeValue->value = $request->value;
        $attributeValue->slug = Str::slug($request->value);
        $attributeValue->save();

        return response()->json([
            'id' => $attributeValue->id,
            'value' => $attributeValue->value,
            'attribute' => $attributeValue->productAttribute->name,
        ]);
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
        $edit_value = AttributeValue::findOrFail($id);
        $attribute = ProductAttribute::with('values')->findOrFail($edit_value->product_attribute_id);
        return response()->json([
            'id' => $edit_value->id,
            'value' => $edit_value->value,
            'product_attribute_id' => $edit_value->product_attribute_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $valueModel = AttributeValue::findOrFail($id);

        $rules = [
            'value' => 'required|max:255|unique:attribute_values,value,' . $id . ',id,product_attribute_id,' . $valueModel->product_attribute_id,
        ];

        $messages = [
            'value.required' => 'The attribute value field is required.',
            'value.unique' => 'This attribute value already exists.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity for validation errors
        }

        $valueModel->value = $request->value;
        $valueModel->slug  = Str::slug($request->value);
        $valueModel->save();

        return response()->json([
            'id' => $valueModel->id,
            'value' => $valueModel->value,
            'attribute' => $valueModel->attribute->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attributeValue = AttributeValue::find($id);
        $attributeValue->delete();
        return redirect()->back()->with('success', 'Attribute value deleted successfully.');
    }
}
