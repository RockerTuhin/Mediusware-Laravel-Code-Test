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
Route::get('/vats','Api\POSController@vats');
Route::post('/orderdone','Api\POSController@orderDone');
Route::get('/todays-orders','Api\OrderController@todaysOrders');
Route::get('/single-order/{id}','Api\OrderController@singleOrder');
Route::get('/single-order-details/{id}','Api\OrderController@singleOrderDetails');
Route::post('/search-by-date','Api\OrderController@searchByDate');
Route::post('/search-by-month','Api\OrderController@searchByMonth');
Route::get('/today-sell','Api\POSController@todaySell');
Route::get('/today-income','Api\POSController@todayIncome');
Route::get('/today-due','Api\POSController@todayDue');
Route::get('/today-expense','Api\POSController@todayExpense');
Route::get('/stockout-products','Api\POSController@stockoutProducts');

