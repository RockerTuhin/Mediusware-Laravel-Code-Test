<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SalaryController extends Controller
{

    public function pay_salary(Request $request,$id)
    {

    	$request->validate([
    		'salary_month' => 'required',
    		'salary_amount' => 'required',
    	]);
    	$month = $request->salary_month;
    	$check = DB::table('salaries')->where('employee_id',$id)->where('salary_month',$month)->first();
    	if($check)
    	{
    		return 'salaryError';
    	}
    	else
    	{
    		$data = array();
	    	$data['employee_id'] = $id;
	    	$data['salary_month'] = $month;
	    	$data['salary_amount'] = $request->salary_amount;
	    	$data['salary_date'] = date('d/m/Y');
	    	$data['salary_year'] = date('Y');

	    	DB::table('salaries')->insert($data);
    	}

    }

    public function allSalary()
    {
    	$allSalary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();

    	return response()->json($allSalary);

    }

    public function monthlySalary($month)
    {
    	$monthlySalary = DB::table('salaries')
    					 ->join('employees','salaries.employee_id','employees.id')
    					 ->select('salaries.*','employees.name','employees.photo')
    					 ->where('salaries.salary_month',$month)
    					 ->get();

    	return response()->json($monthlySalary);
    }

    public function editSalary($id)
    {
    	$salary = DB::table('salaries')
    			  ->join('employees','employees.id','salaries.employee_id')
    			  ->select('salaries.*','employees.name','employees.salary')
    			  ->where('salaries.id',$id)
    			  ->first();

    	return response()->json($salary);
    }

    public function updateSalary(Request $request,$id)
    {
    	$request->validate([
    		'salary_month' => 'required',
    		'salary_amount' => 'required',
    	]);
    	$data = array();
    	$data['salary_month'] = $request->salary_month;
    	$data['salary_amount'] = $request->salary_amount;

    	DB::table('salaries')->where('id',$id)->update($data);
    }

    public function updateStock(Request $request,$id)
    {
    	$request->validate([
    		'product_quantity' => 'required',
    	]);

    	$data = array();
    	$data['product_quantity'] = $request->product_quantity;

    	DB::table('products')->where('id',$id)->update($data);

    }

}
