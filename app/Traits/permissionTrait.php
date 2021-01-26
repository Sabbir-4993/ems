<?php

namespace App\Traits;

trait permissionTrait{
    public function hasPermission()
    {
        //for Permission
        if (!isset(auth()->user()->permission['name']['permission']['can-add']) && \Route::is('permission.create')){
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['permission']['can-edit']) && \Route::is('permission.edit')){
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['permission']['can-delete']) && \Route::is('permission.destroy')){
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['permission']['can-view']) && \Route::is('permission.index')){
            return abort(401);
        }
//        if (!isset(auth()->user()->permission['name']['permission']['can-list']) && \Route::is('permission.show')){
//            return abort(401);
//        }


        //for Department
        if (!isset(auth()->user()->permission['name']['department']['can-add']) && \Route::is('department.create')){
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['department']['can-edit']) && \Route::is('department.edit')){
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['department']['can-delete']) && \Route::is('department.destroy')){
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['department']['can-view']) && \Route::is('department.index')){
            return abort(401);
        }
//        if (!isset(auth()->user()->permission['name']['department']['can-list']) && \Route::is('department.show')){
//            return abort(401);
//        }


        //for Designation
        //for Employee
        //for Project
        //for Create Requisition
        //for pending Requisition
        //for Approved Requisition
        //for Contractor Add
        //for Contractor Assign Project
        //for Contractor Bill Payment
        //for Material
        //for Vendor
        //for Assign Task
        //for Assign Work

    }
}
