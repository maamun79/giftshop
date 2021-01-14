<?php
$role_session = mi_get_session('role');
if ($role_session['settings'] != 1){
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
                        <h4 class="card-title">
                            <strong>Game Topup</strong>
                            <a href="add-topup.php" class="btn btn-info btn-sm float-right text-white">Add top up <span class="icon pe-7s-plus"></span></a>

                        </h4>

                        <div class="card-body">
                            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables" data-server="<?=MI_BASE_URL;?>admin/actions.php" data-identifier="get_contact_requests">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th style="width: 100px;">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th style="width: 100px;">Action</th>
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