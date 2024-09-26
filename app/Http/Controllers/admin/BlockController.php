<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("block_index"), 403);
        if ($request->ajax()) {
            $data = Block::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('block_image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('image') . '" width="100px">';
                })
                ->addColumn('action', function ($row) use ($user){
                    $actionBtn = '';
                    if (('block_edit')) {
                        $actionBtn = '<a href="' . route('block.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if (('block_delete')) {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('block.destroy', $row->id) . '" method="post" style="display: contents;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="delete btn btn-success btn-sm" style="background-color: red;"></i>Delete</button>
                        </form>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'block_image'])
                ->make(true);
        }
        return view("admin.block.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("block_create"), 403);

        return view("admin.block.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("block_create"), 403);

        $request->validate([

            "identifier" => "required",
            "title" => "required",
            "heading" => "required",
            "description" => "required",
            "ordering" => "required",
            "status" => "required",
        ], [

            'identifier.required' => "identifier required...",
            'title.required' => "title required...",
            'heading.required' => "heading is required...",
            'description.required' => "description is required...",
            'ordering.required' => "ordering is required...",
            'status.required' => "status is required...",
        ]);

        $input = $request->all();
        $client = Block::create($input);
        if ($request->has('image')) {
            $client->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('block.index')->withSuccess("Block created successfully...");
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
        // abort_if(!Gate::allows("block_edit"), 403);

        $block = Block::where("id", $id)->first();
        return view("admin.block.edit", compact("block"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows("block_edit"), 403);


        $request->validate([

            "identifier" => "required",
            "title" => "required",
            "heading" => "required",
            "description" => "required",
            "ordering" => "required",
            "status" => "required",
        ], [

            'identifier.required' => "identifier required...",
            'title.required' => "title required...",
            'heading.required' => "heading is required...",
            'description.required' => "description is required...",
            'ordering.required' => "ordering is required...",
            'status.required' => "status is required...",
        ]);

        $data = [
            "identifier" => $request->identifier,
            "title" => $request->title,
            "heading" => $request->heading,
            "description" => $request->description,
            "ordering" => $request->ordering,
            "status" => $request->status,
        ];
        $block = Block::where("id", $id)->update($data);
        $image = Block::find($id);
        if ($request->has('image')) {
            $image->clearMediaCollection('image');
            $image->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route("block.index")->withSuccess("Block updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("block_delete"), 403);

        // Block::where('id', $id)->delete();

        $block = Block::findOrFail($id);

        $block->clearMediaCollection('image');

        $block->delete();
        return redirect()->route('block.index')->withSuccess("Block deleted successfully...");
    }
}
