<?php
$role_session = mi_get_session('role');
if ($role_session['topup_management'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}

if (isset($_GET['e']) && !empty($_GET['e'])){
    $get = mi_db_read_by_id('item_types', array('id'=>mi_secure_input($_GET['e'])))[0];
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
                    <h4 class="card-title"><strong><?=(isset($_GET['e']) && !empty($_GET['e'])?'Edit':'Add')?> Item Type</strong></h4>
                    <div class="card-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="item_type_edit_id" value="<?=(isset($get['id']) && !empty($get['id'])?$get['id']:'')?>">
                            <!--                                ===========================-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="item_type_name" name="item_type_name" value="<?=(!empty($get['name']))?$get['name']:'';?>">
                                            <label for="item_type_name">Item Type Name</label>
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
                                    <a href="item-types.php" class="btn btn-outline btn-danger btn-sm">Cancel</a>
                                <?php }?>
                                <button class="btn btn-dark float-right btn-sm" type="submit" name="item_type_<?=(isset($_GET['e'])?'edit':'add')?>">
                                    <?=(isset($_GET['e'])?'Update Item Type':'Add Item Type')?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!---------------------show pocket flap------------------->
            <div class="col-12 col-lg-8 col-md-8">
                <div class="card">
                    <h4 class="card-title"><strong>Item Types</strong></h4>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Type Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $get_item_types = mi_db_read_all('item_types', 'id', 'DESC');
                            foreach ($get_item_types as $key=> $type){
                                ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><?=$type['name']?></td>
                                    <td><?=($type['status'] == 1?'Active':'Deactive')?></td>
                                    <td>
                                        <a href="item-types.php?e=<?=$type['id']?>" class="btn btn-dark btn-sm">Edit <i class="fa fa-edit"></i></a>
                                        <a val="<?=$type['id']?>" class="btn btn-danger btn-sm text-white deleteData" del-type="topup-item-type">Delete <i class="fa fa-trash"></i></a>
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
