<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <a href="#" class="brand-link">
            <img src="{{ asset('uploads/company_logo/logo.png') }}" alt="Trimatric Logo"
                 class="brand-image img-circle elevation-3" style="opacity: 1">
            <span class="brand-text font-weight-light">TRIMATRIC</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
{{--            <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--                <div class="image">--}}
{{--                    <img src="{{ asset('backend/dist/img/user1-128x128.jpg') }}" class="img-circle elevation-2"--}}
{{--                         alt="User Image">--}}
{{--                </div>--}}
{{--                <div class="info">--}}
{{--                    <a href="#" class="d-block">{{Auth()->user()->name}}</a>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">
                            <i class="fas fa-tachometer-alt nav-icon"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('department.create')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Department
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('department.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Department</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('department.index')}}" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>View Department</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('designation.create')}}" class="nav-link">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>
                                Designation
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('designation.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Designation</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('designation.index')}}" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>View Designation</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                Project
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('project.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Project</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('project.index')}}" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>View Project</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee.create')}}" class="nav-link">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>
                                Employee
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('employee.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Employee</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('employee.index')}}" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>View Employee</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fab fa-atlassian"></i>
                            <p>
                                Material
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Material</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>View Material</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-code-branch"></i>
                            <p>
                                Contractor
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('contractors.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Contractor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('contractors.index')}}" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>View Contractor</p>
                                </a>
                            </li>
                            {{--                        Contractor Add--}}
                            <li class="nav-item">
                                <a href="{{route('category.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Contractor Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('category.index')}}" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>View Contractor Category </p>
                                </a>
                            </li>
                            {{--                        Contractor Category--}}
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-money-check"></i>
                            <p>
                                Bill Payment
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{--                        Contractor Category--}}
                            <li class="nav-item">
                                <a href="{{route('assignProject.index')}}" class="nav-link">
                                    <i class="fas fa-bezier-curve nav-icon"></i>
                                    <p>Assign Project </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('assignProject.view')}}" class="nav-link">
                                    <i class="fas fa-money-bill nav-icon"></i>
                                    <p>Bill Payment </p>
                                </a>
                            </li>
                            {{--                        Assign Project List--}}
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>

