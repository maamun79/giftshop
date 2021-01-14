
<?php
    $sliders = mi_db_read_all('slider');
?>

<div class="slider-area">
            <div class="slider-active owl-dot-style-4 owl-dot-red owl-carousel">
                <?php foreach ($sliders as $slider){?>
                    <div class="single-slider pt-100 pb-110 bg-img slider-height-22" style="background-image:url(<?=$slider['image']?>);">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="slider-content toy-slider-content slider-animated-1 text-center">
                                        <h5 class="animated"><?=$slider['banner_title']?></h5>
                                        <h2 class="animated"><span><?=$slider['banner_text']?></span></h2>
    <!--                                    <div class="slider-btn mt-80">-->
    <!--                                        <a class="animated" href="product-details.html">shopping Now</a>-->
    <!--                                    </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>