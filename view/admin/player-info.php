<?php
    $role_session = mi_get_session('role');
    if ($role_session['topup_management'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }

    if (isset($_GET['e']) && !empty($_GET['e'])){
        $get = mi_db_read_by_id('player_info', array('id'=>mi_secure_input($_GET['e'])))[0];
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
                    <h4 class="card-title"><strong><?=(isset($_GET['e']) && !empty($_GET['e'])?'Edit':'Add')?> Player Info</strong></h4>
                    <div class="card-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="player_info_edit_id" value="<?=(isset($get['id']) && !empty($get['id'])?$get['id']:'')?>">
                            <!--                                ===========================-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="player_info_title" name="player_info_title" value="<?=(!empty($get['title']))?$get['title']:'';?>">
                                            <label for="item_type_name">Player Info Title</label>
                                        </div>

                                        <div class="form-group">
                                            <select name="type" id="type" class="form-control">
                                                <option value="1" <?=(!empty($get['type'])&& $get['type']==1?'selected':'')?>>Gmail</option>
                                                <option value="2" <?=(!empty($get['type'])&& $get['type']==2?'selected':'')?>>Facebook</option>
                                            </select>
                                            <label class="label-floated" for="status">Type</label>
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
                                    <a href="player-info.php" class="btn btn-outline btn-danger btn-sm">Cancel</a>
                                <?php }?>
                                <button class="btn btn-dark float-right btn-sm" type="submit" name="player_info_<?=(isset($_GET['e'])?'edit':'add')?>">
                                    <?=(isset($_GET['e'])?'Update Player Info':'Add Player Info')?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!---------------------show pocket flap------------------->
            <div class="col-12 col-lg-8 col-md-8">
                <div class="card">
                    <h4 class="card-title"><strong>Player Info</strong></h4>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $get_player_info = mi_db_read_all('player_info', 'id', 'DESC');
                            foreach ($get_player_info as $key=> $info){
                                ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><?=$info['title']?></td>
                                    <td><?=($info['type'] == 1?'Gmail':'Facebook')?></td>
                                    <td><?=($info['status'] == 1?'Active':'Deactive')?></td>
                                    <td>
                                        <a href="player-info.php?e=<?=$info['id']?>" class="btn btn-dark btn-sm">Edit <i class="fa fa-edit"></i></a>
                                        <a val="<?=$info['id']?>" class="btn btn-danger btn-sm text-white deleteData" del-type="topup-player-info">Delete <i class="fa fa-trash"></i></a>
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
