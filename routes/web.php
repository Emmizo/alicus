<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
/* Auth controller*/
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'AuthController@index')->name('admin-login');
    Route::post('/admin-login', 'AuthController@login')->name('admin-login-post');
    Route::get('/forgot-password', 'PasswordController@index')->name('forgot-password');
    Route::post('/forgot-password', 'PasswordController@store')->name('forgot-password-post');
    Route::get('/reset-password/{token}', 'PasswordController@viewReset')->name('reset-password');
    Route::get('/reset/{id}', 'PasswordController@Reset')->name('reset');
    Route::post('/reset-password', 'PasswordController@storePassword')->name('reset-password-post');
    Route::post('/reset', 'PasswordController@storePasswordReset')->name('reset-post');
    
});
#Profile module
Route::group(['prefix' => '/users', 'middleware' => ['auth','nocache'],'namespace' => 'App\Http\Controllers'], function () {
    Route::post('update-profile', 'UserController@updateProfile')->name('manage-update-profile');
    Route::get('edit-profile', 'UserController@editProfile')->name('manage-edit-profile');
    Route::get('/change-password', 'PasswordController@viewChangePassword')->name('change-password');
    Route::post('/change-password', 'PasswordController@storeNewPassword')->name('change-password-post');
});
#manage-users
Route::group(['prefix' => '/users', 'middleware' => ['auth','nocache'],'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/users', 'UserController@index')->name('manage-user');
    Route::get('/get-user-list-ajax', 'UserController@getUserListAjax')->name('getUserListAjax');
    Route::get('/add', 'UserController@add')->name('manage-user-add');
    Route::post('/save', 'UserController@save')->name('manage-user-save');
    Route::post('/update', 'UserController@update')->name('manage-user-update');
    Route::get('/edit/{id}', 'UserController@edit')->name('manage-user-edit');
    Route::any('/delete/{id}', 'UserController@delete')->name('manage-user-delete');
    Route::post('/status'    , 'UserController@status')->name('manage-user-status');
    Route::any('/images/delete','UserController@deleteImage')->name('manage-user-images-delete');
    Route::any('/activities/{id}','UserController@activities')->name('manage-user-activities');
    

});

