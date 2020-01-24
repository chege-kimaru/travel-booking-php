<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title" style="color: white;">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
             data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li <?php if($title == 'Dashboard') echo 'class="nav-active"'; ?>>
                        <a href="index.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li <?php if($title == 'Cities') echo 'class="nav-active"'; ?>>
                        <a href="cities.php">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <span>Cities</span>
                        </a>
                    </li>
                    <li <?php if($title == 'Buses') echo 'class="nav-active"'; ?>>
                        <a href="buses.php">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            <span>Buses</span>
                        </a>
                    </li>
                    <li <?php if($title == 'Routes') echo 'class="nav-active"'; ?>>
                        <a href="routes.php">
                            <i class="fa fa-road" aria-hidden="true"></i>
                            <span>Routes</span>
                        </a>
                    </li>
                    <li <?php if($title == 'Trips') echo 'class="nav-active"'; ?>>
                        <a href="trips.php">
                            <i class="fa fa-cab" aria-hidden="true"></i>
                            <span>Trips</span>
                        </a>
                    </li>
                    <li <?php if($title == 'Bookings') echo 'class="nav-active"'; ?>>
                        <a href="bookings.php">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span>Bookings</span>
                        </a>
                    </li>
                    <li <?php if($title == 'Passengers') echo 'class="nav-active"'; ?>>
                        <a href="passengers.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Passengers</span>
                        </a>
                    </li>
                    <li <?php if($title == 'Admins') echo 'class="nav-active"'; ?>>
                        <a href="admins.php">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span>Admins</span>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>

        </div>

</aside>
<!-- end: sidebar -->