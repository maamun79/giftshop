
<?php
    function related_products($pro_type){
        if ($pro_type == 1){
            $products = mi_db_read_by_id('game_topup', array('status'=> 1));
        }elseif($pro_type == 2){
            $products = mi_db_read_by_id('gift_cards', array('status'=> 1));
        }

        foreach ($products as $pro){?>

            <div class="devita-product-2">
                <div class="product-img">
                    <a href="<?=MI_BASE_URL.'game/'.base64_encode($pro['id']);?>"><img src="<?=MI_BASE_URL.$pro['thumb']?>" alt=""></a>
                </div>
                <h6 class="text-center pb-3"><a href="<?=MI_BASE_URL.'game/'.base64_encode($pro['id']);?>"><?=$pro['name']?></a></h6>
            </div>
<?php } }?>
