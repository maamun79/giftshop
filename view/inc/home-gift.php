<?php
$get_games = mi_db_read_by_id('gift_cards', array('status'=>1), false, 'id', 'DESC', 10);
if (count($get_games)>0){
    foreach ($get_games as $game){
        ?>
        <div class="custom-col-5 mb-30">
            <div class="devita-product-2 mrg-inherit devita-product-red">
                <div class="product-img">
                    <a href="<?=MI_BASE_URL.'card/'.base64_encode($game['id']);?>"><img src="<?=MI_BASE_URL.$game['thumb'];?>" alt=""></a>
                </div>
                <h6 class="text-center pb-3 mt-2"><a href="<?=MI_BASE_URL.'game/'.base64_encode($game['id']);?>"><?=$game['name'];?></a></h6>
            </div>
        </div>
    <?php }}else{?>
    <h4>No Game Top Up Available</h4>
<?php }?>