#manage-users
Route::group(['prefix' => '/manage-users', 'middleware' => ['auth','nocache'],'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/users-admin', 'UserController@indexAdmin')->name('manage-userAdmin');
    Route::get('/get-user-list-ajaxAdmin', 'UserController@getUserListAjaxAdmin')->name('getUserListAjaxAdmin');
    Route::get('/add-user', 'UserController@addAdmin')->name('manage-user-addAdmin');
    Route::post('/save-user', 'UserController@saveAdmin')->name('manage-user-saveAdmin');
    Route::post('/update-user', 'UserController@updateAdmin')->name('manage-user-updateAdmin');
    Route::get('/edit-user/{id}', 'UserController@editAdmin')->name('manage-user-editAdmin');
    Route::any('/delete-user/{id}', 'UserController@deleteAdmin')->name('manage-user-deleteAdmin');
    Route::post('/status-user'    , 'UserController@statusAdmin')->name('manage-user-statusAdmin');
    Route::any('/images-user/delete','UserController@deleteImageAdmin')->name('manage-user-images-deleteAdmin');
    Route::any('/activities-user/{id}','UserController@activitiesAdmin')->name('manage-user-activitiesAdmin');
    

});
/* Logout */
Route::get('/logout', function () {
    \Auth::logout();
    return redirect(route('admin-login'));
})->name('logout');
/* Dashboard controller*/
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});
#Manage Roles
Route::group(['prefix' => '/manage-role', 'middleware' => ['auth','nocache'], 'namespace' => 'App\Http\Controllers', 'page-group' => '/manage-role'], function () {
    Route::get('/list', 'RoleController@index')->name('role-list');
    Route::get('/datatable', 'RoleController@getDatatable')->name('role-datatable');
    Route::get('/add', 'RoleController@add')->name('role-add');
    Route::post('/save', 'RoleController@save')->name('role-save');
    Route::get('/edit/{id}', 'RoleController@edit')->name('role-edit');
    Route::post('/update', 'RoleController@update')->name('role-update');
    Route::post('/status', 'RoleController@status')->name('role-status');
    Route::post('/delete', 'RoleController@delete')->name('role-delete');
});
#Manage Company 
Route::group(['prefix' => '/manage-company','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-company'],function(){
    Route::get('/list-company', 'CompanyController@index')->name('company-list');
    Route::get('/datatable-company', 'CompanyController@getDatatable')->name('company-datatable');
    Route::get('/add-company', 'CompanyController@add')->name('company-add');
    Route::any('/save-company', 'CompanyController@store')->name('company-save');
    Route::get('/edit-company/{id}', 'CompanyController@edit')->name('company-edit');
    Route::post('/update-company', 'CompanyController@update')->name('company-update');
    Route::post('/status-company', 'CompanyController@status')->name('company-status');
    Route::post('/delete-company', 'CompanyController@delete')->name('company-delete');
});
#Manage Client 
Route::group(['prefix' => '/manage-client','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/list-client', 'ClientController@index')->name('client-list');
    Route::get('/datatable-client', 'ClientController@getDatatable')->name('client-datatable');
    Route::get('/add-client', 'ClientController@add')->name('client-add');
    Route::post('/save-client', 'ClientController@store')->name('client-save');
    Route::get('/edit-client/{id}', 'ClientController@edit')->name('client-edit');
    Route::get('/view-client/{id}', 'ClientController@show')->name('client-view');
    Route::post('/update-client', 'ClientController@update')->name('client-update');
    Route::post('/status-client', 'ClientController@status')->name('client-status');
    Route::post('/delete-client', 'ClientController@delete')->name('client-delete');
    Route::get('/add-client','ClientController@addClient')->name('client-add');
});
#Manage Document 
Route::group(['prefix' => '/manage-client','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/list-document/{id}/{name}', 'DocumentController@index')->name('document-list');
    
    Route::get('/datatable-Document', 'DocumentController@getDatatable')->name('document-datatable');
    Route::get('/add-document', 'documentController@add')->name('document-add');
    Route::post('/save-document', 'DocumentController@store')->name('document-save');
    Route::get('/edit-document/{id}', 'DocumentController@edit')->name('document-edit');
    
});
#Manage Medication 
Route::group(['prefix' => '/manage-medication','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/list-medication/{id}/{name}', 'MedicationController@index')->name('medication-list');
    
    Route::get('/datatable-medication', 'MedicationController@getDatatable')->name('medication-datatable');
    Route::get('/add-medication', 'MedicationController@add')->name('medication-add');
    Route::post('/save-medication', 'MedicationController@store')->name('medication-save');
    Route::post('/update-medication', 'MedicationController@update')->name('medication-update');
    Route::get('/edit-medication/{id}', 'MedicationController@edit')->name('medication-edit');
    Route::post('/apply-medication', 'ClientController@add')->name('apply-medicals');
    Route::post('/echat-medication', 'ClientController@echatStore')->name('echat-medicals');
    
});
#Apply medication to client
Route::group(['prefix' => '/apply-medication','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/view-medication/{id}/{client}/{name}', 'ClientController@view')->name('medication-view');
    Route::get('/apply-view-medication/{id}/{client}/{name}', 'ClientController@applyView')->name('apply-medication-view');
    
    
});
#Manage group note

Route::group(['prefix' => '/manage-group-note','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/list-group/{id}/{client}/{name}', 'GroupNoteController@index')->name('group-note-list');
    Route::post('/save-group', 'GroupNoteController@store')->name('save-group-note');
    Route::post('/fetch-states','ManageCountriesController@fetchState')->name('fetch-states');
    Route::post('/fetch-cities','ManageCountriesController@fetchCity')->name('fetch-cities');
    Route::get('/view-group-note-list/{id}/{name}/{birth}/{created}','GroupNoteController@show')->name('view-group-note-list');
});

#Manage group note

