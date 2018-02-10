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
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {


    /**
     * Login Routes
     */
    Auth::routes();
    // Route::get('/login', 'Auth\AuthController@getLogin');
    // Route::post('/login', 'Auth\AuthController@postLogin');
    // Route::get('/logout', 'Auth\AuthController@getLogout');

    // // Password reset link request routes...
    // Route::get('password/email', 'Auth\PasswordController@getEmail');
    // Route::post('password/email', 'Auth\PasswordController@postEmail');

    // // Password reset routes...
    // Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    // Route::post('password/reset', 'Auth\PasswordController@postReset');
    // Store Web Inquiries
    Route::post('inquiries/web', ['as' => 'inquiry.storeweb', 'uses' => 'InquiryController@storeWeb']);


    /*
    |------------------------------------
    | Login Required Routes 
    |------------------------------------
     */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', function () {
            //return "Hello World";
            $employee_count = App\Employee::all()->count('id');
            $student_count = App\Student::all()->count('id');
            $buyer_count = App\Buyer::all()->count('id');
            $seller_count = App\Seller::all()->count('id');
            $charter_guest_count = App\CharterGuest::all()->count('id');
            return view('index', [
                'title' => 'Dashboard',
                'employee_count' => $employee_count,
                'student_count' => $student_count,
                'buyer_count' => $buyer_count,
                'seller_count' => $seller_count,
                'charter_guest_count' => $charter_guest_count
                ]);
        });


        //Inquiry Routes
        Route::get('/inquiries', ['as' => 'inquiries','uses' => 'InquiryController@index']);
        Route::get('/inquiries/create', ['as' => 'inquiry.create','uses' =>'InquiryController@create']);
        Route::post('inquiries/create', ['as' => 'inquiry.store', 'uses' => 'InquiryController@store']);
        Route::get('/inquiries/{$id}', ['as' => 'inquiry.show','uses' => 'InquiryController@show']);

        //Admin Routes
        Route::get('test_schedules/{template}', 'ResponseScheduleController@create');
        Route::get('admin/response_schedules', ['as' => 'admin.respsone_schedules','uses' => 'ResponseScheduleController@index']);
        Route::get('admin/response_schedules/{schedule}/send', ['as' => 'admin.respsone_schedules.send','uses' => 'ResponseScheduleController@send']);
        Route::get('admin/response_schedules/{schedule}/delete', ['as' => 'admin.response_schedules.delete','uses' => 'ResponseScheduleController@delete']);
        Route::get('admin/response_schedules/{template}/{contacts}/delete', ['as' => 'admin.response_schedules.deleteall','uses' => 'ResponseScheduleController@deleteAll']);
        Route::get('admin/response_schedules/{template}/{contacts}/update', ['as' => 'admin.response_schedules.update','uses' => 'ResponseScheduleController@changeStatus']);

        //Task APIs
        //Reorder Template Task List
        Route::post('admin/project_templates/{project_templates}/task_lists/{task_lists}/reorder', ['as' => 'admin.project_templates.task_lists.reorder','uses' => 'ProjectTemplateTaskListController@reorder']);
        Route::get('admin/project_templates/{project_templates}/task_lists/{task_lists}/delete', ['as' => 'admin.project_templates.task_lists.destroy','uses' => 'ProjectTemplateTaskListController@destroy']);

        //Route Resources
        Route::resource('contacts', 'ContactController');
        Route::resource('students', 'StudentController');
        Route::resource('contacts.notes', 'NoteController');
        Route::resource('admin/response_templates', 'ResponseTemplateController');
        Route::resource('admin/project_templates', 'ProjectTemplateController');
        Route::resource('admin/project_templates.task_lists', 'ProjectTemplateTaskListController', ['except' => ['destroy']]);
        Route::resource('admin/project_templates.task_lists.tasks', 'ProjectTemplateTaskController');
    });
    // End Login Required
});
