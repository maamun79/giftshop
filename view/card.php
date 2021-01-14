<?php
    mi_set_meta('site_base', 1);
    if (isset($_GET['card']) && !empty($_GET['card']) && is_numeric(base64_decode($_GET['card']))){
        $get_game = mi_db_read_by_id('gift_cards', array('id'=>mi_secure_input(base64_decode($_GET['card'])), 'status'=>1));
        if (count($get_game)<=0){
            mi_redirect(MI_BASE_URL);
        }
        $variations = json_decode($get_game[0]['variation'], true);
    }else{
        mi_redirect(MI_BASE_URL);
    }
?>
<?=mi_header();?>
<?=mi_nav();?>
        <div class="breadcrumb-area gray-bg-3 p-2">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="<?=MI_BASE_URL;?>">Home</a></li>
                        <li class="active"><?=$get_game[0]['name'];?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-details pt-4 pb-65">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="product-details-img">
                            <img class="img-fluid w-100" src="<?=(!empty($get_game[0]['banner']))?$get_game[0]['banner']:$get_game[0]['thumb'];?>" alt=""/>
                        </div>

                        <div class="product-details-content">
                            <h3 class="mt-3"><?=$get_game[0]['name'];?></h3>
                            <div class="clearfix"></div>
                            <br>
                            <div class="text-justify">
                                <?=$get_game[0]['description'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <input type="hidden" id="gift-card-id" value="<?=$get_game[0]['id']?>">
                        <?php
                            if ($get_game[0]['type'] == 2 && count($variations)>0){
                        ?>
                        <div class="product-details-content">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Choose Item Type</h4>
                                    <ul class="chec-radio">
                                        <?php foreach ($variations as $vari){?>
                                        <li class="pz">
                                            <label class="radio-inline">
                                                <input
                                                        type="radio"
                                                        id="type_<?=$vari['region_id'];?>"
                                                        name="region_type"
                                                        class="pro-chx"
                                                        value="<?=$get_game[0]['id'];?>"
                                                        type_id="<?=$vari['region_id'];?>"
                                                >
                                                <div class="clab"><?=$vari['region_name'];?></div>
                                            </label>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php }?>

                        <div class="product-details-content mt-3" id="item_redeem_container">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Choose Options</h4>
                                    <ul class="chec-radio">

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="product-details-content mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Payment Options</h4>
                                    <?=mi_include('inc/payment_methods.php');?>
                                    <?=payment_methods(1, $get_game[0]['price']);?>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-success btn-lg mi-buy-now gift-card-order" type="button" <?=($get_game[0]['type'] == 2 && count($variations)>0)?'disabled':'';?>>
                                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1.5rem; height: 1.5rem;"></span> Buy Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-area pb-45">
            <div class="container">
                <div class="section-border mb-10">
                    <h4 class="section-title section-bg-white">Related Items</h4>
                </div>
                <div class="product-slider-nav nav-style"></div>
                <div class="headphone-slider-active product-slider owl-carousel nav-style">
                <?php
                    $giftcards = mi_db_read_by_id('gift_cards', array('status'=> 1));
                    foreach ($giftcards as $card){?>
                        <div class="devita-product-2">
                            <div class="product-img">
                                <a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>"><img src="<?=MI_BASE_URL.$card['thumb']?>" alt=""></a>
                            </div>
                            <h6 class="text-center pb-3"><a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>"><?=$card['name']?></a></h6>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
<?=mi_footer();?>
