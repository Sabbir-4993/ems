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



Auth::routes();

//Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::resource('department', 'DepartmentController');

Route::resource('designation', 'DesignationController');

Route::resource('project', 'ProjectController');

Route::resource('employee', 'UserController');

Route::resource('contractors', 'ContractorController');

Route::resource('category', 'CategoryController');

//Requisition
Route::group(['prefix'=>'requisition','as'=>'requisition.'], function (){

    Route::get('create-requisition', 'RequisitionController@index')->name('index');
    Route::post('store-requisition', 'RequisitionController@storeRequisition')->name('store');

});

//Route::get('payBill/{id}','ContractorController@payBill')->name('contractors.payBill');
//Route::post('billPaid','ContractorController@BillPaid')->name('contractors.billPaid');

Route::group(['prefix'=>'assignProject','as'=>'assignProject.'], function(){

    Route::get('assign-project', 'AssignProjectController@index')->name('index');

    Route::post('store-assign-project', 'AssignProjectController@storeProject')->name('store');

    Route::get('view-assign-project', 'AssignProjectController@viewProject')->name('view');

    Route::get('view-assign-project-details/{id}', 'AssignProjectController@viewProjectDetails')->name('details');

    Route::post('assign-project-bill', 'AssignProjectController@projectBillPay')->name('payBill');
});

