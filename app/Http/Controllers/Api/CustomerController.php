<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
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
            'phone' => 'required|unique:customers',
            'address' => 'required',
        ]);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        
        if($request->photo)
        {
            $position = strpos($request->photo,';');
            $substring = substr($request->photo,0,$position);
            $explodeArray = explode('/',$substring);
            $extension = $explodeArray[1];
            $name = time().".".$extension;
            $uploadPath = 'backend/customer/';
            $imageURL = $uploadPath.$name;
            // create instance
            $img = Image::make($request->photo)->resize(300, 200);

            $success = $img->save($imageURL);
            if($success)
            {
                $customer->photo = $imageURL;
                $customer->save();
            }
        }
        else 
        {
            $customer->save();
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
        $customer = Customer::findorfail($id);
        return response()->json($customer);
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
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
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

            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;

            $success = $img->save($image_url);

            if($success)
            {

                $data['photo'] = $image_url;
                $oldEmployee = DB::table('customers')->where('id',$id)->first();
                $oldPhotoPath = $oldEmployee->photo;
                unlink($oldPhotoPath);

                DB::table('customers')->where('id',$id)->update($data);
            }
        }
        else
        {
            $data['photo'] = $request->photo;
            DB::table('customers')->where('id',$id)->update($data);
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
        $customer = Customer::findorfail($id);
        $photo = $customer->photo;
        if($photo)
        {
            unlink($photo);
            Customer::where('id',$id)->delete();
        }
        else
        {
            Customer::where('id',$id)->delete();
        }
    }
}
