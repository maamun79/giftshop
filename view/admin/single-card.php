<?php
$role_session = mi_get_session('role');
if ($role_session['card_management'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}

if (isset($_GET['ce']) && !empty($_GET['ce'])){
    $card_id = mi_secure_input(base64_decode($_GET['ce']));

    $card = mi_db_read_by_id('gift_cards', array('id'=> $card_id))[0];
    $variations = json_decode($card['variation'], true);

}else{
    mi_redirect(MI_BASE_URL.'admin/gift-card.php');
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
                    <h4 class="card-title"><strong>Edit Gift Card</strong></h4>
                    <div class="card-body form-type-material">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="edit_gift_card_id" value="<?=$card['id']?>">
                            <!--=================================-->
                            <div class="row">
                                <div class="col-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name" value="<?=(isset($_GET['ce']) && !empty($_GET['ce'])?$card['name']:'')?>">
                                                <label for="name">Name</label>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="description" class="form-control" id="description" rows="10"><?=(isset($_GET['ce']) && !empty($_GET['ce'])?$card['description']:'')?></textarea>
                                                <label for="title">Description</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="variations_container <?=($card['type'] == 1?'d-none':'')?>">
                                        <h4 class="font-weight-bold">Variations</h4>
                                        <div class="form-group">
                                            <?php
                                            $card_types = mi_db_read_by_id('card_types', array('status'=>1));
                                            $card_options = mi_db_read_by_id('card_options', array('status'=>1));

                                            foreach ($card_types as $key => $type){
                                                $index = array_search($type['id'], array_column($variations, 'region_id'));
                                                ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6>Card Types</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input card-type-selection" value="<?=$type['id']?>" name="card_type[<?=$key;?>][id]" data-key="card-type-selection-<?=$key;?>"
                                                                <?=((isset($_GET['ce']) && $type['id'] == $variations[$index]['region_id'])?'checked':'')?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description"><?=$type['name']?></span>
                                                        </label>
                                                        <br>

                                                        <div class="form-group pl-5 card-type-selection-<?=$key;?> <?=((isset($_GET['ce']) && $type['id'] == $variations[$index]['region_id'])?'':'d-none')?>">
                                                            <h6>Card Options</h6>
                                                            <?php
                                                            foreach ($card_options as $ok => $option){
                                                                $option_index = array_search($option['id'], array_column($variations[$index]['region_options'], 'option_id'));
                                                                ?>
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input card-type-selection" value="<?=$option['id']?>" name="card_type[<?=$key;?>][card_option][<?=$ok?>][id]"
                                                                        <?=(
                                                                        (
                                                                            isset($_GET['ce']) &&
                                                                            isset($variations[$index]['region_options']) &&
                                                                            $type['id'] == $variations[$index]['region_id'] &&
                                                                            $option['id'] == $variations[$index]['region_options'][$option_index]['option_id']
                                                                        )
                                                                            ?'checked':''
                                                                        )?>>
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description"><?=$option['name']?></span>
                                                                </label>

                                                            <?php }?>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="price" name="price" value="<?=(isset($_GET['ce']) && !empty($_GET['ce'])?$card['price']:'')?>">
                                                <label for="name">Price</label>
                                            </div>

                                            <div class="form-group">
                                                <h6 class="mb-1">Thumbnail <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                <input type="file" name="thumbnail" data-provide="dropify" id="thumbnail" data-default-file="<?=(isset($_GET['ce']) && !empty($_GET['ce'])?MI_BASE_URL.$card['thumb']:'')?>">
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" name="gift_card_type" id="gift_card_type">
                                                    <option value="2" <?=($card['type']==2?'selected':'')?>>Condition</option>
                                                    <option value="1" <?=($card['type']==1?'selected':'')?>>Regular</option>
                                                </select>
                                                <label class="label-floated">Gift Card Type</label>
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" name="status">
                                                    <option value="1" <?=($card['status']==1?'selected':'')?>>Active</option>
                                                    <option value="2" <?=($card['status']==2?'selected':'')?>>In active</option>
                                                </select>
                                                <label class="label-floated">Status</label>
                                            </div>

                                            <button class="btn btn-dark float-right w-100 mt-4" type="submit" name="edit_gift_card">
                                                Update Gift Card&nbsp;<i class="fa fa-save"></i>
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
