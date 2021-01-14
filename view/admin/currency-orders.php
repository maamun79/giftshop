<?php
    $role_session = mi_get_session('role');
    if ($role_session['orders'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }
?>


<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>
    <!-- Main container -->
    <main>

        <div class="main-content">

            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <h4 class="card-title"><strong>Gift Card</strong> Orders</h4>

                        <div class="card-body">
                            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables" data-server="<?=MI_BASE_URL;?>admin/actions.php" data-identifier="get_currency_orders">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Id</th>
                                    <th>Exchange Info</th>
                                    <th>Payment Info</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Order Id</th>
                                    <th>Exchange Info</th>
                                    <th>Payment Info</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?=mi_include('footer_extra.php');?>
    </main>
    <!-- END Main container -->


<?=mi_footer();?>