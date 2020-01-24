<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <h4>Travel Admin v1.1</h4>
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
             data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle"
                         data-lock-picture="assets/images/!logged-user.jpg"/>
                </figure>
                <div class="profile-info logged-in">
                    <span class="name" id="loggedInName"></span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <div class="logged-out">
                        <li>
                            <a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#loginModal"><i
                                        class="fa fa-lock"></i> Sign in</a>
                        </li>
                    </div>
                    <li>
                        <a onclick="logout()" class="logged-in" role="menuitem" tabindex="-1"><i
                                    class="fa fa-power-off"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->