Route::group(['prefix' => '/manage-report','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/list-report', 'ReportController@index')->name('report-today-list');
    Route::any('/today-report-client', 'ReportController@clientDaily')->name('today-client');
    Route::get('/today-report-client-ajax', 'ReportController@dailyAjax')->name('today-client-ajax');
    Route::any('/weekly-report-client', 'ReportController@clientWeekly')->name('weekly-client');
    Route::get('/weekly-report-client-ajax', 'ReportController@weeklyAjax')->name('weekly-client-ajax');
    Route::get('/monthly-report-client','ReportController@clientMonthly')->name('monthly-client');
    Route::get('/monthly-report-client-ajax', 'ReportController@monthlyAjax')->name('monthly-client-ajax');
});

#Invoice

Route::group(['prefix' => '/invoice','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/invoice/{id}', 'InvoiceController@index')->name('invoice');
    Route::get('/all-invoice/{id}', 'InvoiceController@all')->name('all-invoice');
    Route::post('/create-invoice','InvoiceController@store')->name('add-invoice');
    Route::post('/update-invoice','InvoiceController@update')->name('update-invoice');
    Route::get('/view-invoice/{id}', 'InvoiceController@view')->name('view-invoice');
    Route::get('/edit-invoice/{id}', 'InvoiceController@edit')->name('edit-invoice');
    Route::any('/all-invoices', 'InvoiceController@all_invoices')->name('all-invoices');
    
});

#insurance routes
Route::group(['prefix' => '/insurance','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
Route::post('save-insurance','InsuranceController@store')->name('save-insurance');
Route::get('insurances','InsuranceController@index')->name('insurance');
Route::get('edit-insurances/{id}','InsuranceController@edit')->name('edit-insurance');
Route::any('update-insurance','InsuranceController@update')->name('update-insurance');
});

#individual therapy notes
Route::group(['prefix' => '/individual','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('individual/{id}/{client}/{name}','IndividualController@index')->name('individual');
    Route::post('save-individual-note','IndividualController@store')->name('save-individual-note');
    Route::get('/view-individual-note-list/{id}/{name}/{birth}/{created}','IndividualController@show')->name('view-individual-note-list');
});
#progress notes
Route::group(['prefix' => '/progress','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('progress/{id}/{client}/{name}','ProgressController@index')->name('progress');

    Route::post('save-progress-note','ProgressController@store')->name('save-progress-note');
    Route::get('/view-progress-note-list/{id}/{name}/{birth}/{created}','ProgressController@show')->name('view-progress-note-list');
});
#discharged
Route::group(['prefix' => '/discharged','middleware'=> ['auth','nocache'],'namespace' => 'App\Http\Controllers','page-group'=> '/manage-Client'],function(){
    Route::get('/discharged-client', 'ClientController@discharged')->name('client-discharged');
    Route::get('discharging/{id}/{name}', 'ClientController@discharging')->name('discharging');
    Route::get('/dis-apply-view-medication/{id}/{client}/{name}', 'ClientController@applyViewDis')->name('dis-apply-medication-view');
    Route::get('dis-progress/{id}/{client}/{name}','ProgressController@indexDis')->name('dis-progress');
    Route::get('dis-individual/{id}/{client}/{name}','IndividualController@indexDis')->name('dis-individual');
    Route::get('/dis-invoice/{id}', 'InvoiceController@indexDis')->name('dis-invoice');
    Route::get('/dis-list-group/{id}/{client}/{name}', 'GroupNoteController@indexDis')->name('dis-group-note-list');
    Route::get('/dis-list-medication/{id}/{name}', 'MedicationController@indexDis')->name('dis-medication-list');
    Route::get('/dis-list-document/{id}/{name}', 'DocumentController@indexDis')->name('dis-document-list');
    Route::get('/dis-view-client/{id}', 'ClientController@showDis')->name('dis-client-view');
    Route::get('/dis-view-invoice/{id}', 'InvoiceController@viewDis')->name('dis-view-invoice');
    Route::get('/dis-all-invoice/{id}', 'InvoiceController@allDis')->name('dis-all-invoice');
});

