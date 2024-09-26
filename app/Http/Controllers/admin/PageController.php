<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("page_index"), 403);
        if ($request->ajax()) {
            $data = Page::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('page_image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('image') . '" width="100px">';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('page_edit') {
                        $actionBtn = '<a href="' . route('page.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('page_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('page.destroy', $row->id) . '" method="post" style="display: contents;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="delete btn btn-success btn-sm" style="background-color: red;"></i>Delete</button>
                        </form>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'page_image'])
                ->make(true);
        }
        return view("admin.page.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("page_create"), 403);
        return view("admin.page.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("page_create"), 403);
        $data = $request->validate([

            "title" => "required",
            "heading" => "required",
            "description" => "required",
            "ordering" => "required",
            "status" => "required",
            "url_key" => "unique:pages",
        ], [

            'title.required' => " title required...",
            'heading.required' => "heading is required...",
            'description.required' => "description is required...",
            'ordering.required' => "ordering is required...",
            'status.required' => "status is required...",
            'url_key.required' => "url_key is required...",
        ]);

        $url_key = $data['url_key'] ? $data['url_key'] : $data['title'];
        $data['url_key'] = str::lower(str::replace(" ", "-", $url_key));
        $data['title'] = ucwords($data['title']);


        $page = Page::create($data);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $page->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('page.index')->withSuccess("Page created successfully...");
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
        // abort_if(!Gate::allows("page_edit"), 403);
        $page = Page::where("id", $id)->first();
        return view("admin.page.edit", compact("page"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token', '_method');
        $data =  $request->validate([

            "title" => "required",
            "heading" => "required",
            "description" => "required",
            "ordering" => "required",
            "status" => "required",
            "url_key" => "unique:pages,url_key," . $id,
        ], [

            'title.required' => " title required...",
            'heading.required' => "heading is required...",
            'description.required' => "description is required...",
            'ordering.required' => "ordering is required...",
            'status.required' => "status is required...",
            'url_key.required' => "url_key is required...",
        ]);
        $title = $request->title;
        $urlKey = $request->url_key;
        $urlKey = $urlKey ? $urlKey : $title;

        $urlKeyLower = Str::lower($urlKey);
        $url_Key = Str::replace(' ', '-', $urlKeyLower);
        $data["url_key"] = $url_Key;

        $data['title'] = ucwords($data['title']);

        $page = Page::findOrFail($id);
        $page->update($data);
        if ($request->hasFile('image')) {
            $page->clearMediaCollection('image');
            $page->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('page.index')->with('success', 'Data Upadate Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("page_delete"), 403);
        // Page::where('id', $id)->delete();

        $page = Page::findOrFail($id);

        $page->clearMediaCollection('image');

        $page->delete();
        return redirect()->route('page.index')->withSuccess("Page deleted successfully...");
    }
}
