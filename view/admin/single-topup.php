<?php
    $role_session = mi_get_session('role');
    if ($role_session['topup_management'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }

    if (isset($_GET['e']) && !empty($_GET['e'])){
        $topup_id = mi_secure_input(base64_decode($_GET['e']));

        $topup = mi_db_read_by_id('game_topup', array('id'=> $topup_id))[0];
        $variations = json_decode($topup['variation'], true);

    }else{
        mi_redirect(MI_BASE_URL.'admin/topup.php');
    }
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>



    <main>
        <div class="main-content">
            <div class="row justify-content-md-center">
                <!-- -------------pocket placement edit-------------->
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="pb-3">
                        <h4 class="card-title"><strong><?=(isset($_GET['e']) && !empty($_GET['e'])?'Edit':'Add')?> Game Topup</strong></h4>
                        <div class="card-body form-type-material">
                            <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                                <input type="hidden" name="edit_game_topup_id" value="<?=$topup['id']?>">
                                <!--=================================-->
                                <div class="row">
                                    <div class="col-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name" name="name" value="<?=(isset($_GET['e']) && !empty($_GET['e'])?$topup['name']:'')?>">
                                                    <label for="name">Name</label>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="description" class="form-control" id="description" rows="10"><?=(isset($_GET['e']) && !empty($_GET['e'])?$topup['description']:'')?></textarea>
                                                    <label for="title">Description</label>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="font-weight-bold">Variations</h4>
                                        <div class="form-group">
                                            <?php
                                                $item_types = mi_db_read_by_id('item_types', array('status'=>1));
                                                $item_redems = mi_db_read_by_id('item_redems', array('status'=>1));
                                                $player_info = mi_db_read_by_id('player_info', array('status'=>1));
                                                foreach ($item_types as $key => $type){

                                                    $index = array_search($type['id'], array_column($variations, 'type_id'));

                                            ?>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h6>Item Types</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input item-type-selection" value="<?=$type['id']?>" name="item_type[<?=$key;?>][id]" <?=((isset($_GET['e']) && $type['id'] == $variations[$index]['type_id'])?'checked':'')?> data-key="item-type-selection-<?=$key;?>">
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description"><?=$type['name']?></span>
                                                            </label>
                                                            <br>

                                                            <div class="form-group pl-5 item-redem-selection item-type-selection-<?=$key;?> <?=((isset($_GET['e']) && $type['id'] == $variations[$index]['type_id'])?'':'d-none')?>">
                                                                <div class="col-md-8 pb-5">
                                                                    <div class="row">
                                                                        <div class="col-md-2 col-sm-6 col-xs-6">
                                                                            <h6>Price : </h6>
                                                                        </div>
                                                                        <div class="col-md-10 col-sm-6 col-xs-6 pl-0">
                                                                            <input type="text" name="item_type[<?=$key;?>][item_price]" class="custom_price_input p-1" placeholder="Price" value="<?=(isset($_GET['e'])?$variations[$index]['type_price']:'');?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tab" class="btn-group btn-group-justified active-tab" data-toggle="buttons">
                                                                    <a href="#redem<?=$type['id']?>" class="btn btn-default redem_check active <?=(isset($_GET['e']) && isset($variations[$index]['type_redems'])?'focus':'')?>"
                                                                       data-toggle="tab" type-val="redeem" type-key="#redem_check_input_<?=$key;?>">
                                                                        <input name="is_redeem_older" type="radio" />Item Types
                                                                    </a>
                                                                    <a href="#playerInfo<?=$type['id']?>" class="btn btn-default redem_check <?=(isset($_GET['e']) && isset($variations[$index]['player_info'])?'focus':'')?>"
                                                                       data-toggle="tab" type-val="player" type-key="#redem_check_input_<?=$key;?>">
                                                                        <input name="is_redeem_older" type="radio" />Player Info
                                                                    </a>
                                                                    <input name="item_type[<?=$key?>][is_redem]" id="redem_check_input_<?=$key;?>" type="hidden" value="<?=(isset($_GET['e']) && isset($variations[$index]['type_redems'])?'redeem':'player')?>" />
                                                                </div>
                                                                <div class="tab-content">
                                                                    <div id="redem<?=$type['id']?>" class="tab-pane <?=(isset($_GET['e']) && isset($variations[$index]['type_redems'])?'active':'')?>">
                                                                        <?php
                                                                        foreach ($item_redems as $k => $redem){
                                                                            $indexx = array_search($redem['id'], array_column($variations[$index]['type_redems'], 'redem_id'));
                                                                            ?>
                                                                            <label class="custom-control custom-checkbox pt-2">
                                                                                <input type="checkbox" class="custom-control-input item-redem-selection" value="<?=$redem['id']?>" name="item_type[<?=$key;?>][item_redem][<?=$k?>][id]" data-key="item-redem-selection-<?=$key;?>-<?=$k;?>"
                                                                                    <?=(
                                                                                    (
                                                                                        isset($_GET['e']) &&
                                                                                        isset($variations[$index]['type_redems']) &&
                                                                                        $type['id'] == $variations[$index]['type_id'] &&
                                                                                        $redem['id'] == $variations[$index]['type_redems'][$indexx]['redem_id']
                                                                                    )
                                                                                        ?'checked':''
                                                                                    )?>
                                                                                >
                                                                                <span class="custom-control-indicator"></span>
                                                                                <span class="custom-control-description"><?=$redem['title']?></span>
                                                                            </label><br>
                                                                                <div class="pt-2 pb-5 item-redem-selection-<?=$key;?>-<?=$k;?> <?=(
                                                                                (
                                                                                    isset($_GET['e']) &&
                                                                                    isset($variations[$index]['type_redems']) &&
                                                                                    $type['id'] == $variations[$index]['type_id'] &&
                                                                                    $redem['id'] == $variations[$index]['type_redems'][$indexx]['redem_id']
                                                                                )
                                                                                    ?'':'d-none'
                                                                                )?>" style="padding-left: 50px">
                                                                                <h6>Player Info</h6>

                                                                                <?php
                                                                                    foreach ($player_info as $pi=> $pinfo){
                                                                                        $pinfo_index = array_search($pinfo['id'], array_column($variations[$index]['type_redems'][$indexx]['player_info'], 'pinfo_id'));
//                                                                                        print_r($variations[$index]['type_redems'][$index]['player_info'][$pinfo_index]['pinfo_id']);
                                                                                ?>
                                                                                        <label class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" value="<?=$pinfo['id']?>" name="item_type[<?=$key;?>][item_redem][<?=$k?>][player_info_in][<?=$pi?>][id]"
                                                                                                <?=(
                                                                                                (
                                                                                                    isset($_GET['e']) &&
                                                                                                    isset($variations[$index]['type_redems'][$indexx]['player_info']) &&
                                                                                                    $type['id'] == $variations[$index]['type_id'] &&
                                                                                                    $redem['id'] == $variations[$index]['type_redems'][$indexx]['redem_id'] &&
                                                                                                    $pinfo['id'] == $variations[$index]['type_redems'][$indexx]['player_info'][$pinfo_index]['pinfo_id']
                                                                                                )
                                                                                                    ?'checked':''
                                                                                                )?>
                                                                                            >
                                                                                            <span class="custom-control-indicator"></span>
                                                                                            <span class="custom-control-description"><?=$pinfo['title']?></span>
                                                                                        </label>
                                                                                <?php }?>
                                                                                </div>
                                                                        <?php }?>
                                                                    </div>
                                                                    <div id="playerInfo<?=$type['id']?>" class="tab-pane <?=(isset($_GET['e']) && isset($variations[$index]['player_info'])?'active':'')?>">
                                                                        <?php
                                                                        foreach ($player_info as $pk => $info){

//                                                                            print_r($variations[$index]['player_info'][$info_index]['pinfo_id']);
                                                                            $info_index = array_search($info['id'], array_column($variations[$index]['player_info'], 'pinfo_id'));

                                                                            ?>
                                                                            <label class="custom-control custom-checkbox pt-2">
                                                                                <input type="checkbox" class="custom-control-input" value="<?=$info['id']?>" name="item_type[<?=$key;?>][player_info][<?=$pk?>][id]"
                                                                                    <?=(
                                                                                    (
                                                                                        isset($_GET['e']) &&
                                                                                        isset($variations[$index]['player_info']) &&
                                                                                        $info['id'] == $variations[$index]['player_info'][$info_index]['pinfo_id']
                                                                                    )
                                                                                        ?'checked':''
                                                                                    )?>
                                                                                >
                                                                                <span class="custom-control-indicator"></span>
                                                                                <span class="custom-control-description"><?=$info['title']?></span>
                                                                            </label>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            </div>
                                                        </div>
                                            <?php }?>
                                        </div>


                                    </div>

                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <h6 class="mb-1">Thumbnail <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                    <input type="file" name="thumbnail" data-provide="dropify" id="thumbnail" data-default-file="<?=(isset($_GET['e']) && !empty($_GET['e'])?MI_BASE_URL.$topup['thumb']:'')?>">
                                                </div>

                                                <div class="form-group">
                                                    <h6 class="mb-1">Banner <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                    <input type="file" name="banner" data-provide="dropify" id="banner" data-default-file="<?=(isset($_GET['e']) && !empty($_GET['e'])?MI_BASE_URL.$topup['banner']:'')?>">
                                                </div>

                                                <div class="form-group">
                                                    <select class="form-control" name="status">
                                                        <option value="1" <?=($topup['status'] == 1?'selected':'')?>>Active</option>
                                                        <option value="2" <?=($topup['status'] == 2?'selected':'')?>>In active</option>
                                                    </select>
                                                    <label class="label-floated">Status</label>
                                                </div>

                                                <button class="btn btn-dark float-right w-100 mt-4" type="submit" name="edit_game_topup">
                                                    Update top up&nbsp;<i class="fa fa-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?=mi_include('footer_extra.php');?>
    </main>
<?=mi_footer();?>