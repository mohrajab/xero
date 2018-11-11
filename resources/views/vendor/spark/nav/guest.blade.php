<header>
    <div id="header" class="header2-area right-nav-mobile">
        <div class="header-top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                        <div class="logo-area">
                            <a href="/"><img width="60" class="img-responsive" src="/theme/img/logo.png" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <ul class="profile-notification">
                            <li>
                                <div class="notify-contact"><span>Need help?</span> Talk to an expert: +61 3 8376
                                    6284
                                </div>
                            </li>

                            @if(!Auth::check())
                                <li>
                                    <div class="apply-btn-area">
                                        <a class="apply-now-btn" href="/login" id="login-button1">Login</a>
                                    </div>
                                </li>
                                <li><a class="apply-now-btn-color hidden-on-mobile"
                                       href="/register">Register</a></li>
                            @else
                                <li>
                                    <div class="notify-notification">
                                        <a @click="showNotifications" href="#">
                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                            <span>@{{notificationsCount}}</span>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-account-info">
                                        <div class="user-account-info-controler">
                                            <div class="user-account-img">
                                                <img width="30" class="img-responsive" :src="user.photo_url"
                                                     alt="profile">
                                            </div>
                                            <div class="user-account-title">
                                                <div class="user-account-name">@{{ user.name }}</div>
                                            </div>
                                            <div class="user-account-dropdown">
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <ul>
                                            @if (session('spark:impersonator'))
                                                <h6 class="dropdown-header">{{__('Impersonation')}}</h6>

                                                <a class="dropdown-item"
                                                   href="/spark/kiosk/users/stop-impersonating">
                                                    <i class="fa fa-fw text-left fa-btn fa-user-secret"></i> {{__('Back To My Account')}}
                                                </a>

                                                <div class="dropdown-divider"></div>
                                            @endif

                                            @if (Spark::developer(Auth::user()->email))
                                                @include('spark::nav.developer')
                                            @endif

                                            @include('spark::nav.subscriptions')

                                            <h6 class="dropdown-header">{{__('Settings')}}</h6>

                                            <a class="dropdown-item" href="/settings">
                                                <i class="fa fa-fw text-left fa-btn fa-cog"></i> {{__('Your Settings')}}
                                            </a>

                                            <div class="dropdown-divider"></div>

                                            @if (Spark::usesTeams() && (Spark::createsAdditionalTeams() || Spark::showsTeamSwitcher()))
                                                @include('spark::nav.teams')
                                            @endif

                                            @if (Spark::hasSupportAddress())
                                                @include('spark::nav.support')
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="apply-now-btn" href="/logout" id="logout-button">Logout</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu-area bg-primaryText" id="sticker">
            <div class="container">
                <nav id="desktop-nav">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li class="active"><a href="/home">Dashboard</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area Start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul>
                                <li class="active"><a href="#">Home</a>
                                    <ul>
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="index2.html">Home 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="about.html">About</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End -->
</header>
