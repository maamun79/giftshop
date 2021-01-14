<!-- Sidebar -->
<?php
    $role_session = mi_get_session('role');

    $logo = mi_db_read_by_id('settings_meta', array('meta_name' => 'site_logo'))[0];
?>
<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
    <header class="sidebar-header">
        <a class="logo-icon" href="index.php">
            <img src="assets/logo.png" alt="logo icon">
        </a>
        <span class="logo">
          <a href="index.php"><img src="<?=MI_BASE_URL.$logo['meta_value'];?>" alt="logo"></a>
        </span>
        <span class="sidebar-toggle-fold"></span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu">
                <li class="menu-category">Main/Beneficial</li>

                <li class="menu-item">
                    <a class="menu-link" href="index.php">
                        <span class="icon ion-home"></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <?php if ($role_session['orders'] == 1){?>
                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon ion-cube"></span>
                        <span class="title">Orders</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="topup-orders.php">
                                <span class="dot"></span>
                                <span class="title">Game Topup Orders</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="card-orders.php">
                                <span class="dot"></span>
                                <span class="title">Gift Card Orders</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="currency-orders.php">
                                <span class="dot"></span>
                                <span class="title">Currency Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>

                <?php if ($role_session['topup_management'] == 1){?>
                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon ion-cube"></span>
                        <span class="title">Game Top Up</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="topup.php">
                                <span class="dot"></span>
                                <span class="title">Topup</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="item-types.php">
                                <span class="dot"></span>
                                <span class="title">Item Types</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="item-redeems.php">
                                <span class="dot"></span>
                                <span class="title">Item Redeems</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="player-info.php">
                                <span class="dot"></span>
                                <span class="title">Player Info</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>

                <?php if ($role_session['card_management'] == 1){?>
                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon ion-cube"></span>
                        <span class="title">Gift Card</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="gift-card.php">
                                <span class="dot"></span>
                                <span class="title">Cards</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="card-types.php">
                                <span class="dot"></span>
                                <span class="title">Card Types</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="card-options.php">
                                <span class="dot"></span>
                                <span class="title">Card Options</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php }?>

                <?php if ($role_session['currency_management'] == 1){?>
                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon ion-cube"></span>
                        <span class="title">Currency Exchange</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="exchange-methods.php">
                                <span class="dot"></span>
                                <span class="title">Methods</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php }?>

                <?php if ($role_session['user_management'] == 1){?>
                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon ion-cube"></span>
                        <span class="title">Admins</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="admins.php">
                                <span class="dot"></span>
                                <span class="title">Admins</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="admin-roles.php">
                                <span class="dot"></span>
                                <span class="title">Admin Roles</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php }?>

                <?php if ($role_session['settings'] == 1){?>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <span class="icon ion-cube"></span>
                            <span class="title">Settings</span>
                            <span class="arrow"></span>
                        </a>

                        <ul class="menu-submenu">
                            <li class="menu-item">
                                <a class="menu-link" href="site-settings.php">
                                    <span class="dot"></span>
                                    <span class="title">Site settings</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="contact-requests.php">
                                    <span class="dot"></span>
                                    <span class="title">Contact Requests</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php }?>

        </ul>
    </nav>

</aside>
<!-- END Sidebar -->