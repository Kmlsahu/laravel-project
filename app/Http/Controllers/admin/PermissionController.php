<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("permission_index"), 403);
        if ($request->ajax()) {
            $data = Permission::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('permission_edit') {
                        $actionBtn = '<a href="' . route('permission.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('permission_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('permission.destroy', $row->id) . '" method="post" style="display: contents;">
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
        return view("admin.permission.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("permission_create"), 403);
        return view("admin.permission.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("permission_create"), 403);
        $request->validate(
            [
                "name" => "required",
            ],
            [
                "name" => "Name is required...",
            ]
        );

        // $permission = [
        //     "name" => $request->name,
        // ];

        $pname = $request->name;

        foreach ($pname as $key => $permissionname) {

            if (empty($permissionname)) {
                return redirect()->route('permission.index');
            } else {
                Permission::create([
                    'name' => $permissionname ?? NULL,
                ]);
            }
        }

        // Permission::create($permission);
        return redirect()->route("permission.index")->withSuccess("Permission created successfully...");
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
        // abort_if(!Gate::allows("permission_edit"), 403);
        $permission = Permission::where('id', $id)->first();
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows("permission_edit"), 403);
        $request->validate([

            "name" => "required",
        ], [

            'name.required' => " name required...",
        ]);

        $permission = [
            "name" => $request->name,
        ];
        Permission::where("id", $id)->update($permission);
        return redirect()->route('permission.index')->withSuccess("Permission updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("permission_delete"), 403);
        Permission::where('id', $id)->delete();
        return redirect()->route('permission.index')->withSuccess("Permission deleted successfully...");
    }
}
