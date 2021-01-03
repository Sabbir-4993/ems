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

Route::resource('vendor', 'VendorController');

Route::resource('material', 'MaterialController');

Route::resource('material_category', 'MaterialCategoryController');



//Requisition
Route::group(['prefix'=>'requisition','as'=>'requisition.'], function (){
    //for getting Product
//    Route::get('/material/getMaterial/','RequisitionController@getMaterial')->name('getMaterials');
    Route::get('create-requisition', 'RequisitionController@index')->name('index');
    Route::post('store-requisition', 'RequisitionController@storeRequisition')->name('store');
    Route::get('pending-requisition', 'RequisitionController@pendingRequisition')->name('pending');
    Route::get('details-requisition/{id}', 'RequisitionController@detailsRequisition')->name('details');
    Route::post('approve-requisition', 'RequisitionController@approveRequisition')->name('approve');
    Route::get('complete-requisition', 'RequisitionController@completeRequisition')->name('complete');
    Route::get('approved-Details-requisition/{id}', 'RequisitionController@approvedDetailsRequisition')->name('approvedDetails');
    //print
    Route::get('print-Requisition/{id}', 'RequisitionController@printRequisition')->name('print');


});

Route::group(['prefix'=>'assignProject','as'=>'assignProject.'], function(){

    Route::get('assign-project', 'AssignProjectController@index')->name('index');

    Route::post('store-assign-project', 'AssignProjectController@storeProject')->name('store');

    Route::get('view-assign-project', 'AssignProjectController@viewProject')->name('view');

    Route::get('view-assign-project-details/{id}', 'AssignProjectController@viewProjectDetails')->name('details');

    Route::post('assign-project-bill', 'AssignProjectController@projectBillPay')->name('payBill');

});
Route::group(['prefix'=>'assignWork','as'=>'assignWork.'], function(){

    Route::get('assign-work', 'AssignWorkController@index')->name('index');

});
Route::group(['prefix'=>'todo','as'=>'todo.'], function(){

    Route::post('Todo-work', 'TodoController@storeTodo')->name('store');
    Route::get('Todo-list', 'TodoController@fetchUserTodo')->name('list');
    Route::get('delete-todo/{id}', 'TodoController@deleteTodo')->name('delete');

});

