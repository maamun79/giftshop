

<?php
$role_session = mi_get_session('role');
if ($role_session['user_management'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>


<main>
    <div class="main-content">
        <div class="row justify-content-md-center">
            <!---------------------show users------------------->
            <div class="col-12 col-lg-12">
                <div class="card">
                    <h3 class="card-title"><strong>Admins</strong>
                        <button class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addStaffModalForm">Add Admin <span class="icon pe-7s-plus"></span></button>
                    </h3>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $staffs = mi_db_read_all('mi_admin', 'id', 'DESC');
                            foreach ($staffs as $key=> $staff){
                                ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><?=$staff['user_name']?></td>
                                    <td style="width: 70px">
                                        <img src="<?=(($staff['user_photo'] != null)?MI_BASE_URL.'admin/'.$staff['user_photo']:MI_BASE_URL.'uploads/avatar.png')?>" class="gallary-image">
                                    </td>
                                    <td><?=$staff['user_email']?></td>
                                    <td><?=$staff['user_phone']?></td>
                                    <td><?=$staff['user_address']?></td>
                                    <?php
                                    $role = mi_db_read_by_id('user_roles', array('id'=>$staff['role_id']))[0];
                                    ?>
                                    <td><?=$role['role_name']?></td>
                                    <td><?=($staff['user_status'] == 1?'Pending':($staff['user_status']== 2?'Activated':'Deactivated'))?></td>
                                    <td>
                                        <a href="admin-edit.php?e=<?=$staff['id']?>" class="btn btn-dark btn-sm">Edit <i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--        ---------------------add user---------------------->
        <!-- Modal -->
        <div class="modal fade" id="addStaffModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <!--Content-->
                <div class="modal-content form-elegant">
                    <!--Header-->
                    <div class="modal-header text-center">
                        <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Add Admin</strong></h3>
                    </div>
                    <!--Body-->
                    <div class="modal-body mx-4">
                        <form action="actions.php" method="post" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <!--Body-->
                                        <div class="row justify-content-center mb-1">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group required">
                                                    <h6 class="mb-1">Staff Image <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                    <input type="file" name="image" data-provide="dropify" id="image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" id="name" required>
                                                    <label for="name">Staff Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" id="email" required>
                                                    <label for="email">Staff Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="phone" id="phone" required>
                                                    <label for="phone">Staff Phone</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="address" id="address" required>
                                                    <label for="address">Staff Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password" id="password" required>
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="con_pass" id="con_pass" required>
                                                    <label for="con-pass">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1">Pending</option>
                                                        <option value="2">Active</option>
                                                        <option value="3">Deactive</option>
                                                    </select>
                                                    <label class="label-floated" for="status">Status</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <select name="role" id="role" class="form-control">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $roles = mi_db_read_all('user_roles');
                                                        foreach ($roles as $role){
                                                            ?>
                                                            <option value="<?=$role['id']?>"><?=$role['role_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                    <label class="label-floated" for="role">Staff Role</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 card-footer">
                                <button type="submit" name="add_staff" class="btn btn-primary float-right">Add Staff</button>
                                <button type="button" class="btn btn-outline btn-danger float-right mr-1" data-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer mx-5 pt-3 mb-1">
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
    </div>

    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
