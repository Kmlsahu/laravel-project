<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class Attribute_Value extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("attribute_value_index"), 403);
        if ($request->ajax()) {
            $data = AttributeValue::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('attribute_name', function ($attributeValue) {

                    return optional($attributeValue->attribute)->name;
                })
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('attribute_value_edit') {
                        $actionBtn = '<a href="' . route('attribute_value.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('attribute_value_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('attribute_value.destroy', $row->id) . '" method="post" style="display: contents;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="delete btn btn-success btn-sm" style="background-color: red;"></i>Delete</button>
                        </form>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.attribute_value.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("attribute_value_create"), 403);

        $attribute = Attribute::all();
        $attribute_value = AttributeValue::all();
        return view('admin.attribute_value.create', compact('attribute', 'attribute_value'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("attribute_value_create"), 403);

        $request->validate(
            [
                "attribute_id" => "required",
                "name" => "required",
                "status" => "required"
            ],
            [
                'attribute_id.required' => "Attribute Name is rquired",
                'name.required' => "Name is required....",
                'status.required' => "Status is required...."
            ]
        );

        $data = [
            'attribute_id' => $request->attribute_id,
            'name' => $request->name,
            'status' => $request->status
        ];

        $attribute_value = AttributeValue::create($data);

        return redirect()->route('attribute_value.index')->withSuccess("Attribute Value created successfully...");;
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
        // abort_if(!Gate::allows("attribute_value_edit"), 403);

        $attribute_value = AttributeValue::where('id', $id)->first();
        $attribute = Attribute::all();
        return view('admin.attribute_value.edit', compact('attribute_value', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows("attribute_value_edit"), 403);

        $request->validate(
            [
                "name" => "required",
                "status" => "required"
            ],
            [
                'name.required' => "Name is required....",
                'status.required' => "Status is required...."
            ]
        );

        $data = [
            "attribute_id" => $request->attribute_id,
            "name" => $request->name,
            "status" => $request->status
        ];

        AttributeValue::where('id', $id)->update($data);

        return redirect()->route('attribute_value.index')->withSuccess("Attribute Value updated successfully...");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("attribute_value_delete"), 403);

        AttributeValue::where('id', $id)->delete();

        return redirect()->route('attribute_value.index')->withSuccess("Attribute Value deleted successfully...");
    }
}
