<?php

// use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    //For Registration
    Route::post('signup', 'AuthController@signup');

});


Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');
Route::apiResource('/customer','Api\CustomerController');

Route::post('/pay-salary/{id}','Api\SalaryController@pay_salary');
Route::get('/all-salary','Api\SalaryController@allSalary');
Route::get('/monthly-salary/{month}','Api\SalaryController@monthlySalary');
Route::get('/edit-salary/{id}','Api\SalaryController@editSalary');
Route::post('/update-salary/{id}','Api\SalaryController@updateSalary');
Route::post('/update-stock/{id}','Api\SalaryController@updateStock');
Route::get('/categorywise-product/{id}','Api\POSController@categoryWiseProduct');
Route::get('/add-to-cart/{id}/{user_id}','Api\CartController@addToCart');
Route::get('/show-cart','Api\CartController@showCart');
Route::get('/remove-from-cart/{id}/{user_id}','Api\CartController@removeFromCart');
Route::get('/increment-quantity/{id}/{user_id}','Api\CartController@incrementQuantity');
Route::get('/decrement-quantity/{id}/{user_id}','Api\CartController@decrementQuantity');

