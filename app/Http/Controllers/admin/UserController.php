<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    $role = "";
                    foreach ($row->roles as $_role) {
                        $role .= $_role->name . " | ";
                    }
                    return $role;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('user.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <form action="' . route('user.destroy', $row->id) . '" method="post" style="display: contents;">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="delete btn btn-success btn-sm" style="background-color: red;"></i>Delete</button>
                    </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','roles'])
                ->make(true);
        }
        // $user=User::all();
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles=Role::all();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows('user_create'),403);

           $request->validate([
          
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
    
         ]);
        $user=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)

        ];
       $user= User::create($user);
        $user->syncRoles(($request->input("role")??[]));

        // return redirect()->route('user.index')->WithSuccess("user created successfully..");
        return redirect()->route('user.index')->with('success', "user created successfully...");
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
        $roles=Role::all();
        $user = User::where('id',$id)->first();
        $userole=$user->roles->pluck('id')->toArray();
        return view('admin.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows('user_update'),403);

        $user=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password

        ];
        $user=User::where('id',$id)->update($user);
        $uid=User::find($id);
        $uid->syncRoles(($request->input('roles')??[]));
        return redirect()->route('user.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        User::where('id',$id)->delete();
        return redirect()->route('user.index');
    }
}
