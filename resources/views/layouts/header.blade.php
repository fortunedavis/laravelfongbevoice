<header>
        <nav class="mobile_navbar">
            <div class="mobile_logo">
                    <a href="{{ url('/') }}" class="nav-link logo">
                        FFVoice
                    </a> 
                    <a href="#" id="fi_menu_burger_mobile">
                        <i class="fi fi-rr-menu-burger"></i>
                    </a>
            </div>

            <div class="mobile_elements">
                <ul>
                   
                    <li>
                        <a href="{{ url('/speak') }}" class="nav-link">Parler</a>
                    </li>
                    <li>
                        <a href="{{ url('/listen') }}" class="nav-link">Ecouter</a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ url('/statistic') }}" class="nav-link">Statistics</a>
                    </li>
                    @endauth
                    <li>
                        <a href="#" class="nav-link">Blog</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">A propos</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">Donation</a>
                    </li>
                   
                    @guest 
                            @if (Route::has('register'))
                                <li>
                                    <a href="#" class="nav_register nav-link">
                                        Sign up
                                        <i class="fi fi-rr-user"></i>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="#" class="nav_login nav-link">
                                    Log In
                                    <i class="fi fi-rr-address-card"></i>
                                </a>
                            </li>
                    @else
                            
                            <li>
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Log out
                                    <i class="fi fi-rr-address-card"></i>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                            @hasanyrole('admin|superadmin')
                            <li>
                                <a href="{{ route('admin.home') }}" class="nav-link">
                                        Dashboard
                                    <i class="fi fi-rr-dashboard"></i>
                                </a>
                            </li>
                            @endhasanyrole
                    @endguest
                </ul>
            </div>
        </nav>
        <nav class="navbar">
            <div class="left">
                <a href="{{ url('/') }}" class="nav-link logo">
                    FFVoice
                </a>
            </div>
            <div class="nav_elements center">
                <a href="{{ url('/speak') }}" class="nav-link">Parler</a>
                <a href="{{ url('/listen') }}" class="nav-link">Ecouter</a>
                @auth
                <a href="{{ url('/statistic') }}" class="nav-link">Statistics</a>
                @endauth
                <a href="#" class="nav-link">Blog</a>
                <a href="#" class="nav-link Donation">
                    Donation
                </a>
            </div>
            @if (Route::has('login'))
                <div class="nav_elements right">
                    @auth
                            
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form_1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                            @hasanyrole('admin|superadmin')
                                <a href="{{ route('admin.home') }}" class="nav-link">
                                    Dashboard
                                    <i class="fi fi-rr-dashboard"></i>
                                </a>
                            @endhasanyrole
                    @else
                    @if (Route::has('register'))
                        <a href="#" class="nav_register nav-link">
                            Sign up
                            <i class="fi fi-rr-user"></i>
                        </a>
                    @endif
                    <a href="#" class="nav_login nav-link">
                        Log In
                        <i class="fi fi-rr-address-card"></i>
                    </a>
                    @endauth
                    <button class="nav-button">
                        <i class="fi fi-rr-moon"></i>
                    </button>
                </div>
            @endif
        </nav>
    </header>