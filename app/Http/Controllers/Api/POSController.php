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
}
