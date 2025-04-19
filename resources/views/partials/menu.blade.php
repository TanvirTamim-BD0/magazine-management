<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="{{ route("admin.home") }}" style="text-decoration-line: none; font-weight: bold;text-transform: uppercase; text-shadow: 2px 2px 10px rgba(255, 138, 0, 0.4); letter-spacing: 2px; margin-bottom: 10px;">
            BCMEA
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                Dashboard
            </a>
        </li>
            @can('magazine_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/client*") ? "c-show" : "" }} {{ request()->is("admin/magazine-send*") ? "c-show" : "" }} {{ request()->is("admin/magazine*") ? "c-show" : "" }} {{ request()->is("admin/designation*") ? "c-show" : "" }} {{ request()->is("admin/company*") ? "c-show" : "" }} {{ request()->is("admin/area-code*") ? "c-show" : "" }} {{ request()->is("admin/magazine-overview*") ? "c-show" : "" }} {{ request()->is("admin/category*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa fa-book c-sidebar-nav-icon icon-size">
                        </i>
                    Magazine Management
                </a>
                <ul class="c-sidebar-nav-dropdown-items">

                    @if(Auth::user()->role == 'Admin')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.magazine-overview") }}" class="c-sidebar-nav-link {{ request()->is("admin/magazine-overview") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Magazine Overview
                            </a>
                        </li>
                    @endif

                    @can('client_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.client.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/client") || request()->is("admin/client/*")  || request()->is("admin/client-magazine/*") || request()->is("admin/client-data-export") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Client
                            </a>
                        </li>
                    @endcan

                    @can('magazine_send')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.magazine-send.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/magazine-send") || request()->is("admin/magazine-send/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Magazine Send
                            </a>
                        </li>
                    @endcan

                    @can('magazine_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.magazine.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/magazine") || request()->is("admin/magazine/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Magazine
                            </a>
                        </li>
                    @endcan

                    @can('company_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.area-code.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/area-code") || request()->is("admin/area-code/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Area
                            </a>
                        </li>
                    @endcan

                    @can('category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.category.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/category") || request()->is("admin/category/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Category
                            </a>
                        </li>
                    @endcan

                    @can('company_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.company.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/company") || request()->is("admin/company/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Company
                            </a>
                        </li>
                    @endcan

                    @can('designation_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.designation.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/designation") || request()->is("admin/designation/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Designation
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @endcan


            @can('task_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task/*") ? "c-show" : "" }} {{ request()->is("admin/task*") ? "c-show" : "" }} {{ request()->is("admin/task*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa fa-tasks c-sidebar-nav-icon icon-size">
                        </i>
                    Task Management
                </a>
                <ul class="c-sidebar-nav-dropdown-items">

                    @can('today_task')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task.today") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Today's Task
                            </a>
                        </li>
                    @endcan

                    @can('monthly_task')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task.monthly") }}" class="c-sidebar-nav-link {{ request()->is("admin/task") || request()->is("admin/task/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Monthly Task
                            </a>
                        </li>
                    @endcan

                    @can('pending_task')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task.pending") }}" class="c-sidebar-nav-link {{ request()->is("admin/task") || request()->is("admin/task/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Pending Task
                            </a>
                        </li>
                    @endcan

                    @can('completed_task')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.completed") }}" class="c-sidebar-nav-link {{ request()->is("admin/task") || request()->is("admin/task/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Completed Task
                            </a>
                        </li>
                    @endcan

                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task") || request()->is("admin/task") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                All Task
                            </a>
                        </li>
                    @endcan

                    @can('category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-category.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-category") || request()->is("admin/task-category/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Task Category
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
            @endcan

        @can('notice_access')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('admin/notice') || request()->is('admin/notice/*') ? 'c-active' : '' }}" href="{{ route('admin.notice.index') }}">
                        <i class="fa fa-sticky-note-o c-sidebar-nav-icon icon-size">
                        </i>
                         Notice
                    </a>
                </li>
            @endcan 

             @can('task_assign_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/assign-task/*") ? "c-show" : "" }} {{ request()->is("admin/assign-task*") ? "c-show" : "" }} {{ request()->is("admin/i-assigned-task") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa fa-th-list c-sidebar-nav-icon icon-size">
                        </i>
                    Task Assign
                </a>
                <ul class="c-sidebar-nav-dropdown-items">

                    @if(Auth::user()->role == 'Admin')
                    @can('task_assign_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assign-task.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assign-task") || request()->is("admin/assign-task/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Task Assign List
                            </a>
                        </li>
                    @endcan
                    @endif

                    @if(Auth::user()->role == 'Admin')
                    @else
                    @can('task_assign_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assign-task.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assign-task") || request()->is("admin/assign-task/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                Assigned me
                            </a>
                        </li>
                    @endcan
                    @endif

                    @if(Auth::user()->role == 'Admin')
                    @else
                    @can('task_assign_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.i-assigned-task") }}" class="c-sidebar-nav-link {{ request()->is("admin/i-assigned-task/*") || request()->is("admin/i-assigned-task") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                I Assigned
                            </a>
                        </li>
                    @endcan
                    @endif

                </ul>
            </li>
            @endcan


        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>