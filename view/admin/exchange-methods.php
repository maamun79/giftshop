<?php
    $role_session = mi_get_session('role');
    if ($role_session['currency_management'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }

    if (isset($_GET['e']) && !empty($_GET['e'])){
        $get = mi_db_read_by_id('exchanger', array('id'=>mi_secure_input($_GET['e'])))[0];
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
                    <h4 class="card-title"><strong><?=(isset($_GET['e']) && !empty($_GET['e'])?'Edit':'Add')?> Method</strong></h4>
                    <div class="card-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="method_edit_id" value="<?=(isset($get['id']) && !empty($get['id'])?$get['id']:'')?>">
                            <!--                                ===========================-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="method_name" name="method_name" value="<?=(!empty($get['name']))?$get['name']:'';?>">
                                            <label for="method_name">Method Name</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control" id="account_email" name="account_email" value="<?=(!empty($get['company_mail']))?$get['company_mail']:'';?>">
                                            <label for="method_name">Account Email</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="sell_rate" name="sell_rate" value="<?=(!empty($get['buy_rate']))?$get['buy_rate']:'';?>">
                                            <label for="sell_rate">Sell Rate (BDT Per USD)</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="buy_rate" name="buy_rate" value="<?=(!empty($get['sell_rate']))?$get['sell_rate']:'';?>">
                                            <label for="buy_rate">Buy Rate (BDT Per USD)</label>
                                        </div>

                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" <?=(!empty($get['status'])&& $get['status']==1?'selected':'')?>>Active</option>
                                                <option value="2" <?=(!empty($get['status'])&& $get['status']==2?'selected':'')?>>Deactive</option>
                                            </select>
                                            <label class="label-floated" for="status">Status</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--                                ===========================-->
                            <div class="col-12 card-footer">
                                <?php if (isset($_GET['e'])){?>
                                    <a href="exchange-methods.php" class="btn btn-outline btn-danger btn-sm">Cancel</a>
                                <?php }?>
                                <button class="btn btn-dark float-right btn-sm" type="submit" name="method_<?=(isset($_GET['e'])?'edit':'add')?>">
                                    <?=(isset($_GET['e'])?'Update Method':'Add Method')?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!---------------------show pocket flap------------------->
            <div class="col-12 col-lg-8 col-md-8">
                <div class="card">
                    <h4 class="card-title"><strong>Exchange Methods</strong></h4>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Account Email</th>
                                <th>Sell Rate</th>
                                <th>Buy Rate</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $get_methods = mi_db_read_all('exchanger', 'id', 'DESC');
                            foreach ($get_methods as $key=> $method){
                                ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><?=$method['name']?></td>
                                    <td><?=$method['company_mail']?></td>
                                    <td><?=$method['buy_rate']?> BDT</td>
                                    <td><?=$method['sell_rate']?> BDT</td>
                                    <td><?=($method['status'] == 1?'Active':'Deactive')?></td>
                                    <td>
                                        <a href="exchange-methods.php?e=<?=$method['id']?>" class="btn btn-dark btn-sm">Edit <i class="fa fa-edit"></i></a>
                                        <a val="<?=$method['id']?>" class="btn btn-danger btn-sm text-white deleteData" del-type="currency-exchange-method">Delete <i class="fa fa-trash"></i></a>
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
