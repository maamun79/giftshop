
<?php
$role_session = mi_get_session('role');
if ($role_session['settings'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>
<?php
    $logo = mi_db_read_by_id('settings_meta', array('meta_name' => 'site_logo', 'type'=>'nav_front'))[0];
    $footer_text = mi_db_read_by_id('settings_meta', array('meta_name' => 'footer_text', 'type'=>'footer'))[0];
    $footer_link = mi_db_read_by_id('settings_meta', array('meta_name' => 'footer_link', 'type'=>'footer'))[0];

    $sliders = mi_db_read_all('slider');
    $banners = mi_db_read_by_id('settings_meta', array('type'=> 'banner'));
    $features = mi_db_read_by_id('settings_meta', array('type'=> 'feature'));

    $footer_banner = mi_db_read_by_id('settings_meta', array('meta_name'=>'footer_image','type'=> 'footer'))[0];
    $footer_aboutus_img = mi_db_read_by_id('settings_meta', array('meta_name'=>'aboutus_img','type'=> 'footer'))[0];
    $footer_aboutus_text = mi_db_read_by_id('settings_meta', array('meta_name'=>'aboutus_text','type'=> 'footer'))[0];
    $social_icons = mi_db_read_by_id('settings_meta', array('type' => 'social_icon'));
    $contact_info = mi_db_read_by_id('settings_meta', array('meta_name' => 'contact_info', 'type'=> 'contact'))[0];

?>
<main>
    <div class="main-content">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <h4><strong>Settings</strong></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-body form-type-material">
                    <div class="form-group">

                        <div class="row">
                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                <h6 class="code-title">Site Logo</h6>
                                <div class="code-preview">
                                    <div class="media">
                                        <div class="media-body">
                                            <img src="<?=MI_BASE_URL.$logo['meta_value'];?>" style="width:225px;">
                                        </div>
                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeLogo">
                                            <span class="fa fa-pencil lead text-info"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="code-toggler">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                <h6 class="code-title">Footer Copyright</h6>

                                <div class="code-preview">
                                    <div class="media">
                                        <div class="media-body">
                                            <p><?=$footer_text['meta_value']?></p>
                                        </div>
                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeFooterCopyright">
                                            <span class="fa fa-pencil lead text-info"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="code-toggler">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                <h6 class="code-title">Copyright Link</h6>

                                <div class="code-preview">
                                    <div class="media">
                                        <div class="media-body">
                                            <p><?=$footer_link['meta_value']?></p>
                                        </div>
                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeCopyrightLink">
                                            <span class="fa fa-pencil lead text-info"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="code-toggler">
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

        <h6>Banner Slider</h6>
        <div class="row">
            <?php
                foreach ($sliders as $slider){
            ?>
                    <div class="col-md-4 col-lg-4 code code-card code-fold">
                        <h6 class="code-title"><?=$slider['banner_title']?></h6>
                        <div class="code-preview">
                            <div class="media">
                                <div class="media-body">
                                    <img src="<?=MI_BASE_URL.$slider['image'];?>" style="width:350px;">
                                    <p class="pt-3"><?=$slider['banner_text']?></p>
                                </div>
                                <button type="button" class="btn" data-toggle="modal" data-target="#changeSlider-<?=$slider['id']?>">
                                    <span class="fa fa-pencil lead text-info"></span>
                                </button>
                            </div>
                        </div>

                        <div class="code-toggler">
                        </div>
                    </div>
            <?php }
            ?>
        </div>

        <h6 class="pt-2">Page Banner</h6>
        <div class="row">
            <?php
            foreach ($banners as $banner){
                ?>
                <div class="col-md-4 col-lg-4 code code-card code-fold">
                    <h6 class="code-title"><?=ucfirst(str_replace('_',' ',$banner['meta_name']))?></h6>
                    <div class="code-preview">
                        <div class="media">
                            <div class="media-body">
                                <img src="<?=MI_BASE_URL.$banner['meta_value'];?>" style="width:350px;">
                            </div>
                            <button type="button" class="btn" data-toggle="modal" data-target="#changeBanner-<?=$banner['id']?>">
                                <span class="fa fa-pencil lead text-info"></span>
                            </button>
                        </div>
                    </div>

                    <div class="code-toggler">
                    </div>
                </div>
            <?php }
            ?>
        </div>

        <h6 class="pt-2">Feature Items</h6>
        <div class="row">
            <?php
            foreach ($features as $feature){
                $data = json_decode($feature['meta_value'], true);
                ?>
                <div class="col-md-4 col-lg-4 code code-card code-fold">
                    <h6 class="code-title">Feature Item</h6>
                    <div class="code-preview">
                        <div class="media">
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?=MI_BASE_URL.$data['icon'];?>" style="width:50px;">
                                    </div>
                                    <div class="col-md-8">
                                        <h5><?=$data['title']?></h5>
                                        <p><?=$data['text']?></p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn" data-toggle="modal" data-target="#changeFeature-<?=$feature['id']?>">
                                <span class="fa fa-pencil lead text-info"></span>
                            </button>
                        </div>
                    </div>

                    <div class="code-toggler">
                    </div>
                </div>
            <?php }
            ?>
        </div>

        <h6 class="pt-2">Footer Items</h6>
        <div class="row">
            <div class="col-md-4 col-lg-4 code code-card code-fold">
                <h6 class="code-title">Footer Banner</h6>
                <div class="code-preview">
                    <div class="media">
                        <div class="media-body">
                            <div class="row">
                                <img src="<?=MI_BASE_URL.$footer_banner['meta_value'];?>" style="width:325px;">
                            </div>
                        </div>
                        <button type="button" class="btn" data-toggle="modal" data-target="#changeFooterBanner">
                            <span class="fa fa-pencil lead text-info"></span>
                        </button>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>

            <div class="col-md-4 col-lg-4 code code-card code-fold">
                <h6 class="code-title">About Us Image</h6>
                <div class="code-preview">
                    <div class="media">
                        <div class="media-body">
                            <div class="row">
                                <img src="<?=MI_BASE_URL.$footer_aboutus_img['meta_value'];?>" style="width:325px;">
                            </div>
                        </div>
                        <button type="button" class="btn" data-toggle="modal" data-target="#changeAboutUsImg">
                            <span class="fa fa-pencil lead text-info"></span>
                        </button>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>

            <div class="col-md-4 col-lg-4 code code-card code-fold">
                <h6 class="code-title">About Us Text</h6>
                <div class="code-preview">
                    <div class="media">
                        <div class="media-body">
                            <div class="row">
                                <p><?=$footer_aboutus_text['meta_value']?></p>
                            </div>
                        </div>
                        <button type="button" class="btn" data-toggle="modal" data-target="#changeAboutUsText">
                            <span class="fa fa-pencil lead text-info"></span>
                        </button>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>

            <div class="col-md-4 col-lg-4 code code-card code-fold">
                <h6 class="code-title">Social Icons</h6>

                <div class="code-preview">
                    <div class="media">
                        <div class="media-body">
                            <div class="row">
                                <?php foreach ($social_icons as $icon){?>
                                    <div class="col-md-2 col-lg-2">
                                        <a href="https://<?=$icon['meta_value']?>" target="_blank">
                                            <span class="fa fa-<?=$icon['meta_name']?> lead text-info"></span>
                                        </a>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                        <button type="button" class="btn" data-toggle="modal" data-target="#changeSocialIcon">
                            <span class="fa fa-pencil lead text-info"></span>
                        </button>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>

            <div class="col-md-4 col-lg-4 code code-card code-fold">
                <h6 class="code-title">Contact Information</h6>

                <div class="code-preview">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-justify"><?=$contact_info['meta_value']?></p>
                        </div>
                        <button type="button" class="btn" data-toggle="modal" data-target="#changeContactInfo">
                            <span class="fa fa-pencil lead text-info"></span>
                        </button>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>

        </div>
        <!--=========================================Modal Items=============================================-->


        <!------------------------modal logo change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeLogo" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Site Logo</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="site_logo_id" value="<?=$logo['id']?>">

                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Site Logo <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="site_logo" data-provide="dropify" data-default-file="<?=(!empty($logo['meta_value']))?MI_BASE_URL.$logo['meta_value']:'';?>" id="site_logo">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_site_logo_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------end modal logo change------------------------->


        <!----------------------------modal footer copyright change------------------>
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeFooterCopyright" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Footer Copyright</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="footer_copyright_id" value="<?=$footer_text['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="footer_copyright" name="footer_copyright" value="<?=$footer_text['meta_value']?>">
                                            <label for="footer_copyright">Footer Copyright</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_footer_copyright_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!----------------------------modal footer copyright change------------------>

        <!----------------------------modal copyright link change------------------>
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeCopyrightLink" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Copyright Link</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="copyright_link_id" value="<?=$footer_link['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="copyright_link" name="copyright_link" value="<?=$footer_link['meta_value']?>">
                                            <label for="copyright_link">Copyright Link</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_copyright_link_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!----------------------------modal copyright link change------------------>


        <!----------------------------Slider change modal-------------------------->
        <!-- Modal -->
        <?php foreach ($sliders as $slider){?>
        <div class="modal modal-center fade" id="changeSlider-<?=$slider['id']?>" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Banner Slider</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="edit_slider_id" value="<?=$slider['id']?>">

                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="banner_title" value="<?=$slider['banner_title']?>">
                                            <label for="">Banner Title</label>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="banner_text" class="form-control" rows="5"><?=$slider['banner_text']?></textarea>
                                            <label for="">Banner Text</label>
                                        </div>
                                        <div class="form-group">
                                            <h6 class="mb-1">Slider Image <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="banner_slider" data-provide="dropify" data-default-file="<?=(!empty($slider['image']))?MI_BASE_URL.$slider['image']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_banner_slider_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        <!--------------------------End Slider change modal------------------------>

        <!----------------------------Banner change modal-------------------------->
        <!-- Modal -->
        <?php foreach ($banners as $banner){?>
            <div class="modal modal-center fade" id="changeBanner-<?=$banner['id']?>" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change <?=ucfirst(str_replace('_',' ',$banner['meta_name']))?></h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                                <input type="hidden" name="edit_banner_id" value="<?=$banner['id']?>">

                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="card-body form-type-material">
                                            <div class="form-group">
                                                <h6 class="mb-1">Banner Image <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                <input type="file" name="banner_image" data-provide="dropify" data-default-file="<?=(!empty($banner['meta_value']))?MI_BASE_URL.$banner['meta_value']:'';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="change_page_banner_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <!--------------------------End Banner change modal------------------------>

        <!----------------------------Feature change modal-------------------------->
        <!-- Modal -->
        <?php
            foreach ($features as $feature){
                $data = json_decode($feature['meta_value'], true);
            ?>
            <div class="modal modal-center fade" id="changeFeature-<?=$feature['id']?>" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Feature Item</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                                <input type="hidden" name="edit_feature_id" value="<?=$feature['id']?>">

                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="card-body form-type-material">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="feature_title" value="<?=$data['title']?>">
                                                <label for="">Feature Title</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="feature_text" value="<?=$data['text']?>">
                                                <label for="">Feature Text</label>
                                            </div>
                                            <div class="form-group">
                                                <h6 class="mb-1">Feature Image <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                <input type="file" name="feature_image" data-provide="dropify" data-default-file="<?=(!empty($data['icon']))?MI_BASE_URL.$data['icon']:'';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="change_feature_item_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <!--------------------------End Slider change modal------------------------>

        <!------------------------modal footer banner change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeFooterBanner" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Footer Banner</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="edit_footer_banner_id" value="<?=$footer_banner['id']?>">

                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Banner Image <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="footer_banner_image" data-provide="dropify" data-default-file="<?=(!empty($footer_banner['meta_value']))?MI_BASE_URL.$footer_banner['meta_value']:'';?>" id="site_logo">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_footer_banner_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------end modal footer banner change------------------------->

        <!------------------------modal about us image change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeAboutUsImg" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change About us Image</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="edit_aboutus_img_id" value="<?=$footer_aboutus_img['id']?>">

                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Image <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="aboutus_image" data-provide="dropify" data-default-file="<?=(!empty($footer_aboutus_img['meta_value']))?MI_BASE_URL.$footer_aboutus_img['meta_value']:'';?>" id="site_logo">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_aboutus_img_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------end modal about us image change------------------------->

        <!----------------------------modal about us text change------------------>
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeAboutUsText" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change About Us Text</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="edit_aboutus_text_id" value="<?=$footer_aboutus_text['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <textarea name="aboutus_text" class="form-control" cols="30" rows="5"><?=$footer_aboutus_text['meta_value']?></textarea>
                                            <label for="">Text</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_aboutus_text_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------------End modal about us text change------------------>

        <!----------------------------modal social icon change------------------>
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeSocialIcon" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Social Icon</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <?php foreach ($social_icons as $key => $icon){?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="social_data[id][<?=$key?>]" value="<?=$icon['id']?>">
                                                        <input type="text" class="form-control" id="icon<?=$icon['id']?>" name="social_data[icon][<?=$key?>]" value="<?=$icon['meta_name']?>">
                                                        <label for="icon<?=$icon['id']?>">Icon Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="link<?=$icon['id']?>" name="social_data[link][<?=$key?>]" value="<?=$icon['meta_value']?>">
                                                        <label for="link<?=$icon['id']?>">Link</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_social_icon_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!----------------------------modal social icon change------------------>

        <!------------------------modal contact info change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeContactInfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Contact Information</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="contact_info_id" value="<?=$contact_info['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="card-title"><strong>Contact Info</strong></h6>
                                            <textarea name="contact_info" data-provide="summernote" data-toolbar="full" data-min-height="150"><?=$contact_info['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_contact_info_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end modal contact info change------------------------->

        <!--==============================================End Modal Items========================================-->
    </div>
    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
