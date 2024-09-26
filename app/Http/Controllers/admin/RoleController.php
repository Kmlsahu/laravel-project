<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("role_index"), 403);

        if ($request->ajax()) {
            $data = Role::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function ($row) {
                    $permission = "";
                    foreach ($row->permissions as $_permission) {
                        $permission .= $_permission->name . " | ";
                    }
                    return $permission;
                })
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('role_edit') {
                        $actionBtn = '<a href="' . route('role.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('role_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('role.destroy', $row->id) . '" method="post" style="display: contents;">
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
        return view("admin.role.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("role_create"), 403);
        $permissions = Permission::all();
        return view("admin.role.create", compact("permissions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("role_create"), 403);
        $request->validate(
            [
                "name" => "required",
            ],
            [
                "name" => "Name is required...",
            ]
        );

        $role = [
            "name" => $request->name,
        ];

        $role = Role::create($role);

        $role->syncPermissions(($request->input("permissions") ?? []));

        return redirect()->route("role.index")->withSuccess("Role created successfully...");
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
        // abort_if(!Gate::allows("role_edit"), 403);
        $permissions = Permission::all();

        $role = Role::where('id', $id)->first();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows("role_edit"), 403);
        $request->validate([

            "name" => "required",
        ], [

            'name.required' => " name required...",
        ]);

        $role = [
            "name" => $request->name,
        ];

        $role =  Role::where("id", $id)->update($role);

        $uid =  Role::find($id);
        $uid->syncPermissions(($request->input("permissions") ?? []));
        return redirect()->route('role.index')->withSuccess("Role updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("role_delete"), 403);
        Role::where('id', $id)->delete();
        return redirect()->route('role.index')->withSuccess("Role deleted successfully...");
    }
}
