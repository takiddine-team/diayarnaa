<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
            <div class="input-group">
                {{-- <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i> --}}
                {{-- </button> --}}
                <input type="text" name="query" id="search-input" class="form-control" autofocus autocomplete="off"
                    disabled />
            </div>
            {{-- <div id="search-results-container">
                <ul id="search-results"></ul>
            </div> --}}
        </div>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                {{-- ===================================================================== --}}
                {{-- ======================== Notifications Section ====================== --}}
                {{-- ===================================================================== --}}
                {{-- <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">You have 5 notifications</li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-plus"></i> New user registered
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-remove"></i> User deleted
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 07 AM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-chart-areaspline"></i> Sales report is ready
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 12 PM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-supervisor"></i> New client
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-server-network-off"></i> Server overloaded
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 05 AM</span>
                            </a>
                        </li>
                        <li class="dropdown-footer">
                            <a class="text-center" href="#"> View All </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- ===================================================================== --}}
                {{-- =========================== Setting Section ========================= --}}
                {{-- ===================================================================== --}}
                {{-- <li class="right-sidebar-in right-sidebar-2-menu">
                    <i class="mdi mdi-settings mdi-spin"></i>
                </li> --}}

                {{-- ===================================================================== --}}
                {{-- ============================ User Account =========================== --}}
                {{-- ===================================================================== --}}
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @if (isset(auth()->user()->profile_photo_path))
                            @if (auth()->user()->profile_photo_path && file_exists(auth()->user()->profile_photo_path))
                                <img src="{{ asset(auth()->user()->profile_photo_path) }}" class="user-image"
                                    alt="User Image" />
                            @else
                                <img src="{{ asset('style_files/shared/images_default/profilesf.png') }}"
                                    class="user-image" alt="User Image" />
                            @endif
                        @else
                            <img src="{{ asset('style_files/shared/images_default/profilesf.png') }}" class="user-image"
                                alt="User Image" />
                        @endif
                        <span
                            class="d-none d-lg-inline-block">{{ isset(auth()->user()->name) ? auth()->user()->name : 'Undefined' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            @if (isset(auth()->user()->profile_photo_path))
                                @if (auth()->user()->profile_photo_path && file_exists(auth()->user()->profile_photo_path))
                                    <img src="{{ asset(auth()->user()->profile_photo_path) }}" class="img-circle"
                                        alt="User Image" />
                                @else
                                    <img src="{{ asset('style_files/shared/images_default/profilesf.png') }}"
                                        class="img-circle" alt="User Image" />
                                @endif
                            @else
                                <img src="{{ asset('style_files/shared/images_default/profilesf.png') }}"
                                    class="img-circle" alt="User Image" />
                            @endif

                            <div class="d-inline-block">
                                {{ isset(auth()->user()->name) ? auth()->user()->name : 'Undefined' }} <small
                                    class="pt-1">{{ isset(auth()->user()->email) ? auth()->user()->email : 'Undefined' }}</small>
                            </div>
                        </li>

                        {{-- <li>
                            <a href="#">
                                <i class="mdi mdi-account"></i> Profile
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('welcome') }}">
                                <i class="mdi mdi-desktop-mac-dashboard"></i> زيارة الموقع
                            </a>
                        </li>


                        {{-- <li class="right-sidebar-in">
                            <a href="javascript:0"> <i class="mdi mdi-settings"></i> Setting </a>
                        </li>  --}}

                        <li class="dropdown-footer">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                                    class="mdi mdi-logout"></i> خروج </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>


</header>
