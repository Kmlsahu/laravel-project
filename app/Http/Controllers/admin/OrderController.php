<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // abort_unless(Gate::allows('order_index'), 403);

        if ($request->ajax()) {
            $data = Order::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    // Show button
                    $actionBtn .= '<a href="' . route('order.show', $row->id) . '" class="btn btn-info btn-sm" style="width: 70px; height: 30px;"><i class="fa fa-eye"></i> Show</a>';

                    // Generate Invoice button
                    $actionBtn .= '<a href="' . route('order.invoice', $row->id) . '" class="btn btn-warning btn-sm custom-btn"><i class="fa fa-download"></i> Generate Invoice</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // $orders = Order::all();
        return view('admin.order.index');
        // return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        // abort_unless(Gate::allows('order_show'), 403);
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('admin.order.show', compact('order', 'billingAddress', 'shippingAddress', 'orderItems'));
    }

    public function generateInvoice($id)
    {
        // echo $id;
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        $pdf = Pdf::loadView('admin.invoices.order-invoice', compact('order' ,'billingAddress', 'shippingAddress', 'orderItems'));
        return $pdf->download($order->order_increment_id .".pdf");

    }
}
