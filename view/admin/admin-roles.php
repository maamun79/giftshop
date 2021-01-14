<?php
    $role_session = mi_get_session('role');
    if ($role_session['user_management'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }

    if (isset($_GET['e']) && !empty($_GET['e'])){
        $get = mi_db_read_by_id('user_roles', array('id'=>mi_secure_input($_GET['e'])))[0];
    }
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>


<main>
    <div class="main-content">
        <div class="row justify-content-md-center">
            <div class="col-12 col-lg-4 col-md-4">
                <div class="card pb-3">
                    <h4 class="card-title"><strong>Add Role & Accesses</strong></h4>
                    <div class="card-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="role_edit_id" value="<?=(isset($get['id']) && !empty($get['id'])?$get['id']:'')?>">
                            <!--                                ===========================-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="role_name" name="role_name" value="<?=(!empty($get['role_name']))?$get['role_name']:'';?>">
                                            <label for="role_name">Role Name</label>
                                        </div>

                                        <div class="form-group">
                                            <h6>Accesses</h6>
                                            <div class="custom-controls-stacked">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" value="1" id="topup_management" name="topup_management" <?=(!empty($get['topup_management']) && $get['topup_management']==1?'checked':'')?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Topup Management</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" value="1" id="card_management" name="card_management" <?=(!empty($get['card_management'])&& $get['card_management']==1?'checked':'')?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Card Management</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" value="1" name="currency_management" id="currency_management" <?=(!empty($get['currency_management'])&& $get['currency_management']==1?'checked':'')?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Currency Management</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" value="1" name="u_manage" id="u_manage" <?=(!empty($get['user_management'])&& $get['user_management']==1?'checked':'')?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">User Management</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" value="1" name="order" id="order" <?=(!empty($get['orders']) && $get['orders']==1?'checked':'')?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Orders</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" value="1" name="settings" id="settings" <?=(!empty($get['settings']) && $get['settings']==1?'checked':'')?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Settings</span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" <?=(!empty($get['status'])&& $get['status']==1?'selected':'')?>>Active</option>
                                                <option value="2" <?=(!empty($get['status'])&& $get['status']==2?'selected':'')?>>Deactive</option>
                                            </select>
                                            <label class="label-floated" for="status"></label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--                                ===========================-->
                            <div class="col-12 card-footer">
                                <?php if (isset($_GET['e'])){?>
                                    <a href="admin-roles.php" class="btn btn-outline btn-danger btn-sm">Cancel</a>
                                <?php }?>
                                <button class="btn btn-dark float-right btn-sm" type="submit" name="role_<?=(isset($_GET['e'])?'edit':'add')?>">
                                    <?=(isset($_GET['e'])?'Update Role':'Add Role')?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!---------------------show pocket flap------------------->
            <div class="col-12 col-lg-8 col-md-8">
                <div class="card">
                    <h4 class="card-title"><strong>Roles & Accesses</strong></h4>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Accesses</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $get_roles = mi_db_read_all('user_roles', 'id', 'DESC');
                            foreach ($get_roles as $key=> $role){
                                ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><?=$role['role_name']?></td>
                                    <td>
                                        <?php if($role['topup_management'] == 1){?>
                                            <span class="badge badge-pill badge-default badge-bold tags-border">Topup Management</span>
                                        <?php }?>
                                        <?php if($role['card_management'] == 1){?>
                                            <span class="badge badge-pill badge-default badge-bold tags-border">Card Management</span>
                                        <?php }?>
                                        <?php if($role['currency_management'] == 1){?>
                                            <span class="badge badge-pill badge-default badge-bold tags-border">Currency Management</span>
                                        <?php }?>
                                        <?php if($role['orders'] == 1){?>
                                            <span class="badge badge-pill badge-default badge-bold tags-border">Order</span>
                                        <?php }?>
                                        <?php if($role['user_management'] == 1){?>
                                            <span class="badge badge-pill badge-default badge-bold tags-border">User Management</span>
                                        <?php }?>
                                        <?php if($role['settings'] == 1){?>
                                            <span class="badge badge-pill badge-default badge-bold tags-border">Settings</span>
                                        <?php }?>
                                    </td>
                                    <td><?=($role['status'] == 1?'Active':'Deactive')?></td>
                                    <td>
                                        <a href="admin-roles.php?e=<?=$role['id']?>" class="btn btn-dark btn-sm">Edit <i class="fa fa-edit"></i></a>
                                        <a val="<?=$role['id']?>" class="btn btn-danger btn-sm text-white deleteRole">Delete <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
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
