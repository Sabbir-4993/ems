<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="{{ asset('backend/dist/img/logo.png') }}" alt="Trimatric Logo" >
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{--Dashboard--}}
                <li class="nav-item">
                    <a href="{{url('/')}}" class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{--Permission--}}
                @if(isset(auth()->user()->permission['name']['permission']['can-list']))
                <li class="nav-header">Permission</li>
                <li class="nav-item">
                    <a href="{{route('permission.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Permission
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    @if(isset(auth()->user()->permission['name']['permission']['can-add']))
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('permission.create')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Permission Create</p>
                            </a>
                        </li>
                    </ul>
                    @endif
                    @if(isset(auth()->user()->permission['name']['permission']['can-view']))
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('permission.index')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Permission View</p>
                            </a>
                        </li>
                    </ul>
                    @endif
                </li>
                @endif


                {{--Management--}}
                <li class="nav-header">Management</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{--Department--}}
                        @if(isset(auth()->user()->permission['name']['department']['can-list']))
                        <li class="nav-item">
                            <a href="{{route('department.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Department
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @if(isset(auth()->user()->permission['name']['department']['can-add']))
                                <li class="nav-item">
                                    <a href="{{route('department.create')}}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Department</p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['department']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('department.index')}}" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>View Department</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif


                        {{--Designation--}}
                        @if(isset(auth()->user()->permission['name']['designation']['can-list']))
                        <li class="nav-item">
                            <a href="{{route('designation.index')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Designation
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(isset(auth()->user()->permission['name']['designation']['can-add']))
                                <li class="nav-item">
                                    <a href="{{route('designation.create')}}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Designation</p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['designation']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('designation.index')}}" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>View Designation</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{--Employee--}}
                        @if(isset(auth()->user()->permission['name']['user']['can-list']))
                        <li class="nav-item">
                            <a href="{{route('employee.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Employee
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(isset(auth()->user()->permission['name']['user']['can-add']))
                                <li class="nav-item">
                                    <a href="{{route('employee.create')}}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Employee</p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['user']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('employee.index')}}" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>View Employee</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                    </ul>
                </li>

                {{--Project--}}
                @if(isset(auth()->user()->permission['name']['project']['can-list']))
                <li class="nav-header">Project</li>
                <li class="nav-item">
                    <a href="{{route('project.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>
                            Project
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(isset(auth()->user()->permission['name']['project']['can-add']))
                        <li class="nav-item">
                            <a href="{{route('project.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Project</p>
                            </a>
                        </li>
                        @endif
                        @if(isset(auth()->user()->permission['name']['project']['can-view']))
                        <li class="nav-item">
                            <a href="{{route('project.index')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>View Project</p>
                            </a>
                        </li>
                        @endif
                        @if(isset(auth()->user()->permission['name']['project_work_order']['can-view']))
                        <li class="nav-item">
                            <a href="{{route('workOrder.list')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Work Order List</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                {{--Requisition--}}
                <li class="nav-header">Procurement</li>
                <li class="nav-item">
                    <a href="{{route('requisition.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Requisition
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('requisition.index')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Requisition</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('requisition.show')}}" class="nav-link">--}}
{{--                                <i class="fas fa-clipboard-list nav-icon"></i>--}}
{{--                                <p>View Requisition</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a href="{{route('requisition.pending')}}" class="nav-link">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>Pending Requisition </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('requisition.complete')}}" class="nav-link">
                                <i class="fas fa-check-square"></i>
                                <p>Approved Requisition </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--Contractor--}}
                <li class="nav-item">
                    <a href="{{route('contractors.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Contractor List
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--Contractor--}}
                        @if(isset(auth()->user()->permission['name']['contractors']['can-list']))
                        <li class="nav-item">
                            <a href="{{route('contractors.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Contractor
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(isset(auth()->user()->permission['name']['contractors']['can-add']))
                                <li class="nav-item">
                                    <a href="{{route('contractors.create')}}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Contractor</p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['contractors']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('contractors.index')}}" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>View Contractor</p>
                                    </a>
                                </li>
                                @endif
                                {{--Contractor Category Add--}}
                                @if(isset(auth()->user()->permission['name']['contractors']['can-add']))
                                <li class="nav-item">
                                    <a href="{{route('category.create')}}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Contractor Category</p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['contractors']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('category.index')}}" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>View Contractor Category </p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                    </ul>
                    @if(isset(auth()->user()->permission['name']['contractor_bill']['can-list']))
                    <ul class="nav nav-treeview">
                        {{--Bill Payment--}}
                        <li class="nav-item">
                            <a href="{{route('assignProject.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-money-check"></i>
                                <p>
                                    Bill Payment
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(isset(auth()->user()->permission['name']['contractor_bill']['can-add']))
                                <li class="nav-item">
                                    <a href="{{route('assignProject.index')}}" class="nav-link">
                                        <i class="fas fa-bezier-curve nav-icon"></i>
                                        <p>Assign Project </p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['contractor_bill']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('assignProject.view')}}" class="nav-link">
                                        <i class="fas fa-money-bill nav-icon"></i>
                                        <p>Bill Payment </p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['contractor_bill']['can-report']))
                                <li class="nav-item">
                                    <a href="{{route('contractor.today.bill')}}" class="nav-link">
                                        <i class="fas fa-money-bill nav-icon"></i>
                                        <p>Report</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    @endif
                </li>

                {{--Material--}}
                @if(isset(auth()->user()->permission['name']['material']['can-list']))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-atlassian"></i>
                        <p>
                            Material
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(isset(auth()->user()->permission['name']['material']['can-add']))
                        <li class="nav-item">
                            <a href="{{route('material_category.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Material Category</p>
                            </a>
                        </li>
                        @endif
                        @if(isset(auth()->user()->permission['name']['material']['can-view']))
                        <li class="nav-item">
                            <a href="{{route('material_category.index')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Material Category List</p>
                            </a>
                        </li>
                        @endif
                        @if(isset(auth()->user()->permission['name']['material']['can-add']))
                        <li class="nav-item">
                            <a href="{{route('material.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Material</p>
                            </a>
                        </li>
                        @endif
                        @if(isset(auth()->user()->permission['name']['material']['can-view']))
                        <li class="nav-item">
                            <a href="{{route('material.index')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>View Material</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                {{--Vendor--}}
                <li class="nav-header">Vendor</li>
                <li class="nav-item">
                    <a href="{{route('vendor.create')}}" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Vendor
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(isset(auth()->user()->permission['name']['vendor']['can-add']))
                        <li class="nav-item">
                            <a href="{{route('vendor.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Vendor</p>
                            </a>
                        </li>
                        @endif
                        @if(isset(auth()->user()->permission['name']['vendor']['can-view']))
                        <li class="nav-item">
                            <a href="{{route('vendor.index')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>View Vendor</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                    <ul class="nav nav-treeview">
                        {{--Bill Payment--}}
                        <li class="nav-item">
                            <a href="{{route('vendorAssignProject.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-money-check"></i>
                                <p>
                                    Bill Payment
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(isset(auth()->user()->permission['name']['vendor_bill']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('vendorAssignProject.index')}}" class="nav-link">
                                        <i class="fas fa-bezier-curve nav-icon"></i>
                                        <p>Assign Vendor Project </p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['vendor_bill']['can-view']))
                                <li class="nav-item">
                                    <a href="{{route('vendorAssignProject.view')}}" class="nav-link">
                                        <i class="fas fa-money-bill nav-icon"></i>
                                        <p>Vendor Bill Payment </p>
                                    </a>
                                </li>
                                @endif
                                @if(isset(auth()->user()->permission['name']['vendor_bill']['can-report']))
                                <li class="nav-item">
                                    <a href="{{route('vendor.bill')}}" class="nav-link">
                                        <i class="fas fa-money-bill nav-icon"></i>
                                        <p>Vendor Report  </p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </li>

                {{--Assign Task--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('requisition.show')}}" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-thumbtack"></i>--}}
{{--                        <p>--}}
{{--                            Assign Task--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="fas fa-plus nav-icon"></i>--}}
{{--                                <p>Add Task</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="fas fa-clipboard-list nav-icon"></i>--}}
{{--                                <p>View Task</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                {{--Assign Work--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-cogs"></i>--}}
{{--                        <p>--}}
{{--                            Assign Work--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        --}}{{--                        Contractor Category--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('assignWork.index')}}" class="nav-link">--}}
{{--                                <i class="fas fa-bezier-curve nav-icon"></i>--}}
{{--                                <p>Assign Work </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

