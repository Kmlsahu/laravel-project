<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\JobRetryRequested;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("coupon_index"), 403);
        if ($request->ajax()) {
            $data = Coupon::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('coupon_edit') {
                        $actionBtn = '<a href="' . route('coupon.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('coupon_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('coupon.destroy', $row->id) . '" method="post" style="display: contents;">
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
        return view('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("coupon_create"), 403);
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("coupon_create"), 403);

        $data = $request->validate([
            "title" => "required",
            "status" => "required",
            "coupon_code" => "required",
            "valid_from" => "required",
            "valid_to" => "required",
            "discount_amount" => "required",
        ], [
            "title.required" => "Title is required...",
            "status.required" => "Status is required...",
            "coupon_code.required" => "Coupon Code is required...",
            "valid_from.required" => "Valid From is required...",
            "valid_to.required" => "Valid To is required...",
            "discount_amount.required" => "Discount Amount is required...",
        ]);

        $coupon = Coupon::create($data);
        return redirect()->route('coupon.index')->withSuccess("Coupon created successfully...");
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
        // abort_if(!Gate::allows("coupon_edit"), 403);

        $coupon = Coupon::where('id', $id)->first();
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows("coupon_edit"), 403);

        $data = $request->validate([
            "title" => "required",
            "status" => "required",
            "coupon_code" => "required",
            "valid_from" => "required",
            "valid_to" => "required",
            "discount_amount" => "required",
        ], [
            "title.required" => "Title is required...",
            "status.required" => "Status is required...",
            "coupon_code.required" => "Coupon Code is required...",
            "valid_from.required" => "Valid From is required...",
            "valid_to.required" => "Valid To is required...",
            "discount_amount.required" => "Discount Amount is required...",
        ]);

        $coupon = Coupon::where('id', $id)->update($data);
        return redirect()->route('coupon.index')->withSuccess("Coupon updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("coupon_delete"), 403);

        Coupon::where('id', $id)->delete();
        return redirect()->route('coupon.index')->withSuccess("Coupon deleted successfully...");
    }
}
