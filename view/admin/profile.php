<?php
$get_user = mi_db_read_by_id('mi_admin', array('id'=>base64_decode(mi_get_session('admin')), 'user_status'=>2));
if (count($get_user)>0){
    $user = $get_user[0];
}else{
    mi_redirect(MI_BASE_URL.'admin/logout.php');
}
?>
<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

<style>
    table.table tr th, table.table tr td{
        border: none;
    }
</style>

<!-- Main container -->
<main>

    <div class="main-content pt-5 mt-5">
        <div class="row">
            <div class="col-12 col-lg-7 col-md-7">
                <div class="card">
                    <h4 class="card-title"><strong><?=$user['user_name'];?></strong></h4>

                    <div class="card-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <table class="table table-no-bordered">
                                <tr>
                                    <th>

                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <h6 class="mb-1">Photo <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="image" data-provide="dropify" data-default-file="<?=(isset($user['user_photo']) && !empty($user['user_photo'])?MI_BASE_URL.'admin/'.$user['user_photo']:MI_BASE_URL.'uploads/avatar.png')?>" id="image">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5>Name</h5>
                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <input type="text" name="user_name" class="form-control form-control-lg" value="<?=$user['user_name'];?>" placeholder="Enter user name...">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5>Email</h5>
                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <input type="email" class="form-control form-control-lg" value="<?=$user['user_email'];?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5>Phone</h5>
                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <input type="tel" name="user_phone" class="form-control form-control-lg" value="<?=$user['user_phone'];?>" placeholder="Enter user phone...">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5>Address</h5>
                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <input type="text" name="user_address" class="form-control form-control-lg" value="<?=$user['user_phone'];?>" placeholder="Enter user address...">
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div class="col-12">
                                <button class="btn btn-dark btn-lg float-right" type="submit" name="update_profile" value="<?=base64_decode(mi_get_session('admin'));?>">
                                    Update Profile &nbsp;&nbsp;<i class="fa fa-refresh"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5 col-md-5">
                <div class="card">
                    <h4 class="card-title"><strong>Change Password</strong></h4>

                    <div class="card-body">
                        <form action="actions.php" method="post" style="width: 100%;">
                            <table class="table table-no-bordered">
                                <tr>
                                    <th>
                                        <h5>Current Password</h5>
                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <input type="password" name="current" class="form-control form-control-lg" placeholder="Enter current password">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5>New Password</h5>
                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <input type="password" name="new" class="form-control form-control-lg" placeholder="Enter new password">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5>Confirm Password</h5>
                                    </th>
                                    <td>
                                        <div class="form-group form-group-lg require">
                                            <input type="password" name="confirm" class="form-control form-control-lg" placeholder="Confirm new password">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="col-12">
                                <button class="btn btn-dark btn-lg float-right" type="submit" name="update_password" value="<?=base64_decode(mi_get_session('admin'));?>">
                                    Update Password &nbsp;&nbsp;<i class="fa fa-lock"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
