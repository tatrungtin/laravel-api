<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @hasAtLeastOnePermission(['users.create','users.index'])
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-user text-yellow"></i>
                    <span>User</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @hasPermission('users.create')
                    <li>
                        <a href="{{ route('users.create') }}"><i class="fa fa-plus-circle"></i> Add user</a>
                    </li>
                    @endhasPermission

                    @hasPermission('users.index')
                    <li><a href="{{ route('users.index') }}"><i class="fa fa-list-ul"></i> List user</a></li>
                    @endhasPermission
                </ul>
            </li>
            @endhasAtLeastOnePermission

            @hasAtLeastOnePermission(['roles.create','roles.index'])
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-key text-blu"></i>
                    <span>Role</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @hasPermission('roles.create')
                    <li><a href="{{ route('roles.create') }}"><i class="fa fa-plus-circle"></i> Add role</a></li>
                    @endhasPermission

                    @hasPermission('roles.index')
                    <li><a href="{{ route('roles.index') }}"><i class="fa fa-list-ul"></i> List role</a></li>
                    @endhasPermission
                </ul>
            </li>
            @endhasAtLeastOnePermission
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>