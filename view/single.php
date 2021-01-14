<?php
    mi_set_meta('site_base', 1);
    if (isset($_GET['game']) && !empty($_GET['game']) && is_numeric(base64_decode($_GET['game']))){
        $get_game = mi_db_read_by_id('game_topup', array('id'=>mi_secure_input(base64_decode($_GET['game'])), 'status'=>1));
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
                            <img class="img-fluid w-100" src="<?=$get_game[0]['banner'];?>" alt=""/>
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
                        <input type="hidden" id="topup-id" value="<?=$get_game[0]['id']?>">
                        <?php
                            if (count($variations)>0){
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
                                                        id="type_<?=$vari['type_id'];?>"
                                                        name="item_type"
                                                        class="pro-chx"
                                                        value="<?=$get_game[0]['id'];?>"
                                                        type_id="<?=$vari['type_id'];?>"
                                                        type_price="<?=$vari['type_price'];?>"
                                                >
                                                <div class="clab"><?=$vari['type_name'];?></div>
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
                                    <h4>Choose Item Redeems</h4>
                                    <ul class="chec-radio">

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="product-details-content mt-3" id="item_player_container">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Choose Player Info</h4>
                                    <ul class="chec-radio">

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="product-details-content mt-3" id="item_player_credentials">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row m-0 p-0" id="via_character">
                                        <div class="col-12">
                                            <h4>Player Character Details</h4>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label>Character ID</label>
                                            <input type="text" name="character_id" class="pro-chx form-control" id="character_id" placeholder="Enter Player Character ID">
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <label>Character Name</label>
                                                    <input type="text" name="character_name" class="pro-chx form-control" id="character_name" placeholder="Enter Player Character Name">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12 radio-inline">
                                                    <label>Player Contact Number</label>
                                                    <input type="text" name="character_number" class="pro-chx form-control" id="character_number" placeholder="Enter Player Contact Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0" id="via_login">
                                        <div class="col-12">
                                            <h4>Player Login Details</h4>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label>Login Info Type</label><br>
                                            <input type="radio" name="login_info_type" class="w-auto h-auto" value="facebook" checked> &nbsp;&nbsp;Facebook &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="login_info_type" class="w-auto h-auto" value="google"> &nbsp;&nbsp;Google
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label>Login Id</label>
                                            <input type="text" name="login_id" class="pro-chx form-control" id="login_id" placeholder="Enter Player Login ID">
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <label>Login Password</label>
                                                    <input type="password" name="login_password" class="pro-chx form-control" id="login_password" placeholder="Enter Player Login Password">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12 radio-inline">
                                                    <label>Player Contact Number</label>
                                                    <input type="text" name="player_number" class="pro-chx form-control" id="player_number" placeholder="Enter Player Contact Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="product-details-content mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Payment Selection</h4>
                                    <?=mi_include('inc/payment_methods.php');?>
                                    <?=payment_methods();?>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-success mi-buy-now topup-order" type="button" disabled>
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
                    $topups = mi_db_read_by_id('game_topup', array('status'=> 1));
                    foreach ($topups as $game){?>
                        <div class="devita-product-2">
                            <div class="product-img">
                                <a href="<?=MI_BASE_URL.'game/'.base64_encode($game['id']);?>"><img src="<?=MI_BASE_URL.$game['thumb']?>" alt=""></a>
                            </div>
                            <h6 class="text-center pb-3"><a href="<?=MI_BASE_URL.'game/'.base64_encode($game['id']);?>"><?=$game['name']?></a></h6>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
<?=mi_footer();?>
