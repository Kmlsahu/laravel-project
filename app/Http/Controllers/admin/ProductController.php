<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\ProductAttribute;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('categories', function ($row) {
                    $category = "";
                    foreach ($row->categories as $_category) {
                        $category .= $_category->name . " | ";
                    }
                    return $category;
                })
                ->addColumn('is_featured', function ($row) {
                    return ($row->is_featured == 1) ? 'Yes' : 'No';
                })
                ->addColumn('stock_status', function ($row) {
                    return ($row->stock_status == 1) ? 'In Stock' : 'Out of Stock';
                })
                ->addColumn('thumbnail_image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('thumbnail_image') . '" width="100px">';
                })
                ->addColumn('product_image', function ($post) {
                    $images = '';
                    foreach ($post->getMedia('image') as $image) {
                        $images .= '<img src="' . $image->getUrl() . '" alt="Image" class="img-fluid" width="100px">';
                    }
                    return $images;
                })

                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('product_edit') {
                        $actionBtn = '<a href="' . route('product.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('product_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('product.destroy', $row->id) . '" method="post" style="display: contents;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="delete btn btn-success btn-sm" style="background-color: red;"></i>Delete</button>
                        </form>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'product_image', 'thumbnail_image'])
                ->make(true);
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::all();
        $attributes = Attribute::all();
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('product', 'categories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
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
            "related_product" => "required",
            "url_key" => "unique:products,url_key",
            "meta_tag" => "required",
            "meta_title" => "required",
            "meta_description" => "required",
        ], [
            "name.required" => "Category Name is required...",
            "status.required" => "Status is required...",
            "is_featured.required" => "Is Featured is required...",
            "sku.required" => "Sku is required...",
            "qty.required" => "Qty is required...",
            "stock_status.required" => "Stock Status is required...",
            "weight.required" => "Weight is required...",
            "price.required" => "Price is required...",
            "special_price.required" => "Special Price is required...",
            "special_price_from.required" => "Special Price From is required...",
            "special_price_to.required" => "Special Price To is required...",
            "short_description.required" => "Short Description is required...",
            "description.required" => "Description is required...",
            "related_product.required" => "Related Product is required...",
            'url_key.required' => "url_key is required...",
            "meta_tag.required" => "Meta Tag is required...",
            "meta_title.required" => "Meta Title is required...",
            "meta_description.required" => "Meta Description is required...",
        ]);

        // $data = $request->all();

        $url_key = $data['url_key'] ? $data['url_key'] : $data['name'];
        $data['url_key'] = Str::lower(Str::replace(" ", "-", $url_key));
        $data['name'] = ucwords($data['name']);

        $data['related_product'] = implode(' , ', $request->related_product ?? []);

        $product = Product::create($data);

        $productId = $product->id;
        // $attributesId = $request->input('attribute', []);
        $attributeValuesId = $request->input('attributevalue', []);

        // foreach ($attributesId as $attributeId) {
        // if (isset($attributeValuesId[$attributeId])) {
        foreach ($attributeValuesId as $key => $attributeValueId) {
            $attrival = AttributeValue::where('id', $attributeValueId)->first();
            if ($attrival) {
                ProductAttribute::create([
                    'product_id' => $productId,
                    'attribute_id' => $attrival->attribute_id,
                    'attribute_value_id' => $attributeValueId
                ]);
            }
        }
        // }
        // }

        $product->categories()->sync($request->categories ?? []);

        // Handle multiple images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $product->addMedia($image)->toMediaCollection('image');
                } else {
                    // Handle invalid image file
                    // For example, log an error or return an error response
                    // Log::error('Invalid image file: ' . $image->getClientOriginalName());
                    // return response()->json(['error' => 'Invalid image file'], 400);
                }
            }
        }

        // Handle thumbnail image
        if ($request->hasFile('thumbnail_image')) {
            $thumbnail_image = $request->file('thumbnail_image');
            if ($thumbnail_image->isValid()) {
                $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
            } else {
                // Handle invalid thumbnail image file
                // For example, log an error or return an error response
                // Log::error('Invalid thumbnail image file: ' . $thumbnail_image->getClientOriginalName());
                // return response()->json(['error' => 'Invalid thumbnail image file'], 400);
            }
        }

        return redirect()->route('product.index')->withSuccess("Product created successfully...");
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
        $product = Product::findOrFail($id);

        $relatedproduct = Product::all();
        $image = $product->getMedia('image');
        $categories = Category::select('id', 'name')->get();

        $attributes = Attribute::all();
        $productAttributes = ProductAttribute::where('product_id', $id)->get();

        return view('admin.product.edit', compact('product', 'image', 'categories', 'attributes', 'productAttributes', 'relatedproduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
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
        ], [
            "name.required" => "Category Name is required...",
            "status.required" => "Status is required...",
            "is_featured.required" => "Is Featured is required...",
            "sku.required" => "Sku is required...",
            "qty.required" => "Qty is required...",
            "stock_status.required" => "Stock Status is required...",
            "weight.required" => "Weight is required...",
            "price.required" => "Price is required...",
            "special_price.required" => "Special Price is required...",
            "special_price_from.required" => "Special Price From is required...",
            "special_price_to.required" => "Special Price To is required...",
            "short_description.required" => "Short Description is required...",
            "description.required" => "Description is required...",
            // "related_product.required" => "Related Product is required...",
            'url_key.required' => "url_key is required...",
            "meta_tag.required" => "Meta Tag is required...",
            "meta_title.required" => "Meta Title is required...",
            "meta_description.required" => "Meta Description is required...",
        ]);

        // $data = $request->all();

        $name = $request->name;
        $urlKey = $request->url_key;
        $urlKey = $urlKey ? $urlKey : $name;

        $urlKeyLower = Str::lower($urlKey);
        $url_Key = Str::replace(' ', '-', $urlKeyLower);
        $data["url_key"] = $url_Key;

        $data['name'] = ucwords($data['name']);

        $data['related_product'] = implode(' , ', $request->related_product ?? []);
        
        $product = Product::where('id', $id)->update($data);

        $product = Product::findOrFail($id);

        ProductAttribute::where('product_id', $id)->delete();

        // $attributesId = $request->input('attribute', []);
        $attributeValuesId = $request->input('attributevalue', []);

        foreach ($attributeValuesId as $key => $attributeValueId) {
            $attrival = AttributeValue::where('id', $attributeValueId)->first();
            if ($attrival) {
                ProductAttribute::create([
                    'product_id' => $id,
                    'attribute_id' => $attrival->attribute_id,
                    'attribute_value_id' => $attributeValueId
                ]);
            }
        }

        $product->categories()->sync($request->categories ?? []);
        // Handle image updates
        if ($request->has('remove_image')) {
            foreach ($request->remove_image as $imageId) {
                $product->deleteMedia($imageId);
            }
        }

        // Handle image addition
        if ($request->hasFile('new_image')) {
            foreach ($request->file('new_image') as $image) {
                $product->addMedia($image)->toMediaCollection('image');
            }
        }
        if ($request->has('thumbnail_image')) {
            $product->clearMediaCollection('thumbnail_image');
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }
        return redirect()->route('product.index')->withSuccess("Product updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Product::where('id', $id)->delete();

        $product = Product::findOrFail($id);

        $productAttributes = ProductAttribute::where('product_id', $id)->delete();
        // Clear the 'image' and 'thumbnail_image' media collections
        $product->clearMediaCollection('image');
        $product->clearMediaCollection('thumbnail_image');

        // Optionally, you can do additional cleanup or operations here

        // Delete the product
        $product->delete();

        return redirect()->route('product.index')->withSuccess("Product deleted successfully...");
    }
}
