<?php mi_set_meta('site_base', 0);?>
<?=mi_header();?>
<?=mi_nav();?>
<?=mi_include('inc/slider.php');?>
<?php
    $banner_left = mi_db_read_by_id('settings_meta', array('meta_name'=> 'banner_left', 'type'=> 'banner'))[0];
    $banner_center = mi_db_read_by_id('settings_meta', array('meta_name'=> 'banner_center', 'type'=> 'banner'))[0];
    $banner_right = mi_db_read_by_id('settings_meta', array('meta_name'=> 'banner_right', 'type'=> 'banner'))[0];

    $feature_items = mi_db_read_by_id('settings_meta', array('meta_name'=> 'feature_item', 'type'=> 'feature'));

?>
        
        <div class="banner-area pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="banner-img banner-hover mb-30">
                            <img src="<?=$banner_left['meta_value']?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="banner-img banner-hover mb-30">
                            <img src="<?=$banner_center['meta_value']?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="banner-img banner-hover mb-30">
                            <img src="<?=$banner_right['meta_value']?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-area pt-35 pb-30">
            <div class="container">
                <div class="product-tab-list product-tab-list-red mb-30 nav" role="tablist">
                    <a class="active" href="#home1" data-toggle="tab">
                        <h4>Game Top Up</h4>
                    </a>
                    <a href="#home2" data-toggle="tab">
                        <h4>Gift Card</h4>
                    </a>
                </div>
                <div class="tab-content jump">
                    <div class="tab-pane active" id="home1">
                        <div class="custom-row">
                            <?=mi_include('inc/home-game.php');?>
                        </div>
                    </div>
                    <div class="tab-pane" id="home2">
                        <div class="custom-row">
                            <?=mi_include('inc/home-gift.php');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="services-area pb-35">
            <div class="container">
                <div class="mb-30 m-0 p-5 mi-converter-form">
                    <div class="row w-100 currency-converter">
                        <div class="col-12">
                            <h3 class="mb-5 pb-4 text-center">Currency Converter</h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" value="1" class="form-control" name="currency_amount" id="currency_amount">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group">
                            <?php
                                $exchangers = mi_db_read_by_id('exchanger', array('status' => 1));
                            ?>
                            <label>Option</label>
                            <select class="form-control" name="currency_option" id="currency_option">
                                <option value="1">Buy</option>
                                <option value="2">Sell</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group">
                            <label>Method</label>
                            <select class="form-control" name="currency_method" id="currency_method">
                                <?php foreach ($exchangers as $ex){?>
                                    <option value="<?=$ex['id']?>"><?=$ex['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <label></label>
                            <button type="button" class="btn w-100" id="currency-convert-btn">
                                Submit &nbsp;&nbsp;<i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="text-center pt-20 exchange_details d-none">

                    </div>
                    <div class="row text-center d-none currency-confirm-buttons">
                        <div class="col-md-6">
                            <button class="btn btn-sm pull-right" id="go-back-currency-convert-btn" style="height: 40px; font-size: 15px; margin: 0 auto">
                                Go Back &nbsp;&nbsp;<i class="fa fa-chevron-left"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="<?=MI_BASE_URL.'currency-order.php'?>" class="btn btn-warning pull-left pt-1" id="confirm-currency-convert-btn">
                                Confirm &nbsp;&nbsp;<i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="services-area pb-35">
            <div class="container">
                <div class="row">
                    <?php
                        foreach ($feature_items as $item){
                            $content = json_decode($item['meta_value'], true);
                    ?>
                        <div class="col-lg-4 col-md-4">
                            <div class="shop-service-content-4 mb-30">
                                <div class="service-content-4-img">
                                    <img src="<?=$content['icon']?>" alt="">
                                </div>
                                <div class="service-content-4-content">
                                    <h5><?=$content['title']?></h5>
                                    <p><?=$content['text']?></p>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>

<?=mi_footer();?>
