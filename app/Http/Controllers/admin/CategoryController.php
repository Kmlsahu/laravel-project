<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Category::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('show_in_menu', function ($row) {
                    return ($row->show_in_menu == 1) ? 'Yes' : 'No';
                })
                ->addColumn('products', function ($row) {
                    $product = "";
                    foreach ($row->products as $_product) {
                        $product .= $_product->name . " | ";
                    }
                    return $product;
                })
                ->addColumn('thumbnail_image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('thumbnail_image') . '" width="100px">';
                })
                ->addColumn('category_image', function ($post) {
                    $images = '';
                    foreach ($post->getMedia('image') as $image) {
                        $images .= '<img src="' . $image->getUrl() . '" alt="Image" class="img-fluid" width="100px">';
                    }
                    return $images;
                })
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('category_edit') {
                        $actionBtn = '<a href="' . route('category.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('category_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('category.destroy', $row->id) . '" method="post" style="display: contents;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="delete btn btn-success btn-sm" style="background-color: red;"></i>Delete</button>
                        </form>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'thumbnail_image', 'category_image'])
                ->make(true);
        }
        return view("admin.category.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allcate = Category::where('category_parent_id', 0)->get();

        $products = Product::select('id', 'name')->get();

        return view('admin.category.create', compact('products', 'allcate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            // "category_parent_id" => "required",
            "name" => "required",
            "status" => "required",
            "show_in_menu" => "required",
            "short_description" => "required",
            "description" => "required",
            "url_key" => "unique:categories,url_key",
            "meta_tag" => "required",
            "meta_title" => "required",
            "meta_description" => "required",
        ], [
            // "category_parent_id.required" => "Category Parent Id is required...",
            "name.required" => "Category Name is required...",
            "status.required" => "Status is required...",
            "show_in_menu.required" => "Show In Menu is required...",
            "short_description.required" => "Short Description is required...",
            "description.required" => "Description is required...",
            'url_key.required' => "url_key is required...",
            "meta_tag.required" => "Meta Tag is required...",
            "meta_title.required" => "Meta Title is required...",
            "meta_description.required" => "Meta Description is required...",
        ]);

        $data = $request->all();

        $ctgryPrnt = isset($data['category_parent_id']) ? $data['category_parent_id'] : null;
        $data['category_parent_id'] = $ctgryPrnt ?? 0;


        $url_key = $data['url_key'] ? $data['url_key'] : $data['name'];
        $data['url_key'] = str::lower(str::replace(" ", "-", $url_key));
        $data['name'] = ucwords($data['name']);

        $category = Category::create($data);

        $category->products()->sync($request->products ?? []);


        // Check if 'image' files exist and are valid
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $category->addMedia($image)->toMediaCollection('image');
                }
            }
        }

        // Check if 'thumbnail_image' file exists and is valid
        if ($request->hasFile('thumbnail_image')) {
            $thumbnail_image = $request->file('thumbnail_image');
            if ($thumbnail_image->isValid()) {
                $category->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
            }
        }

        return redirect()->route('category.index')->withSuccess("Category created successfully...");
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

        $category = Category::findOrFail($id);
        $image = $category->getMedia('image');
        $allcate = Category::where('category_parent_id', 0)->get();

        $products = Product::select('id', 'name')->get();
        return view('admin.category.edit', compact('category', 'image', 'products', 'allcate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            // "category_parent_id" => "required",
            "name" => "required",
            "status" => "required",
            "show_in_menu" => "required",
            "short_description" => "required",
            "description" => "required",
            "url_key" => "unique:categories,url_key," . $id,
            "meta_tag" => "required",
            "meta_title" => "required",
            "meta_description" => "required",
        ], [
            // "category_parent_id.required" => "Category Parent Id is required...",
            "name.required" => "Category Name is required...",
            "status.required" => "Status is required...",
            "show_in_menu.required" => "Show In Menu is required...",
            "short_description.required" => "Short Description is required...",
            "description.required" => "Description is required...",
            'url_key.required' => "url_key is required...",
            "meta_tag.required" => "Meta Tag is required...",
            "meta_title.required" => "Meta Title is required...",
            "meta_description.required" => "Meta Description is required...",
        ]);

        $data = $request->all();
        $ctgryPrnt = isset($data['category_parent_id']) ? $data['category_parent_id'] : null;
        $data['category_parent_id'] = $ctgryPrnt ?? 0;

        $name = $request->name;
        $urlKey = $request->url_key;
        $urlKey = $urlKey ? $urlKey : $name;

        $urlKeyLower = Str::lower($urlKey);
        $url_Key = Str::replace(' ', '-', $urlKeyLower);
        $data["url_key"] = $url_Key;

        $data['name'] = ucwords($data['name']);

        $category = Category::findOrFail($id);
        $category->update($data);

        $category->products()->sync($request->products ?? []);
        // Handle image updates
        if ($request->has('remove_image')) {
            foreach ($request->remove_image as $imageId) {
                $category->deleteMedia($imageId);
            }
        }

        // Handle image addition
        if ($request->hasFile('new_image')) {
            foreach ($request->file('new_image') as $image) {
                $category->addMedia($image)->toMediaCollection('image');
            }
        }
        if ($request->has('thumbnail_image')) {
            $category->clearMediaCollection('thumbnail_image');
            $category->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }
        return redirect()->route('category.index')->withSuccess("Category updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $category = Category::findOrFail($id);

        $category->clearMediaCollection('image');
        $category->clearMediaCollection('thumbnail_image');

        $category->delete();
        return redirect()->route('category.index')->withSuccess("Category deleted successfully...");
    }
}
