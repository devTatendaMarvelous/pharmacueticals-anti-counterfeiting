<!-- Page Sidebar Start-->
    <div class="sidebar-wrapper">
        <div id="sidebarEffect"></div>
        <div>
            <div class="logo-wrapper logo-wrapper-center">
                <a href="/home" data-bs-original-title="" title="" >
                    <img class="img-fluid for-white col-6" src="{{asset('logo-white.png')}}"  alt="logo">
                </a>
                <div class="back-btn">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="toggle-sidebar">
                    <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
                </div>
            </div>

            <nav class="sidebar-main pt-5">
                <div class="left-arrow" id="left-arrow">
                    <i data-feather="arrow-left"></i>
                </div>

                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn"></li>
                        @if (Auth::user()->type!='Client')
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="/home">
                                <i class="ri-home-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->type==='Client')
                            <li class="sidebar-list">
                                <a class="linear-icon-link sidebar-link sidebar-title" href="/">
                                    <i class="ri-store-3-line"></i>
                                    <span>Go Back To Shopping</span>
                                </a>

                            </li>
                        @endif
                        @if (Auth::user()->type==='Manufacturer')
                            <li class="sidebar-list">
                                <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="ri-store-3-line"></i>
                                    <span>Products</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="/products">Products</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->type==='Agent')
                            <li class="sidebar-list">
                                <a class="linear-icon-link sidebar-link sidebar-titl e" href="{{route('stocks')}}">
                                    <i class="ri-store-3-line"></i>
                                    <span>Stock</span>
                                </a>

                            </li>
                        @endif
                        @if (Auth::user()->type=== 'Admin')
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="ri-user-3-line"></i>
                                    <span>Pharmacies</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('agents') }}">All Pharmacies</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('agents.create') }}">Create Pharmacy</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="ri-user-3-line"></i>
                                    <span>Manufacturers</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('manufacturers') }}">All Manufacturers</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manufacturers.create') }}">Create Manufacturer</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-list">
                                <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="ri-list-check-2"></i>
                                    <span>Product Categories</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('categories') }}"> Category List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('categories.create') }}">Add New Category</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-list">
                                <a class="linear-icon-link sidebar- link sidebar-title" href="{{ route('products.verificationRequests') }}">
                                    <i class="ri-list-check-2"></i>
                                    <span>Verification Requests</span>
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="ri-user-3-line"></i>
                                    <span>Users</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('users') }}">All users</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-list">
                                <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="ri-list-check-2"></i>
                                    <span>Notifications</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('notifications') }}">Notification List</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('notifications.create') }}">Add New Notification</a>
                                    </li>
                                </ul>
                            </li>
                        @endif


                        @if (Auth::user()->type!=='Client' and Auth::user()->type!='Manufacturer')
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                    <i class="ri-archive-line"></i>
                                    <span>Orders</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('orders') }}">Order List</a>
                                    </li>
                                    {{-- <li>
                                        <a href="order-detail.html">Order Detail</a>
                                    </li>
                                    <li>
                                        <a href="order-tracking.html">Order Tracking</a>
                                    </li> --}}
                                </ul>
                            </li>
                        @endif

                    </ul>
                </div>

                <div class="right-arrow" id="right-arrow">
                    <i data-feather="arrow-right"></i>
                </div>
            </nav>
        </div>
    </div>
<!-- Page Sidebar Ends-->
