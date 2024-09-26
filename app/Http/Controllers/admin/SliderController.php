<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_if(!Gate::allows("slider_index"), 403);

        if ($request->ajax()) {
            $data = Slider::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? 'Enable' : 'Disable';
                })
                ->addColumn('slider_image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('image') . '" width="100px">';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $actionBtn = '';
                    if ('slider_edit') {
                        $actionBtn = '<a href="' . route('slider.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    }
                    if ('slider_delete') {
                        $actionBtn = $actionBtn .
                            '<form action="' . route('slider.destroy', $row->id) . '" method="post" style="display: contents;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="delete btn btn-success btn-sm" style="background-color: red;"></i>Delete</button>
                        </form>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'slider_image'])
                ->make(true);
        }

        return view("admin.slider.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::allows("slider_create"), 403);

        return view("admin.slider.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_if(!Gate::allows("slider_create"), 403);

        $request->validate([

            "title" => "required",
            "ordering" => "required",
            "status" => "required",
        ], [

            'title.required' => " title required...",
            'ordering.required' => "ordering is required...",
            'status.required' => "status is required...",
        ]);

        $input = $request->all();
        $client = Slider::create($input);
        if ($request->has('image')) {
            $client->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('slider.index')->withSuccess("Slider created successfully...");
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
        // abort_if(!Gate::allows("slider_edit"), 403);

        $slider = Slider::where("id", $id)->first();
        return view("admin.slider.edit", compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_if(!Gate::allows("slider_edit"), 403);

        $request->validate([

            "title" => "required",
            "ordering" => "required",
            "status" => "required",
        ], [

            'title.required' => " title required...",
            'ordering.required' => "ordering is required...",
            'status.required' => "status is required...",
        ]);
        $data = [
            "title" => $request->title,
            "ordering" => $request->ordering,
            "status" => $request->status
        ];
        $slider = Slider::where("id", $id)->update($data);
        $image = Slider::find($id);
        if ($request->has('image')) {
            $image->clearMediaCollection('image');
            $image->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route("slider.index")->withSuccess("Slider updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!Gate::allows("slider_delete"), 403);

        // Slider::where('id', $id)->delete();

        $slider = Slider::findOrFail($id);

        $slider->clearMediaCollection('image');

        $slider->delete();
        return redirect()->route('slider.index')->withSuccess("Slider deleted successfully...");
    }
}
