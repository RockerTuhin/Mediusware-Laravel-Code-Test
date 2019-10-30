<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Supplier;
use DB;
use Illuminate\Http\Request;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $suppliers = Supplier::all();

        return response()->json($suppliers);

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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if($request->photo)
        {

            $position = strpos($request->photo,';');
            $substring = substr($request->photo,0,$position);
            $explode_array = explode('/',$substring);
            $extension = $explode_array[1];

            $name = time().".".$extension;

            $img = Image::make($request->photo);// create instance From intervention image package
            $img->resize(300, 200);// resize image to fixed size From intervention image package

            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;

            $img->save($image_url);

            $supplier = new Supplier;

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->photo = $image_url;

            $supplier->save();

        }
        else
        {
            $supplier = new Supplier;

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;

            $supplier->save();
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
        $supplier = DB::table('suppliers')->where('id',$id)->first();

        //dd($supplier);

        return response()->json($supplier);
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
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shopname'] = $request->shopname;

        $newImage = $request->new_photo;

        if($newImage)
        {
            $position = strpos($newImage,';');
            $substring = substr($newImage,0,$position);
            $explode_array = explode('/',$substring);
            $extension = $explode_array[1];

            $name = time().".".$extension;

            $img = Image::make($newImage);// create instance From intervention image package
            $img->resize(300, 200);// resize image to fixed size From intervention image package

            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;

            $success = $img->save($image_url);

            if($success)
            {

                $data['photo'] = $image_url;
                $oldSupplier = DB::table('suppliers')->where('id',$id)->first();
                $oldPhotoPath = $oldSupplier->photo;
                unlink($oldPhotoPath);

                DB::table('suppliers')->where('id',$id)->update($data);
            }
        }
        else
        {
            $data['photo'] = $request->photo;
            DB::table('suppliers')->where('id',$id)->update($data);
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
        $supplier = DB::table('suppliers')->where('id',$id)->first();

        $photo = $supplier->photo;

        if($photo)
        {
            unlink($photo);
            DB::table('suppliers')->where('id',$id)->delete();
        }
        else{
             DB::table('suppliers')->where('id',$id)->delete();
        }
    }
}
