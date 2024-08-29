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
                        <a href="#" class="nav-link">Ecouter</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">Partners</a>
                    </li>
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
                    @if (Route::has('login'))
                        @auth
                            @if (request()->is('admin/home'))
                                {{Auth::user()->name}}
                                
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <a href="{{ route('admin.home') }}" class="nav-link">
                                    {{Auth::user()->name}}
                                    <i class="fi fi-rr-user"></i>
                                </a>
                            @endif
                        @else
                            @if (Route::has('register'))
                                <li>
                                    <a href="#" class="nav_register nav-link">
                                        Sign up
                                        <i class="fi fi-rr-user"></i>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('login') }}" class="nav_login nav-link">
                                    Log In
                                    <i class="fi fi-rr-address-card"></i>
                                </a>
                            </li>
                        @endauth
                    @endif
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
                <a href="#" class="nav-link">Ecouter</a>
                <a href="#" class="nav-link">Partners</a>
                <a href="#" class="nav-link">Blog</a>
                <a href="#" class="nav-link">A propos</a>
                <a href="#" class="nav-link Donation">
                    Donation
                </a>
            </div>
            @if (Route::has('login'))
                <div class="nav_elements right">
                    @auth
                        @if (request()->is('admin/home'))
                            {{Auth::user()->name}}
                            
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a href="{{ route('admin.home') }}" class="nav-link">
                                {{Auth::user()->name}}
                                <i class="fi fi-rr-user"></i>
                            </a>
                        @endif
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