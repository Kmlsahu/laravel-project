<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->with('categories', 'media')->get();
        return response()->json($products);
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
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "status" => "required",
            "is_featured" => "required",
            "sku" => "required",
            "qty" => "required",
            "stock_status" => "required",
            "weight" => "required",
            "price" => "required",
            "special_price" => "required",
            "special_price_from" => "required",
            "special_price_to" => "required",
            "short_description" => "required",
            "description" => "required",
            // "related_product" => "required",
            "url_key" => "unique:products,url_key",
            "meta_tag" => "required",
            "meta_title" => "required",
            "meta_description" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        $url_key = $data['url_key'] ? $data['url_key'] : $data['name'];
        $data['url_key'] = Str::lower(Str::replace(" ", "-", $url_key));
        $data['name'] = ucwords($data['name']);
        // $data['related_product'] = implode(' , ', $request->related_product ?? []);

        $product = Product::create($data);

      

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $product->addMedia($image)->toMediaCollection('image');
                }
            }
        }

        if ($request->hasFile('thumbnail_image')) {
            $thumbnail_image = $request->file('thumbnail_image');
            if ($thumbnail_image->isValid()) {
                $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
            }
        }

        return response()->json($product, 201);
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
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "status" => "required",
            "is_featured" => "required",
            "sku" => "required",
            "qty" => "required",
            "stock_status" => "required",
            "weight" => "required",
            "price" => "required",
            "special_price" => "required",
            "special_price_from" => "required",
            "special_price_to" => "required",
            "short_description" => "required",
            "description" => "required",
            "url_key" => "unique:products,url_key," . $id,
            "meta_tag" => "required",
            "meta_title" => "required",
            "meta_description" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        $url_key = $data['url_key'] ? $data['url_key'] : $data['name'];
        $data['url_key'] = Str::lower(Str::replace(" ", "-", $url_key));
        $data['name'] = ucwords($data['name']);
        // $data['related_product'] = implode(' , ', $request->related_product ?? []);

        $product = Product::findOrFail($id);
        $product->update($data);

        

        if ($request->hasFile('new_image')) {
            foreach ($request->file('new_image') as $image) {
                if ($image->isValid()) {
                    $product->addMedia($image)->toMediaCollection('image');
                }
            }
        }

        if ($request->hasFile('thumbnail_image')) {
            $product->clearMediaCollection('thumbnail_image');
            $thumbnail_image = $request->file('thumbnail_image');
            if ($thumbnail_image->isValid()) {
                $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
            }
        }

        return response()->json($product, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Delete its associated product attributes
        $productAttributes = ProductAttribute::where('product_id', $id)->delete();

        // Clear the 'image' and 'thumbnail_image' media collections
        $product->clearMediaCollection('image');
        $product->clearMediaCollection('thumbnail_image');

        // Delete the product
        $product->delete();

        // Return a success response
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
