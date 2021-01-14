
<?php
//$role_session = mi_get_session('role');
//if ($role_session['user_management'] != 1){
//    mi_redirect(MI_BASE_URL.'admin/index.php');
//}
//?>
<?php
if (isset($_GET['e']) && !empty($_GET['e'])){
    $get_staff = mi_db_read_by_id('mi_admin', array('id'=>mi_secure_input($_GET['e'])))[0];
}
?>
<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

<!-- Main container -->
<main>

    <div class="main-content">
        <div class="row justify-content-md-center">
            <div class="col-12 col-lg-12 col-md-12 ">
                <div class="card">
                    <h4 class="card-title"><strong><?=$get_staff['user_name']?></strong>
                        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#modalPassChange">
                            Change Password
                        </button>
                    </h4>
                    <div class="card-body">
                        <form action="actions.php" method="post" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <input type="hidden" name="edit_staff_id" value="<?=$get_staff['id']?>">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="<?=$get_staff['user_name']?>" name="name" id="name" required>
                                                            <label for="name">Staff Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" value="<?=$get_staff['user_email']?>" name="email" id="email" required>
                                                            <label for="email">Staff Email</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="<?=$get_staff['user_address']?>"  name="address" id="address" required>
                                                            <label for="address">Staff Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="<?=$get_staff['user_phone']?>" name="phone" id="phone" required>
                                                            <label for="phone">Staff Phone</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="role" id="role" class="form-control">
                                                                <option value="">Select</option>
                                                                <?php
                                                                $roles = mi_db_read_all('user_roles');
                                                                foreach ($roles as $role){
                                                                    ?>
                                                                    <option value="<?=$role['id']?>" <?=($get_staff['role_id']==$role['id']?'selected':'')?>><?=$role['role_name']?></option>
                                                                <?php }?>
                                                            </select>
                                                            <label class="label-floated" for="role">Staff Role</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group required">
                                                    <h6 class="mb-1">Staff Image <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                    <input type="file" name="image" data-provide="dropify" data-default-file="<?=(!empty($get_staff['user_photo']))?MI_BASE_URL.'admin/'.$get_staff['user_photo']:'';?>" id="image">
                                                </div>

                                                <div class="form-group">
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1" <?=($get_staff['user_status']==1?'selected':'')?>>Pending</option>
                                                        <option value="2" <?=($get_staff['user_status']==2?'selected':'')?>>Active</option>
                                                        <option value="3" <?=($get_staff['user_status']==3?'selected':'')?>>Deactive</option>
                                                    </select>
                                                    <label class="label-floated" for="status">Status</label>
                                                </div>
                                                <div class="mt-5">
                                                    <button type="submit" name="edit_staff" class="btn btn-primary float-right">Update</button>
                                                    <a href="staffs.php" class="btn btn-outline btn-danger float-left">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                        --------------->

                                    </div>
                                </div>
                            </div>

                        </form>

                        <!-- Change password Modal Small -->
                        <div class="modal fade" id="modalPassChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-notify modal-info" role="document">
                                <!--Content-->
                                <div class="modal-content">
                                    <!--Header-->
                                    <div class="modal-header blue-gradient d-flex justify-content-center">
                                        <h4 class="heading">Change Password</h4>
                                    </div>

                                    <!--Body-->
                                    <div class="modal-body">

                                        <form action="actions.php" method="post" style="width: 100%;">
                                            <input type="hidden" name="change_pass_id" value="<?=$get_staff['id']?>">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class="card-body form-type-material">
                                                        <div class="form-group">
                                                            <input type="password" name="password" class="form-control">
                                                            <label for="password">Password</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="con_password" class="form-control">
                                                            <label for="con-password">Confirm Password</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Footer-->
                                            <div class="col-12 card-footer">
                                                <button type="submit" class="btn btn-primary float-right" name="change_staff_pass">Change</button>
                                                <a type="button" class="btn btn-outline btn-danger float-right mr-1" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </form>

                                    </div>


                                </div>
                                <!--/.Content-->
                            </div>
                        </div>
                        <!-- Central Modal Small -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
