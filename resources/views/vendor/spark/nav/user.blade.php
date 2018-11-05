<!-- NavBar For Authenticated Users -->
<spark-navbar
        :user="user"
        :teams="teams"
        :current-team="currentTeam"
        :unread-announcements-count="unreadAnnouncementsCount"
        :unread-notifications-count="unreadNotificationsCount"
        inline-template>

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


    <nav class="navbar navbar-light navbar-expand-md navbar-spark">
        <div class="container" v-if="user">
            <!-- Branding Image -->
            @include('spark::nav.brand')

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    @includeIf('spark::nav.user-left')
                </ul>

                <a @click="showNotifications" class="notification-pill mx-auto mb-3 mb-md-0 mr-md-0 ml-md-auto">
                    <svg class="mr-2" width="18px" height="20px" viewBox="0 0 18 20" version="1.1"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <linearGradient x1="50%" y1="100%" x2="50%" y2="0%" id="linearGradient-1">
                                <stop stop-color="#86A0A6" offset="0%"></stop>
                                <stop stop-color="#596A79" offset="100%"></stop>
                            </linearGradient>
                        </defs>
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="header" transform="translate(-926.000000, -29.000000)" fill-rule="nonzero"
                               fill="url(#linearGradient-1)">
                                <g id="Group-3">
                                    <path d="M929,37 C929,34.3773361 930.682712,32.1476907 933.027397,31.3318031 C933.009377,31.2238826 933,31.1130364 933,31 C933,29.8954305 933.895431,29 935,29 C936.104569,29 937,29.8954305 937,31 C937,31.1130364 936.990623,31.2238826 936.972603,31.3318031 C939.317288,32.1476907 941,34.3773361 941,37 L941,43 L944,45 L944,46 L926,46 L926,45 L929,43 L929,37 Z M937,47 C937,48.1045695 936.104569,49 935,49 C933.895431,49 933,48.1045695 933,47 L937,47 L937,47 Z"
                                          id="Combined-Shape"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    @{{notificationsCount}}
                </a>

                <ul class="navbar-nav ml-4">
                    <li class="nav-item dropdown">
                        <a href="#" class="d-block d-md-flex text-center nav-link dropdown-toggle"
                           id="dropdownMenuButton" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img :src="user.photo_url" class="dropdown-toggle-image spark-nav-profile-photo">
                            <span class="d-none d-md-block">@{{ user.name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <!-- Impersonation -->
                            @if (session('spark:impersonator'))
                                <h6 class="dropdown-header">{{__('Impersonation')}}</h6>

                                <!-- Stop Impersonating -->
                                <a class="dropdown-item" href="/spark/kiosk/users/stop-impersonating">
                                    <i class="fa fa-fw text-left fa-btn fa-user-secret"></i> {{__('Back To My Account')}}
                                </a>

                                <div class="dropdown-divider"></div>
                        @endif

                        <!-- Developer -->
                        @if (Spark::developer(Auth::user()->email))
                            @include('spark::nav.developer')
                        @endif

                        <!-- Subscription Reminders -->
                        @include('spark::nav.subscriptions')

                        <!-- Settings -->
                            <h6 class="dropdown-header">{{__('Settings')}}</h6>

                            <!-- Your Settings -->
                            <a class="dropdown-item" href="/settings">
                                <i class="fa fa-fw text-left fa-btn fa-cog"></i> {{__('Your Settings')}}
                            </a>

                            <div class="dropdown-divider"></div>

                        @if (Spark::usesTeams() && (Spark::createsAdditionalTeams() || Spark::showsTeamSwitcher()))
                            <!-- Team Settings -->
                            @include('spark::nav.teams')
                        @endif

                        @if (Spark::hasSupportAddress())
                            <!-- Support -->
                            @include('spark::nav.support')
                        @endif

                        <!-- Logout -->
                            <a class="dropdown-item" href="/logout">
                                <i class="fa fa-fw text-left fa-btn fa-sign-out"></i> {{__('Logout')}}
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</spark-navbar>
