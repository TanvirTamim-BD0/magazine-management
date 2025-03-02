<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="{{ route("admin.home") }}" style="text-decoration-line: none; font-size: 1rem; /* Adjust size */font-weight: bold;text-transform: uppercase;text-shadow: 2px 2px 10px rgba(255, 138, 0, 0.4);letter-spacing: 2px;margin-bottom: 10px;">
            Magazine Management
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

            @can('client_access')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('admin/client') || request()->is('admin/client/*') || request()->is('admin/client-magazine/*') || request()->is('admin/client-data-export') ? 'c-active' : '' }}" href="{{ route('admin.client.index') }}">
                        <i class="fa fa-user-circle c-sidebar-nav-icon icon-size">
                        </i>
                         Client
                    </a>
                </li>
            @endcan 


            @can('task_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task/*") ? "c-show" : "" }} {{ request()->is("admin/task*") ? "c-show" : "" }} {{ request()->is("admin/task*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa fa-th-list c-sidebar-nav-icon icon-size">
                        </i>
                    Task
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

                    @can('completed_delete')
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
                            <a href="{{ route("admin.task.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task") || request()->is("admin/task/*") ? "c-active" : "" }}">
                                <i class="fa fa-circle-thin c-sidebar-nav-icon">

                                </i>
                                All Task
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


            @can('designation_access')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('admin/category') || request()->is('admin/designation/*') ? 'c-active' : '' }}" href="{{ route('admin.designation.index') }}">
                        <i class="fa fa-microchip c-sidebar-nav-icon icon-size">
                        </i>
                         Designation
                    </a>
                </li>
            @endcan 

            @can('company_access')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('admin/company') || request()->is('admin/company/*') ? 'c-active' : '' }}" href="{{ route('admin.company.index') }}">
                        <i class="fa fa-delicious c-sidebar-nav-icon icon-size">
                        </i>
                         Company
                    </a>
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