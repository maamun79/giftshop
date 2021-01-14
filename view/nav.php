
<?php
    $topups = mi_db_read_by_id('game_topup', array('status'=> 1), '', 'id', 'DESC', 3);
    $cards = mi_db_read_by_id('gift_cards', array('status'=> 1), '', 'id', 'DESC', 3);
    $site_logo = mi_db_read_by_id('settings_meta', array('meta_name'=> 'site_logo', 'type'=> 'nav_front'))[0];
?>
<!-- header start -->
        <header class="header-area">
            <div class="header-bottom header-btm-coffee-res">
                <div class="container">
                    <div class="white-bg header-btm-res-pd">
                        <div class="row">
                            <div class="col-12">
                                <div class="logo mobile-logo">
                                    <a href="<?=MI_BASE_URL;?>">
                                        <img alt="" src="<?=$site_logo['meta_value']?>">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile-menu-area">
                                    <div class="mobile-menu">
                                        <nav id="mobile-menu-active">
                                            <ul class="menu-overflow">
                                                <li><a href="<?=MI_BASE_URL;?>">HOME</a></li>
                                                <li><a href="shop.html"> Collection </a>
                                                    <ul class="mega-menu">
                                                        <li>
                                                            <ul>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-md-6">
                                                                        <li>
                                                                            <ul>
                                                                                <li class="mega-menu-title">Latest Game Top Up</li>
                                                                                <div class="row">
                                                                                    <?php foreach ($topups as $topup){?>
                                                                                        <div class="col-md-4">
                                                                                            <li>
                                                                                                <div class="product-img">
                                                                                                    <a href="<?=MI_BASE_URL.'game/'.base64_encode($topup['id']);?>">
                                                                                                        <img src="<?=MI_BASE_URL.$topup['thumb'];?>" alt="" style="width: 100%">
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="text-center">
                                                                                                    <h6 class="text-center pb-3 mt-2"><a href="<?=MI_BASE_URL.'game/'.base64_encode($topup['id']);?>"><?=$topup['name'];?></a></h6>
                                                                                                </div>
                                                                                            </li>
                                                                                        </div>
                                                                                    <?php }?>
                                                                                </div>
                                                                            </ul>
                                                                        </li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li>
                                                                            <ul>
                                                                                <li class="mega-menu-title">Latest Gift Cards</li>
                                                                                <div class="row">
                                                                                    <?php foreach ($cards as $card){?>
                                                                                        <div class="col-md-4">
                                                                                            <li>
                                                                                                <div class="product-img">
                                                                                                    <a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>">
                                                                                                        <img src="<?=MI_BASE_URL.$card['thumb'];?>" alt="" style="width: 100%">
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="text-center">
                                                                                                    <h6 class="text-center pb-3 mt-2"><a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>"><?=$card['name'];?></a></h6>
                                                                                                </div>
                                                                                            </li>
                                                                                        </div>
                                                                                    <?php }?>
                                                                                </div>
                                                                            </ul>
                                                                        </li>
                                                                    </div>
                                                                </div>

                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="track-order.php">Track Order</a></li>
                                                <li><a href="#">About us</a></li>
                                                <li><a href="contact.php"> Contact us </a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-bg menu-coffee-color toy-menu mi-main-menu">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="menu-categories border-0">
                                    <h3>
                                        <a href="<?=MI_BASE_URL;?>">
                                            <img src="<?=MI_BASE_URL.$site_logo['meta_value']?>" alt="">
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="main-menu main-none">
                                    <nav>
                                        <ul>
                                            <li class="mega-menu-position">
                                                <a href="<?=MI_BASE_URL;?>">Home</a>
                                            </li>
                                            <li class="mega-menu-position"><a href="#"> Collection <i class="ion-chevron-down"></i> </a>
                                                <ul class="mega-menu">
                                                    <li>
                                                        <ul>
                                                            <div class="row justify-content-center">
                                                                <div class="col-md-6">
                                                                    <li>
                                                                        <ul>
                                                                            <li class="mega-menu-title">Latest Game Top Up</li>
                                                                            <div class="row">
                                                                                <?php foreach ($topups as $topup){?>
                                                                                    <div class="col-md-4">
                                                                                        <li>
                                                                                            <div class="product-img">
                                                                                                <a href="<?=MI_BASE_URL.'game/'.base64_encode($topup['id']);?>">
                                                                                                    <img src="<?=MI_BASE_URL.$topup['thumb'];?>" alt="" style="width: 100%">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                                <h6 class="text-center pb-3 mt-2"><a href="<?=MI_BASE_URL.'game/'.base64_encode($topup['id']);?>"><?=$topup['name'];?></a></h6>
                                                                                            </div>
                                                                                        </li>
                                                                                    </div>
                                                                                <?php }?>
                                                                            </div>
                                                                        </ul>
                                                                    </li>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <li>
                                                                        <ul>
                                                                            <li class="mega-menu-title">Latest Gift Cards</li>
                                                                            <div class="row">
                                                                                <?php foreach ($cards as $card){?>
                                                                                    <div class="col-md-4">
                                                                                        <li>
                                                                                            <div class="product-img">
                                                                                                <a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>">
                                                                                                    <img src="<?=MI_BASE_URL.$card['thumb'];?>" alt="" style="width: 100%">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                                <h6 class="text-center pb-3 mt-2"><a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>"><?=$card['name'];?></a></h6>
                                                                                            </div>
                                                                                        </li>
                                                                                    </div>
                                                                                <?php }?>
                                                                            </div>
                                                                        </ul>
                                                                    </li>
                                                                </div>
                                                            </div>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="track-order.php">Track Order </a></li>
                                            <li><a href="#">About Us </a></li>
                                            <li><a class="menu-border" href="contact.php">contact </a></li>
                                            <li class="mi-last-child">
                                                <div class="header-search middle-same">
                                                    <form class="header-search-form" action="archive.php" method="get">
                                                        <input type="text" name="search" placeholder="Search entire store here ...">
                                                        <button>
                                                            <i class="ion-ios-search-strong"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>