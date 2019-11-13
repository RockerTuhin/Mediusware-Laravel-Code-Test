<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;

class OrderController extends Controller
{
    public function todaysOrders()
    {
    	$date = date('d/m/Y');
    	$todaysOrders = DB::table('orders')
			    	->join('customers','orders.customer_id','customers.id')
			    	->select('orders.*','customers.name')
    				->where('orders.order_date',$date)->orderBy('orders.id','DESC')->get();

    	return response()->json($todaysOrders);
    }

    public function singleOrder($id)
    {
    	$singleOrder = DB::table('orders')
    				   ->join('customers','orders.customer_id','customers.id')
    				   ->select('customers.name','customers.phone','customers.address','orders.*')
    				   ->where('orders.id',$id)
    				   ->first();

    	return response()->json($singleOrder);
    }
    public function singleOrderDetails($id)
    {
    	$singleOrderDetails = DB::table('order_details')
    						  ->join('products','products.id','order_details.product_id')
    						  ->select('products.product_name','products.product_code','products.image','order_details.*')
    						  ->where('order_details.order_id',$id)
    						  ->get();
    	return response()->json($singleOrderDetails);
    }
    public function searchByDate(Request $request)
    {
    	$date = $request->date;
        $obj = new DateTime($date);
        $newdate = $obj->format('d/m/Y');
        $orders = DB::table('orders')
                  ->join('customers','orders.customer_id','customers.id')
                  ->select('customers.name','orders.*')
                  ->where('orders.order_date',$newdate)
                  ->get();

    	return response()->json($orders);
    }
    public function searchByMonth(Request $request)
    {
    	$month = $request->month;
        $orders = DB::table('orders')
                  ->join('customers','orders.customer_id','customers.id')
                  ->select('customers.name','orders.*')
                  ->where('orders.order_month',$month)
                  ->get();
    	return response()->json($orders);
    }
}
