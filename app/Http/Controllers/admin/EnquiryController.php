<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::all();
        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required",
            // "phone" => "required",
            "subject" => 'required',
            "message" => 'required',
        ]);
        $enquiry = Enquiry::create($data);
        return redirect("contact")->with("success", "Data submit Successfully");
    }

    public function status(string $id)
    {

        Enquiry::where('id', $id)->update(['status' => 2]);

        return redirect()->back();
    }

    public function destroy($id) {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();
        return back();

    }
}
