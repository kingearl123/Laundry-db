    <!-- sidebar -->
    <nav class="sidebar">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="menu_title menu_dahsboard"></div>
                <?php
                if ($_SESSION['role'] == 'admin') {
                ?>
                    <li class="item">
                        <div class="nav_link submenu_item">
                            <span class="navlink_icon">
                                <i class='bx bx-table'></i> </span>
                            <span class="navlink">Data</span>
                            <i class="bx bx-chevron-right arrow-left"></i>
                        </div>

                        <ul class="menu_items submenu">
                            <li>
                                <a href="./dashboard.php?page=outlet" class="nav_link sublink">Outlet</a>
                            </li>
                            <li>
                                <a href="./dashboard.php?page=user" class="nav_link sublink">User</a>
                            </li>
                            <li>
                                <a href="./dashboard.php?page=paket" class="nav_link sublink">Paket</a>
                            </li>
                        <?php } ?>
                        <?php
                        if ($_SESSION['role'] == 'admin') {
                        ?>
                            <a href="./dashboard.php?page=member" class="nav_link sublink">Member</a>
                        <?php } elseif ($_SESSION['role'] == 'kasir') { ?>
                            <li class="item">
                                <a href="./dashboard.php?page=member" class="nav_link">
                                    <span class="navlink_icon">
                                        <i class='bx bxs-user-badge'></i>
                                    </span>
                                    <span class="navlink">Member</span>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>

                    </li>
                    <!-- end -->

            </ul>

            <ul class="menu_items">
                <!-- duplicate these li tag if you want to add or remove navlink only -->
                <!-- Start -->
                <?php
                if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') {
                ?>
                    <li class="item">
                        <a href="./dashboard.php?page=transaksi" class="nav_link">
                            <span class="navlink_icon">
                                <i class='bx bx-wallet-alt'></i> </span>
                            <span class="navlink">Transaksi</span>
                        </a>
                    </li>


                <?php } ?>

                <li class="item">
                    <a href="./dashboard.php?page=laporan" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bxs-dock-left'></i> </span>
                        <span class="navlink">Laporan Transaksi</span>
                    </a>
                </li>
                <!-- End -->
            </ul>

            <!-- Sidebar Open / Close -->
            <div class="bottom_content">
                <div class="bottom">
                    <a href="./logout/logout.php">Logout</a>
                    <i class='bx bx-log-out'></i>
                </div>
            </div>
        </div>
    </nav>