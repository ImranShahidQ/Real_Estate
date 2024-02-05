<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Real<span>Estate</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Real Estate</li>
            @if(Auth::user()->can('type.menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Property Type</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('show.property'))
                        <li class="nav-item">
                            <a href="{{route('show.property')}}" class="nav-link">All Property Type</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('add.property'))
                        <li class="nav-item">
                            <a href="{{route('add.property')}}" class="nav-link">Add Property Type</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
            @if(Auth::user()->can('amenities.menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Amenities</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="amenities">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                        @if(Auth::user()->can('show.amenitie'))
                            <a href="{{route('show.amenitie')}}" class="nav-link">All Amenities</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('add.amenitie'))
                        <li class="nav-item">
                            <a href="{{route('add.amenitie')}}" class="nav-link">Add Amenities</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            <li class="nav-item nav-category">Roles And Permissions</li>
            @if(Auth::user()->can('role.menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Roles And Permissions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('all.permission')}}" class="nav-link">All Permission</a>
                        </li>
                        @if(Auth::user()->can('all.role'))
                        <li class="nav-item">
                            <a href="{{route('all.role')}}" class="nav-link">All Roles</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{route('add.role.permission')}}" class="nav-link">Role In Permission</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('all.role.permission')}}" class="nav-link">All Role In Permission</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="nav-item nav-category">Manage Admins</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button" aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manage Admins & Users</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="admin">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('all.admin')}}" class="nav-link">All Admin</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('add.admin')}}" class="nav-link">Add Admin</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>