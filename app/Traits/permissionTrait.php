<?php

namespace App\Traits;


trait permissionTrait
{
    public function hasPermission()
    {
        //for Permission
        if (!isset(auth()->user()->$permission['name']['permission']['can-add']) && \Route::is('permission.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['permission']['can-edit']) && \Route::is('permission.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['permission']['can-delete']) && \Route::is('permission.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['permission']['can-view']) && \Route::is('permission.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['permission']['can-list']) && \Route::is('permission.show')) {
            return abort(401);
        }

        //for Department
        if (!isset(auth()->user()->$permission['name']['department']['can-add']) && \Route::is('department.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['department']['can-edit']) && \Route::is('department.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['department']['can-delete']) && \Route::is('department.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['department']['can-view']) && \Route::is('department.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['department']['can-list']) && \Route::is('department.show')) {
            return abort(401);
        }


        //for Designation
        if (!isset(auth()->user()->$permission['name']['designation']['can-add']) && \Route::is('designation.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['designation']['can-edit']) && \Route::is('designation.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['designation']['can-delete']) && \Route::is('designation.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['designation']['can-view']) && \Route::is('designation.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['designation']['can-list']) && \Route::is('designation.show')) {
            return abort(401);
        }

        //for Employee
        if (!isset(auth()->user()->$permission['name']['user']['can-add']) && \Route::is('user.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['user']['can-edit']) && \Route::is('user.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['user']['can-delete']) && \Route::is('user.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['user']['can-view']) && \Route::is('user.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['user']['can-list']) && \Route::is('user.show')) {
            return abort(401);
        }

        //for Project
        if (!isset(auth()->user()->$permission['name']['project']['can-add']) && \Route::is('project.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['project']['can-edit']) && \Route::is('project.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['project']['can-delete']) && \Route::is('project.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['project']['can-view']) && \Route::is('project.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['project']['can-list']) && \Route::is('project.show')) {
            return abort(401);
        }

        //for Project Work Order
        if (!isset(auth()->user()->$permission['name']['project_work_order']['can-add']) && \Route::is('workOrder.addWorkOrder')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['project_work_order']['can-view']) && \Route::is('workOrder.orderStore')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['project_work_order']['can-list']) && \Route::is('workOrder.list')) {
            return abort(401);
        }


        //for Create Requisition

        //for pending Requisition

        //for Approved Requisition

        //for Contractor
        if (!isset(auth()->user()->permission['name']['contractors']['can-add']) && \Route::is('contractors.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractors']['can-edit']) && \Route::is('contractors.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractors']['can-delete']) && \Route::is('contractors.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractors']['can-view']) && \Route::is('contractors.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractors']['can-list']) && \Route::is('contractors.show')) {
            return abort(401);
        }

        //for Contractor Bill Payment
        if (!isset(auth()->user()->$permission['name']['contractor_bill']['can-add']) && \Route::is('assignProject.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractor_bill']['can-edit']) && \Route::is('assignProject.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractor_bill']['can-report']) && \Route::is('contractor.today.bill')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractor_bill']['can-view']) && \Route::is('assignProject.view')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['contractor_bill']['can-list']) && \Route::is('assignProject.index')) {
            return abort(401);
        }

        //for Material
        if (!isset(auth()->user()->$permission['name']['material']['can-add']) && \Route::is('material.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['material']['can-edit']) && \Route::is('material.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['material']['can-delete']) && \Route::is('material.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['material']['can-view']) && \Route::is('material.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['material']['can-list']) && \Route::is('material.show')) {
            return abort(401);
        }

        //for Vendor
        if (!isset(auth()->user()->$permission['name']['vendor']['can-add']) && \Route::is('vendor.create')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['vendor']['can-edit']) && \Route::is('vendor.edit')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['vendor']['can-delete']) && \Route::is('vendor.destroy')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['vendor']['can-view']) && \Route::is('vendor.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['vendor']['can-list']) && \Route::is('vendor.show')) {
            return abort(401);
        }

        //for Vendor Bill Payment

        if (!isset(auth()->user()->permission['name']['vendor_bill']['can-report']) && \Route::is('vendor.today.search')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['vendor_bill']['can-view']) && \Route::is('vendor.view')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['vendor_bill']['can-list']) && \Route::is('vendor.bill')) {
            return abort(401);
        }

//        Requisition
        if (!isset(auth()->user()->$permission['name']['requisition']['can-add']) && \Route::is('requisition.index')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['requisition']['can-pending']) && \Route::is('requisition.pending')) {
            return abort(401);
        }
        if (!isset(auth()->user()->permission['name']['requisition']['can-approve']) && \Route::is('requisition.complete')) {
            return abort(401);
        }

        //for Assign Task

        //for Assign Work



    }
}
