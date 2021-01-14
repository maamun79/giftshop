<?php
    $footer_img = mi_db_read_by_id('settings_meta', array('meta_name'=> 'footer_image', 'type'=> 'footer'))[0];
    $aboutus_img = mi_db_read_by_id('settings_meta', array('meta_name'=> 'aboutus_img', 'type'=> 'footer'))[0];
    $aboutus_text = mi_db_read_by_id('settings_meta', array('meta_name'=> 'aboutus_text', 'type'=> 'footer'))[0];
    $social_icons = mi_db_read_by_id('settings_meta', array('type'=> 'social_icon'));
    $footer_copyright = mi_db_read_by_id('settings_meta', array('meta_name'=> 'footer_text', 'type'=> 'footer'))[0];
    $copyright_link = mi_db_read_by_id('settings_meta', array('meta_name'=> 'footer_link', 'type'=> 'footer'))[0];
?>
<div class="banner-area">
            <img alt="" src="<?=$footer_img['meta_value']?>">
        </div>
        <footer class="footer-area pt-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget footer-widget-red footer-black-color mb-40">
                            <div class="footer-title mb-30">
                                <h4>About Us</h4>
                            </div>
                            <div class="footer-about">
                                <img src="<?=$aboutus_img['meta_value']?>" class="mb-3">
                                <p><?=$aboutus_text['meta_value']?></p>
                                <div class="footer-map">
                                    <a href="contact.html">
                                        <i class="ion-ios-location-outline"></i>
                                        View on map
                                    </a>
                                </div>
                            </div>
                            <div class="social-icon mr-40">
                                <ul>
                                    <?php foreach ($social_icons as $icon){?>
                                        <li><a class="<?=str_replace('-','',$icon['meta_name'])?>" target="_blank" href="https://<?=$icon['meta_value']?>"><i class="ion-social-<?=str_replace('-','',$icon['meta_name'])?>"></i></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget footer-widget-red footer-black-color mb-40">
                            <div class="footer-title mb-30">
                                <h4>Information</h4>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    <li><a href="<?=MI_BASE_URL?>">Home</a></li>
                                    <li><a href="<?=MI_BASE_URL.'track-order.php'?>">Track Order</a></li>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget footer-widget-red mb-40 footer-black-color">
                            <div class="footer-title mb-30">
                                <h4>Latest Items</h4>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    <?php
                                        $topups = mi_db_read_by_id('game_topup', array('status'=> 1), '', 'id', 'DESC', 2);
                                        $cards = mi_db_read_by_id('gift_cards', array('status'=> 1), '', 'id', 'DESC', 2);
                                        foreach ($topups as $topup){?>
                                            <li><a href="<?=MI_BASE_URL.'game/'.base64_encode($topup['id']);?>"><?=$topup['name'];?></a></li>
                                    <?php }
                                        foreach ($cards as $card){?>
                                            <li><a href="<?=MI_BASE_URL.'card/'.base64_encode($card['id']);?>"><?=$card['name'];?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget footer-widget-red-2 mb-40 footer-black-color">
                            <div class="footer-title mb-30">
                                <h4>Join Our Newsletter Now</h4>
                            </div>
                            <div class="footer-newsletter">
                                <p>Get E-mail updates about our latest shop and special offers.</p>
                                 <div id="mc_embed_signup" class="subscribe-form-2">
                                    <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll" class="mc-form">
                                            <input type="email" value="" name="EMAIL" class="email" placeholder="Your Email Address..." required>
                                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                            <div class="mc-news" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                            <div class="clear-2"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom pb-25 pt-25 white-bg green-color border-top-2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="copyright text-center copyright-red footer-black-color">
                                <a href="<?=$copyright_link['meta_value']?>"><?=$footer_copyright['meta_value']?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- all js here -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/ajax-mail.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="plugins/toastr/toastr.min.js"></script>
        <script src="assets/js/mi.js"></script>
    </body>

</html>