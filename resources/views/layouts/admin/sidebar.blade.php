<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('user.index')}}" aria-expanded="false"><i class="fas fa-user"></i></i> Users</a></li>
                        <li><a href="{{ route('role.index')}}" aria-expanded="false"><i class="fa fa-tasks"></i> Roles</a></li>
                        <li><a href="{{ route('permission.index')}}" aria-expanded="false"><i class="fa fa-lock"></i> Permissions</a></li>
                    </ul>
                </li>

            

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Institution</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('institution.index')}}" aria-expanded="false"><i class="fas fa-school"></i></i> Add Institution</a></li>
                        <li><a href="{{ route('graduation.index')}}" aria-expanded="false"><i class="fa fa-graduation-cap"></i> Add Graduation</a></li>
                        <li><a href="{{ route('ceremony.index')}}" aria-expanded="false"><i class="fa fa-lock"></i> View Ceremony Time</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Graduates</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('graduate.index')}}" aria-expanded="false"><i class="fas fa-school"></i></i> View Graduate</a></li>
                        <li><a href="{{ route('graduate.graduateStatus','eligible')}}" aria-expanded="false"><i class="fas fa-school"></i></i> Eligible</a></li>
                        <li><a href="{{ route('graduate.graduateStatus','register')}}" aria-expanded="false"><i class="fas fa-school"></i></i> Register</a></li>
                        <li><a href="{{ route('graduate.graduateStatus','incomplete')}}" aria-expanded="false"><i class="fas fa-school"></i></i> Incomplete</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
