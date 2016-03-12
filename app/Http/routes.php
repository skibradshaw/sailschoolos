<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'auth',function () {
    //return "Hello World";
    $employee_count = App\Employee::all()->count('id');
    $student_count = App\Student::all()->count('id');
    $buyer_count = App\Buyer::all()->count('id');
    $seller_count = App\Seller::all()->count('id');
    $charter_guest_count = App\CharterGuest::all()->count('id');
    return view('index',[
    	'title' => 'Dashboard',
    	'employee_count' => $employee_count,
    	'student_count' => $student_count,
    	'buyer_count' => $buyer_count,
    	'seller_count' => $seller_count,
    	'charter_guest_count' => $charter_guest_count
    	]);
}]);
/**
 * Login Routes
 */
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Inquiry Routes
Route::get('/inquiries',['as' => 'inquiries','uses' => 'InquiryController@index']);
Route::get('/inquiries/create',['as' => 'inquiry.create','uses' =>'InquiryController@create']);
Route::post('inquiries/create',['as' => 'inquiry.store', 'uses' => 'InquiryController@store']);
Route::post('inquiries/web',['as' => 'inquiry.storeweb', 'uses' => 'InquiryController@storeWeb']);
Route::get('/inquiries/{$id}',['as' => 'inquiry.show','uses' => 'InquiryController@show']);

//Admin Routes
Route::get('test_schedules/{template}','ResponseScheduleController@create');
Route::get('admin/response_schedules',['as' => 'admin.respsone_schedules','uses' => 'ResponseScheduleController@index']);

//Route Resources
Route::resource('contacts','ContactController');
Route::resource('students','StudentController');
Route::resource('admin/response_templates','ResponseTemplateController');