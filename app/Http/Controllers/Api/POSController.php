<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class POSController extends Controller
{
    public function categoryWiseProduct($id)
    {
    	$categoryWiseProduct = DB::table('products')->where('category_id',$id)->get();
    	return response()->json($categoryWiseProduct);
    }
    public function vats()
    {
    	$vats = DB::table('extras')->first();
    	return response()->json($vats);
    }
    public function orderDone(Request $request)
    {
    	$request->validate([
    		'customer_id' => 'required',
    		'payBy' => 'required',
    	]);
    	$odata = array();
    	$odata['customer_id'] = $request->customer_id;
    	$odata['total_quantity'] = $request->totalQuantity;
    	$odata['subtotal'] = $request->totalSubtotal;
    	$odata['vat'] = $request->vat;
    	$odata['total'] = $request->total;
    	$odata['pay'] = $request->pay;
    	$odata['due'] = $request->due;
    	$odata['payby'] = $request->payBy;
    	$odata['order_date'] = date('d/m/Y');
    	$odata['order_month'] = date('F');
    	$odata['order_year'] = date('Y');

    	$order_id = DB::table('orders')->insertGetId($odata);

    	$carts = DB::table('carts')->where('user_id',$request->user_id)->get();

    	$oddata = array();
    	foreach($carts as $cart)
    	{
    		$oddata['order_id'] = $order_id;
    		$oddata['product_id'] = $cart->product_id;
    		$oddata['product_quantity'] = $cart->product_quantity;
    		$oddata['product_price'] = $cart->product_price;
    		$oddata['subtotal'] = $cart->subtotal;

    		DB::table('order_details')->insert($oddata);

    		DB::table('products')
    			->where('id',$cart->product_id)
    			->update(['product_quantity' => DB::raw('product_quantity -' .$cart->product_quantity )]);
    	}
    	DB::table('carts')->delete();
    }
    public function todaySell()
    {
        $date = date('d/m/Y');
        $sell = DB::table('orders')->where('order_date',$date)->sum('total');
        return response()->json($sell);
    }
    public function todayIncome()
    {
        $date = date('d/m/Y');
        $income = DB::table('orders')->where('order_date',$date)->sum('pay');
        return response()->json($income);
    }
    public function todayDue()
    {
        $date = date('d/m/Y');
        $due = DB::table('orders')->where('order_date',$date)->sum('due');
        return response()->json($due);
    }
    public function todayExpense()
    {
        $date = date('d/m/Y');
        $expense = DB::table('expenses')->where('expense_date',$date)->sum('amount');
        return response()->json($expense);
    }
    public function stockoutProducts()
    {
        $stockout_products = DB::table('products')->where('product_quantity','<',1)->get();
        return response()->json($stockout_products);
    }
}
