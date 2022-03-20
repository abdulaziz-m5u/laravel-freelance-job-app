<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-text mx-3">{{ __('Homepage') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @can('user_management_access')
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>{{ __('User Management') }}</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}"> <i class="fa fa-briefcase mr-2"></i> {{ __('Permissions') }}</a>
                        <a class="collapse-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}"><i class="fa fa-briefcase mr-2"></i> {{ __('Roles') }}</a>
                        <a class="collapse-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"> <i class="fa fa-user mr-2"></i> {{ __('Users') }}</a>
                    </div>
                </div>
            </li>
            @endcan

            @can('country_access')
            <li class="nav-item {{ request()->is('admin/countries') || request()->is('admin/countries/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.countries.index') }}">
                    <span>{{ __('Country') }}</span>
                </a>
            </li>
            @endcan

            @can('job_access')
            <li class="nav-item {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.jobs.index') }}">
                    <span>{{ __('Job') }}</span>
                </a>
            </li>
            @endcan

            @can('proposal_access')
            <li class="nav-item {{ request()->is('admin/proposals') || request()->is('admin/proposals/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.proposals.index') }}">
                    <span>{{ __('Proposal') }}</span>
                </a>
            </li>
            @endcan


        </ul>