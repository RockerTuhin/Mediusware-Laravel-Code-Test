<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allEmployee = Employee::all();

        return response()->json($allEmployee);
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

            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;

            $img->save($image_url);

            $employee = new Employee;

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joiningDate;
            $employee->photo = $image_url;

            $employee->save();

        }
        else
        {
            $employee = new Employee;

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joiningDate;

            $employee->save();
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

        $employee = DB::table('employees')->where('id',$id)->first();

        //dd($employee);

        return response()->json($employee);

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
        $data['salary'] = $request->salary;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;

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

            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;

            $success = $img->save($image_url);

            if($success)
            {

                $data['photo'] = $image_url;
                $oldEmployee = DB::table('employees')->where('id',$id)->first();
                $oldPhotoPath = $oldEmployee->photo;
                unlink($oldPhotoPath);

                DB::table('employees')->where('id',$id)->update($data);
            }
        }
        else
        {
            $data['photo'] = $request->photo;
            DB::table('employees')->where('id',$id)->update($data);
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

        $employee = DB::table('employees')->where('id',$id)->first();

        $photo = $employee->photo;

        if($photo)
        {
            unlink($photo);
            DB::table('employees')->where('id',$id)->delete();
        }
        else{
             DB::table('employees')->where('id',$id)->delete();
        }

    }
}
