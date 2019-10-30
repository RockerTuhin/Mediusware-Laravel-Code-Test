<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id,$user_id)
    {
    	$product = DB::table('products')->where('id',$id)->first();
    	$check = DB::table('carts')->where(['product_id'=>$id,'user_id'=>$user_id])->first();
    	if($check)
    	{
    		DB::table('carts')->where(['product_id'=>$id,'user_id'=>$user_id])->increment('product_quantity');
    		
    		$subtotal = $check->product_price * $check->product_quantity;

    		DB::table('carts')->where(['product_id'=>$id,'user_id'=>$user_id])->update(['subtotal'=>$subtotal]);
    	}
    	else
    	{
    		$data = array();
	    	$data['product_id'] = $id;
	    	$data['user_id'] = $user_id;
	    	$data['product_name'] = $product->product_name;
	    	$data['product_quantity'] = 1;
	    	$data['product_price'] = $product->selling_price;
	    	$data['subtotal'] = $product->selling_price;

	    	DB::table('carts')->insert($data);
    	}
    }

    public function showCart()
    {
    	$carts = DB::table('carts')->get();
    	return response()->json($carts);
    }

    public function removeFromCart($id,$user_id)
    {
    	DB::table('carts')->where(['id'=>$id,'user_id'=>$user_id])->delete();

    }

    public function incrementQuantity($id,$user_id)
    {
    	DB::table('carts')->where('id',$id)->increment('product_quantity');

    	$cart = DB::table('carts')->where(['id'=>$id,'user_id'=>$user_id])->first();

    	$subtotal = $cart->product_price * $cart->product_quantity;

    	DB::table('carts')->where(['id'=>$id,'user_id'=>$user_id])->update(['subtotal'=>$subtotal]);

    }

    public function decrementQuantity($id,$user_id)
    {
    	DB::table('carts')->where(['id'=>$id,'user_id'=>$user_id])->decrement('product_quantity');
    	$cart = DB::table('carts')->where(['id'=>$id,'user_id'=>$user_id])->first();
    	$subtotal = $cart->product_quantity * $cart->product_price;

    	DB::table('carts')->where(['id'=>$id,'user_id'=>$user_id])->update(['subtotal' => $subtotal]);

    }

}
