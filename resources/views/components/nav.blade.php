<!-- Page Header Start-->
<div class="page-header">
    <div class="header-wrapper m-0">
        <div class="header-logo-wrapper p-0">
            <div class="logo-wrapper">
                <a href="{{ route('home') }}">
                    <img class="img-fluid main-logo" src="{{asset('logo.png')}}" alt="logo">
                    <img class="img-fluid white-logo" src="{{asset('logo.png')}}" alt="logo">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                <a href="{{ route('home') }}">
                    <img src="{{asset('logo.png')}}" class="img-fluid" alt="">
                </a>
            </div>
        </div>
        <div class="text-center">
            <h3>
                You are viewing the <strong> {{Auth::user()->type}} </strong> Backend Dashboard
            </h3>
        </div>

        <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <div class="mode">
                        <i class="ri-moon-line"></i>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown pe-0 me-0">
                    <div class="media profile-media">
                        <img class="user-profile rounded-circle"
                             src="{{Auth::user()->photo? asset('storage/'.Auth::user()->photo):asset('no-media.png')}}"
                             alt="">
                        <div class="user-name-hide media-body">
                            <span>{{ Auth::user()->name }}</span>
                            <p class="mb-0 font-roboto">{{ Auth::user()->type }}<i
                                    class="middle ri-arrow-down-s-line"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{ route('profiles.edit') }}">
                                <i data-feather="ri-pencil-line"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li>

                            <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                               href="javascript:void(0)">
                                <i data-feather="log-out"></i>
                                <span>Log out</span>
                            </a>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends-->
