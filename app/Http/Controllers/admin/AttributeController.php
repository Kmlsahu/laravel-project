<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("attribute_index"), 403);
        if ($request->ajax()) {
            $data = Attribute::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('attributevalues', function ($row) {
                    $attributevalue = "";
                    foreach ($row->attributevalues as $_attributevalue) {
                        $attributevalue .= $_attributevalue->name . " , ";
                    }
                    return $attributevalue;
                })
                ->addColumn('is_variant', function ($row) {
                    return ($row->is_variant == 1) ? 'Yes' : 'No';
                })
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('attribute_edit') {
                        $actionBtn = '<a href="' . route('attribute.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('attribute_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('attribute.destroy', $row->id) . '" method="post" style="display: contents;">
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
        return view('admin.attribute.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("attribute_create"), 403);

        $attributevalues = AttributeValue::select('id', 'name')->get();
        return view('admin.attribute.create', compact('attributevalues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("attribute_create"), 403);
        $data = $request->validate([
            "name" => "required",
            "name_key" => "required",
            "is_variant" => "required",
            "status" => "required",
        ], [
            "name.required" => "Name is required...",
            "name_key.required" => "Name Key is required...",
            "is_variant.required" => "Is Variant is required...",
            "status.required" => "Status is required...",
        ]);

        // Create the main attribute
        $attribute = Attribute::create($data);
        $attributeId = $attribute->id;

        $atrname = $request->atrname;
        $status1 = $request->status1;

        foreach ($atrname as $key => $name) {
            $status = $status1[$key] ?? 0;

            if (!empty($name)) {
                AttributeValue::create([
                    'attribute_id' => $attributeId,
                    'name' => $name,
                    'status' => $status
                ]);
            }
        }

        $attribute->attributeValues()->sync($request->attributeValues ?? []);

        return redirect()->route('attribute.index')->withSuccess("Attribute created successfully..");
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
        abort_if(!Gate::allows("attribute_edit"), 403);

        $attribute = Attribute::where('id', $id)->first();
        $attributevalues = AttributeValue::select('id', 'name')->get();
        return view('admin.attribute.edit', compact('attribute', compact('attributevalues')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows("attribute_edit"), 403);

        $data = $request->validate([
            "name" => "required",
            "name_key" => "required",
            "is_variant" => "required",
            "status" => "required",
        ], [
            "name.required" => "Name is required...",
            "name_key.required" => "Name Key is required...",
            "is_variant.required" => "Is Variant is required...",
            "status.required" => "Status is required...",
        ]);

        $attribute = Attribute::where('id', $id)->update($data);

        $attributeId = $request->a_id ?? [];
        $atrname = $request->atrname ?? [];
        $status = $request->status1 ?? [];

        if (empty($attributeId)) {
            AttributeValue::where('attribute_id', $id)->delete();
        } else {
            AttributeValue::where('attribute_id', $id)
                ->whereNotIn('id', $attributeId)
                ->delete();
        }

        foreach ($atrname as $key => $atr_name) {
            $aId = $attributeId[$key] ?? null;
            $atr_status = $status[$key] ?? null;

            if (!$atr_name) {
                continue;
            }

            if ($aId) {
                AttributeValue::where('id', $aId)->update([
                    'name' => $atr_name,
                    'status' => $atr_status,
                ]);
            } else {
                AttributeValue::create([
                    'attribute_id' => $id,
                    'name' => $atr_name,
                    'status' => $atr_status,
                ]);
            }
        }

        $attribute->attributeValues()->sync($request->attributeValues ?? []);
        return redirect()->route('attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("attribute_delete"), 403);

        AttributeValue::where('attribute_id', $id)->delete();
        Attribute::where('id', $id)->delete();
        return redirect()->route('attribute.index')->withSuccess('Attribute delete successfully..');
    }
}
