<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
/// all Resource Controller
Route::resource('department', 'DepartmentController');

Route::resource('designation', 'DesignationController');

Route::resource('project', 'ProjectController');

Route::resource('employee', 'EmployeeController');

Route::resource('contractors', 'ContractorController');
Route::resource('category', 'CategoryController');

//Route::get('payBill/{id}','ContractorController@payBill')->name('contractors.payBill');
//Route::post('billPaid','ContractorController@BillPaid')->name('contractors.billPaid');
Route::group(['prefix'=>'assignProject','as'=>'assignProject.'], function(){
    Route::get('assign-project', 'AssignProjectController@index')->name('index');
    Route::post('store-assign-project', 'AssignProjectController@storeProject')->name('store');
});

