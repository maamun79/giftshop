<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

    <!-- Main container -->
    <main>
        <?php
//            $role_session = mi_get_session('role');
        ?>
        <div class="main-content">
            <div class="row">

                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-info">
                        <h6 class="text-uppercase text-white">Game Top Up Orders</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-shopbag text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_all('topup_orders'));?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-primary">
                        <h6 class="text-uppercase text-white">Gift Card Orders</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-refresh-2 text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_all('gift_card_orders'));?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-danger">
                        <h6 class="text-uppercase text-white">Currency Orders</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-close-circle text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_all('currency_orders'))?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-cyan">
                        <h6 class="text-uppercase text-white">Total Admins</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-users text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_all('mi_admin'))?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

      <?=mi_include('footer_extra.php');?>
    </main>
    <!-- END Main container -->


<?=mi_footer();?>
