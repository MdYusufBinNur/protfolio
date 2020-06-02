<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href='' class="brand-link">
        <img src="{{ asset('img/paypal.png') }}" alt="" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">VUE CRUD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/account.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
{{--                            <span class="right badge badge-danger">New</span>--}}
                        </p>
                    </router-link>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/users" class="nav-link">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Users</p>
                            </router-link>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <router-link to="/job_details" class="nav-link">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            Jobs
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/contacts" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Messages
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/profile" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Profile
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/abouts" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            About
                        </p>
                    </router-link>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            BLog
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/blog_category" class="nav-link">
                                <i class="fas fa-share nav-icon"></i>
                                <p>Blog Category</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/blog" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Blog Lists</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Projects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/project_category" class="nav-link">
                                <i class="fas fa-share nav-icon"></i>
                                <p>Project Category</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/projects" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Projects</p>
                            </router-link>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
