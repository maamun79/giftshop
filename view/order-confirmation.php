<?php mi_set_meta('site_base', 0);?>
<?=mi_header();?>
<?=mi_nav();?>

<?php
    if (isset($_GET['o']) && !empty($_GET['o'])){
        $order_id = base64_decode($_GET['o']);
    }else{
        mi_redirect(MI_BASE_URL);
    }
?>


<div class="pb-35 pt-30">
    <div class="container text-center">
        <img src="<?=MI_BASE_URL.'images/thank-you.png'?>" alt="" style="max-width: 350px">
        <p>Your order submitted successfully! We will contact with you within 24 hours.</p><br>
        <p>Your Order ID : <strong><?= $order_id;?></strong></p>
        <u><a href="<?=MI_BASE_URL?>">Continue Shopping</a></u>
    </div>
</div>

<?=mi_footer();?>
