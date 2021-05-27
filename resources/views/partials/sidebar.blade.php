<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" id="leftbar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/register' || $route.path === '/forgot-password' ? false : true">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">
                            <img src="{{ asset('uploads/users/admin.png') }}" alt="users" class="rounded-circle img-fluid" />
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="m-b-10 user-name font-medium">Limon Rana</h5>
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="ti-settings"></i>
                            </a>
                            <router-link to="logout" class="btn btn-circle btn-sm"> <i class="ti-power-off"></i> </router-link>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <router-link to="/logout" class="dropdown-item"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</router-link>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Personal</span>
                </li>
                <li class="sidebar-item">
                    <router-link to="/dashboard" class="sidebar-link waves-effect waves-dark"><i class="icon-Car-Wheel"></i> Dashboards</router-link>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Employee Management</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Administrator"></i>
                        <span class="hide-menu">Employee </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <router-link :to="{name: 'all-employee'}" class="sidebar-link"><i class="mdi mdi-book-multiple"></i> All Employee</router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name: 'add-employee'}" class="sidebar-link"><i class="mdi mdi-library-plus"></i> Add New</router-link>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Wallet"></i>
                        <span class="hide-menu">Salary </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <router-link :to="{name: 'all-salary'}" class="sidebar-link"><i class="mdi mdi-library-plus"></i> All Salary</router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name: 'pending-salary'}" class="sidebar-link"><i class="mdi mdi-book-multiple"></i> Pay Salary</router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name: 'paid-salary'}" class="sidebar-link"><i class="mdi mdi-library-plus"></i> Paid Salary</router-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Supplier Management</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Add-User"></i>
                        <span class="hide-menu">Supplier </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <router-link :to="{name: 'all-supplier'}" class="sidebar-link"><i class="mdi mdi-book-multiple"></i> All Supplier</router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name: 'add-supplier'}" class="sidebar-link"><i class="mdi mdi-library-plus"></i> Add New</router-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Product Management</span>
                </li>
                <li class="sidebar-item">
                    <router-link to="/category" class="sidebar-link waves-effect waves-dark"><i class="icon-Car-Wheel"></i> Category</router-link>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Add-Basket mb-2"></i>
                        <span class="hide-menu">Product </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <router-link :to="{name: 'all-product'}" class="sidebar-link"><i class="mdi mdi-book-multiple"></i> All Products</router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name: 'add-product'}" class="sidebar-link"><i class="mdi mdi-library-plus"></i> Add New</router-link>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <router-link :to="{name: 'stock-management'}" class="sidebar-link waves-effect waves-dark"><i class="sl-icon-handbag"></i> Stock Management</router-link>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Order Management</span>
                </li>
                <li class="sidebar-item">
                    <router-link to="/expense" class="sidebar-link waves-effect waves-dark"><i class="icon-Folder-Add"></i> Expense</router-link>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Extra</span>
                </li>
                <li class="sidebar-item">
                    <router-link to="/logout" class="sidebar-link waves-effect waves-dark sidebar-link"><i class="mdi mdi-directions"></i> Logout</router-link>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
