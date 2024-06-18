<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
       
    }
    public function create()
    {
        $order = order::orderBy('id','DESC')->get();
        return view('admincp.order.form',compact('order'));
    }
    public function order_detail(Request $request)
    {
        $order_detail = json_decode($request->order_detail ,true);
        $product_id = array_keys($order_detail);
        $product = Product::whereIn('id',$product_id)->get();
        return view('admincp.order.list',compact('product','order_detail'));
    }

    public function destroy(string $id)
    {
        order::find($id)->delete();
        return redirect()->back();
    }
}
