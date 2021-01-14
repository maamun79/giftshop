<?php  $logged_admin = mi_db_read_by_id('mi_admin', array('id'=>base64_decode(mi_get_session('admin')), 'user_status'=>2))[0];?>
<!-- Topbar -->
<header class="topbar">
    <div class="topbar-left">
        <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>

<!--        <div class="dropdown d-none d-md-block">-->
<!--            <span class="topbar-btn" data-toggle="dropdown"><i class="ti-layout-grid3-alt"></i></span>-->
<!--            <div class="dropdown-menu dropdown-grid">-->
<!--                <a class="dropdown-item" href="dashboard/general.html">-->
<!--                    <span class="fa fa-home"></span>-->
<!--                    <span class="title">Dashboard</span>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->

        <div class="topbar-divider d-none d-md-block"></div>

        <div class="lookup d-none d-md-block topbar-search" id="theadmin-search">
            <input class="form-control w-300px" type="text">
            <div class="lookup-placeholder">
                <i class="ti-search"></i>
                <span data-provide="typing" data-type="Type any order number..." data-loop="true" data-type-speed="90" data-back-speed="50" data-show-cursor="false"></span>
            </div>
        </div>
    </div>

    <div class="topbar-right">
        <a class="topbar-btn" href="#qv-global" data-toggle="quickview"><i class="ti-align-right"></i></a>

        <div class="topbar-divider"></div>

        <ul class="topbar-btns">
            <li class="dropdown">
                <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="<?=(isset($logged_admin['user_photo']) && !empty($logged_admin['user_photo'])?MI_BASE_URL.'admin/'.$logged_admin['user_photo']:MI_BASE_URL.'uploads/avatar.png')?>" alt="..."></span>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php"><i class="ti-user"></i> Profile</a>
                    <a class="dropdown-item" href="logout.php"><i class="ti-power-off"></i> Logout</a>
                </div>
            </li>


        </ul>

    </div>
</header>
<!-- END Topbar -->