<header>
    <div id="header2" class="header2-area right-nav-mobile">
        <div class="header-top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                        <div class="logo-area">
                            <a href="/"><img width="60" class="img-responsive" src="theme/img/logo.png" alt="logo"></a>
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
                                        <a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i><span>8</span></a>
                                        <ul>
                                            <li>
                                                <div class="notify-notification-img">
                                                    <img class="img-responsive" src="img/profile/1.png" alt="profile">
                                                </div>
                                                <div class="notify-notification-info">
                                                    <div class="notify-notification-subject">Need WP Help!</div>
                                                    <div class="notify-notification-date">01 Dec, 2016</div>
                                                </div>
                                                <div class="notify-notification-sign">
                                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="notify-notification-img">
                                                    <img class="img-responsive" src="img/profile/2.png" alt="profile">
                                                </div>
                                                <div class="notify-notification-info">
                                                    <div class="notify-notification-subject">Need HTML Help!</div>
                                                    <div class="notify-notification-date">01 Dec, 2016</div>
                                                </div>
                                                <div class="notify-notification-sign">
                                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="notify-notification-img">
                                                    <img class="img-responsive" src="img/profile/3.png" alt="profile">
                                                </div>
                                                <div class="notify-notification-info">
                                                    <div class="notify-notification-subject">Psd Template Help!</div>
                                                    <div class="notify-notification-date">01 Dec, 2016</div>
                                                </div>
                                                <div class="notify-notification-sign">
                                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="notify-message">
                                        <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>5</span></a>
                                        <ul>
                                            <li>
                                                <div class="notify-message-img">
                                                    <img class="img-responsive" src="img/profile/1.png" alt="profile">
                                                </div>
                                                <div class="notify-message-info">
                                                    <div class="notify-message-sender">Kazi Fahim</div>
                                                    <div class="notify-message-subject">Need WP Help!</div>
                                                    <div class="notify-message-date">01 Dec, 2016</div>
                                                </div>
                                                <div class="notify-message-sign">
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="notify-message-img">
                                                    <img class="img-responsive" src="img/profile/2.png" alt="profile">
                                                </div>
                                                <div class="notify-message-info">
                                                    <div class="notify-message-sender">Richi Lenal</div>
                                                    <div class="notify-message-subject">Need HTML Help!</div>
                                                    <div class="notify-message-date">01 Dec, 2016</div>
                                                </div>
                                                <div class="notify-message-sign">
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="notify-message-img">
                                                    <img class="img-responsive" src="img/profile/3.png" alt="profile">
                                                </div>
                                                <div class="notify-message-info">
                                                    <div class="notify-message-sender">PsdBosS</div>
                                                    <div class="notify-message-subject">Psd Template Help!</div>
                                                    <div class="notify-message-date">01 Dec, 2016</div>
                                                </div>
                                                <div class="notify-message-sign">
                                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-account-info">
                                        <div class="user-account-info-controler">
                                            <div class="user-account-img">
                                                <img class="img-responsive" src="img/profile/4.png" alt="profile">
                                            </div>
                                            <div class="user-account-title">
                                                <div class="user-account-name">Mike Hussy</div>
                                                <div class="user-account-balance">$171.00</div>
                                            </div>
                                            <div class="user-account-dropdown">
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><a href="#">Profile Page</a></li>
                                            <li><a href="#">Portfolio</a></li>
                                            <li><a href="#">Account Setting</a></li>
                                            <li><a href="#">Downloads</a></li>
                                            <li><a href="#">Wishlist</a></li>
                                            <li><a href="#">Upload Item</a></li>
                                            <li><a href="#">Statement</a></li>
                                            <li><a href="#">Withdraws</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="apply-now-btn" href="/logout" id="logout-button">Logout</a></li>
                                @{{notificationsCount}}
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
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="/home">Dashboard</a></li>
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