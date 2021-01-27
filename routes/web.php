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

Route::post('material_upload', 'MaterialController@upload')->name('material.upload');

Route::resource('material_category', 'MaterialCategoryController');

// Contractor Report
Route::group(['prefix'=>'contractor','as'=>'contractor.'], function (){
    Route::get('contractor/report/bill', 'ReportController@ContractorBill')->name('today.bill');
    Route::post('contractor/report/search', 'ReportController@BillSearch')->name('today.search');
    Route::get('contractor/today/report', 'ReportController@todayReport')->name('today');
    Route::get('contractor/weekly/report', 'ReportController@weeklyReport')->name('week');
});
// Vendor Report

Route::group(['prefix'=>'vendor','as'=>'vendor.'], function (){
    Route::get('vendor/report/bill', 'VendorReportController@vendorBill')->name('bill');
    Route::post('vendor/report/search', 'VendorReportController@billSearch')->name('today.search');
    Route::get('vendor/today/report', 'VendorReportController@todayReport')->name('today');
    Route::get('vendor/weekly/report', 'VendorReportController@weeklyReport')->name('week');
});

//Requisition
Route::group(['prefix'=>'workOrder','as'=>'workOrder.'], function (){
    Route::get('project/work/order', 'WorkOrderController@addWorkOrder')->name('addWorkOrder');
    Route::post('work-order-store', 'WorkOrderController@workOrderStore')->name('orderStore');
    Route::get('project/work/order/list', 'WorkOrderController@workOrderList')->name('list');
});

Route::group(['prefix'=>'requisition','as'=>'requisition.'], function (){

    Route::POST('work-order','RequisitionController@getWorkNo')->name('getWorkNo');
    //for getting Product
    Route::POST('product-list','RequisitionController@getMaterial')->name('getMaterial');
    Route::get('create-requisition', 'RequisitionController@index')->name('index');
//    Route::get('', 'RequisitionController@show')->name('show');
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
    Route::post('store-work', 'AssignWorkController@storeWork')->name('store');

});
Route::group(['prefix'=>'todo','as'=>'todo.'], function(){
    Route::post('Todo-work', 'TodoController@storeTodo')->name('store');
    Route::get('Todo-list', 'TodoController@fetchUserTodo')->name('list');
    Route::get('delete-todo/{id}', 'TodoController@deleteTodo')->name('delete');

});
Route::group(['prefix'=>'subWork','as'=>'subWork.'], function(){
    Route::post('sub-work', 'SubWorkController@storeSubWork')->name('store');
    Route::post('sub-work-refNo', 'SubWorkController@storeSubWorkRefNo')->name('storeRefNo');
    Route::post('sub-work-delay-remark', 'SubWorkController@storeRemarks')->name('storeRemark');
    Route::post('sub-work-particular', 'SubWorkController@storeParticulars')->name('storeParticular');
    Route::post('sub-work-particular/{id}', 'SubWorkController@storeParticularsDelete')->name('deleteParticular');
    Route::get('sub-work-details/{id}', 'SubWorkController@SubWorkDetails')->name('details');

});
//vendor
Route::group(['prefix'=>'vendorAssignProject','as'=>'vendorAssignProject.'], function(){

    Route::get('Assign-Project', 'VendorAssignProjectController@index')->name('index');
    Route::post('store-assign-project', 'VendorAssignProjectController@storeProject')->name('store');
    Route::get('view-assign-project', 'VendorAssignProjectController@viewProject')->name('view');
    Route::get('view-assign-project-details/{id}', 'VendorAssignProjectController@viewProjectDetails')->name('details');
    Route::post('assign-project-bill', 'VendorAssignProjectController@projectBillPay')->name('payBill');
});


