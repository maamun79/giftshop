<?php
if (isset($_GET['search']) && !empty($_GET['search'])){
    $topup_data    = mi_db_custom_query("SELECT * FROM game_topup WHERE name LIKE '%".$_GET['search']."%' AND status = 1 ORDER BY id DESC LIMIT 20");
    $giftcard_data = mi_db_custom_query("SELECT * FROM gift_cards WHERE name LIKE '%".$_GET['search']."%' AND status = 1 ORDER BY id DESC LIMIT 20");

}else{
    mi_redirect(MI_BASE_URL);
}

?>

<?php mi_set_meta('site_base', 0);?>
<?=mi_header();?>
<?=mi_nav();?>


<div class="pb-35 pt-50" style="padding-bottom: 100px">
    <div class="container">
        <h4 class="text-center">Search results</h4>
        <hr style="margin: 35px 0">

        <div class="row pt-5">
            <?php if (count($topup_data) > 0){?>
                <div class="col-md-6">
                    <h5 class="text-center">Game Topup</h5>
                    <hr style="margin: 15px">
                    <?php foreach ($topup_data as $top){?>
                        <div class="row p-3">
                            <div class="col-md-3">
                                <a href="<?=MI_BASE_URL.'game/'.base64_encode($top['id']);?>">
                                    <img src="<?= MI_BASE_URL.$top['thumb']?>" alt="" style="height: 100px;width: 100px">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h4 class="search_item_title">
                                    <a href="<?=MI_BASE_URL.'game/'.base64_encode($top['id']);?>"><?=$top['name']?>
                                    </a>
                                </h4>
                                <p class="text-justify">
                                    <?=((strlen($top['description'])>100)?substr($top['description'], '0', '150').'...':$top['description']); ?>
                                </p>
                            </div>
                        </div>
                    <?php }?>
                </div>
            <?php }

            if(count($giftcard_data) > 0){?>
                <div class="col-md-6">
                    <h5 class="text-center">Gift Card</h5>
                    <hr style="margin: 15px">
                    <?php foreach ($giftcard_data as $card){?>
                        <div class="row p-3">
                            <div class="col-md-3">
                                <a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>">
                                    <img src="<?= MI_BASE_URL.$card['thumb']?>" alt="" style="height: 100px;width: 100px">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h4 class="search_item_title">
                                    <a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>"><?=$card['name']?>
                                    </a>
                                </h4>
                                <p class="text-justify">
                                    <?=((strlen($card['description'])>100)?substr($card['description'], '0', '150').'...':$card['description']); ?>
                                </p>
                            </div>
                        </div>
                    <?php }?>
                </div>
            <?php }?>

            <?php if (count($topup_data) < 1 && count($giftcard_data) < 1){?>
                <p class="text-center">No results found</p>
            <?php }?>
        </div>

    </div>
</div>

<?=mi_footer();?>
