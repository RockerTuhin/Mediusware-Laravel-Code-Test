<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use DB;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('suppliers','products.supplier_id','suppliers.id')
                    ->select('products.*','categories.category_name','suppliers.name')
                    ->orderBy('products.id','DESC')
                    ->get();

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        if($request->image)
        {
            $position = strpos($request->image, ';');
            $substring = substr($request->image, 0 , $position);
            $extensionArray = explode('/', $substring);
            $extension = $extensionArray[1];
            $name = time().".".$extension;
            // create instance
            $img = Image::make($request->image)->resize(300, 200);
            $uploadPath = 'backend/product/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $product = new Product;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image = $imageURL;
            $product->save();
        }
        else
        {
            $product = new Product;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buing_date = $request->buing_date;
            $product->product_quantity = $request->product_quantity;
            $product->save();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id',$id)->first();

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        $product = Product::findorfail($id);

        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;

        $newphoto = $request->new_photo;

        if($newphoto)
        {
            $position = strpos($newphoto, ';');
            $substring = substr($newphoto, 0 , $position);
            $extensionArray = explode('/', $substring);
            $extension = $extensionArray[1];
            $name = time().".".$extension;
            // create instance
            $img = Image::make($newphoto)->resize(300, 200);
            $uploadPath = 'backend/product/';
            $imageURL = $uploadPath.$name;
            $success = $img->save($imageURL);

            if($success)
            {
                $oldProduct = Product::findorfail($id);

                $oldPhotoPath = $oldProduct->image;
                unlink($oldPhotoPath);
                
                $product->image = $imageURL;
                $product->save();
            }
        }
        else
        {
            $product->image = $request->image;
            
            $product->save();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $image = $product->image;

        if($image)
        {
            unlink($image);
            DB::table('products')->where('id',$id)->delete();
        }
        else
        {
             DB::table('products')->where('id',$id)->delete();
        }
    }
}
