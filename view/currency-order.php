<?php
    $data = mi_get_session('currency_order_details');
    if (empty($data)){
        mi_redirect(MI_BASE_URL);
    }
    $ex_method = mi_db_read_by_id('exchanger', array('id'=> $data['method_id']))[0];

?>
<?=mi_header();?>
<?=mi_nav();?>
<div class="breadcrumb-area gray-bg-3 p-2">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="<?=MI_BASE_URL;?>">Home</a></li>
                <li class="active">Currency</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details pt-4 pb-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="product-details-content">
                    <div class="card">
                        <div class="card-body">
                            <h4>Exchange Details</h4>
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Exchange Amount :</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <h5> <?= $data['amount']?> USD</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Method :</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <h5> <?= $data['method']?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Current Rate :</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <h5> <?= $data['rate']?> BDT</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Exchange Type :</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <h5> <?= ($data['option'] == 1?'Buy':'Sell')?></h5>
                                    </div>
                                </div>
                                <hr class="m-3 p-2">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Total Amount :</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <strong><h4> <?= $data['total']?> BDT</h4></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <?php if ($data['option'] == 1){?>
                    <div class="product-details-content mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4>Receiver Information</h4>
                                <ul class="ul-paymentChannels">
                                    <li id="paymentChannel_470" class="payment-channel-element on active">
                                        <div class="payment-channel-link">
                                            <div class="payment-option-container row">
                                                <div class="col-6">
                                                    <input type="text" class="pro-chx form-control" placeholder="Enter receiver name" id="receiver_name" name="receiver_name" required>
                                                </div>
                                                <div class="col-6">
                                                    <input type="email" class="pro-chx form-control" placeholder="Enter receiver account email address" id="receive_account_email" name="receive_account_email" required>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="product-details-content">
                    <div class="card">
                        <div class="card-body">
                            <h4>Payment Options</h4>
                            <?php if ($data['option'] == 1){ ?>
                                <ul class="ul-paymentChannels">

                                    <li id="paymentChannel_470" class="payment-channel-element on active">
                                        <div class="payment-channel-link">
                                            <div class="mi_payment_note">
                                                <p>
                                                    Please complete your bKash payment at first, then fill up the form below.
                                                    Also note that 2% bKash "SEND MONEY" cost will be added with net price.
                                                    <br>Total amount you need to send us at
                                                </p>
                                                <h5>BKash Number : 01676707067</h5>
                                            </div>

                                            <div class="payment-channel-container">
                                                <figure class="payment-logo-container">
                                                    <img class="logo" src="<?=MI_BASE_URL;?>uploads/BKash_CHNL_LOGO.png" alt="BKash logo">
                                                </figure>
                                            </div>

                                            <div class="payment-price-container card-prc">
                                                <div class="price_label" id="priceLabel_470">PRICE</div>
                                                <div class="price pr" id="currencyPriceInfo" order-amount = "<?= $data['total'] ?>"><?='Tk '.$data['total'];?></div>
                                            </div>
                                            <div class="payment-option-container row">
                                                <div class="col-6">
                                                    <input type="tel" class="pro-chx form-control" placeholder="Enter your sender Bkash number" id="payment_number" name="payment_number" required>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="pro-chx form-control" placeholder="Enter Bkash Transaction ID" id="payment_trx" name="payment_trx" required>
                                                </div>
                                                <div class="col-12">
                                                    <input type="email" class="pro-chx form-control mt-3" placeholder="Enter your contact mail address" id="order_email" name="order_email" required>
                                                </div>
                                            </div>
                                            <div class="payment-tagline-container">
                                                <p class="payment-tagline" id="payment-channel__tagline_470">Pay with bKash</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            <?php }else{ ?>
                                    <ul class="ul-paymentChannels">

                                        <li id="paymentChannel_470" class="payment-channel-element on active">
                                            <div class="payment-channel-link">
                                                <div class="mi_payment_note">
                                                    <p>
                                                        Please send us your currency to our account address at first, then fill up the form below.
                                                        <br>Total amount you need to send us at
                                                    </p>
                                                    <h5>Account Address : <?=$ex_method['company_mail']?></h5>
                                                    <p>Amount : <?= $data['amount']?> USD <?= $data['method']?></p>
                                                </div>

                                                <div class="payment-option-container row">
                                                    <div class="col-6">
                                                        <input type="text" class="pro-chx form-control" placeholder="Enter sender acoount mail address" id="sender_mail" name="sender_mail" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="pro-chx form-control" placeholder="Enter payment transaction ID" id="trans_id" name="trans_id" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="tel" class="pro-chx form-control mt-3" placeholder="Enter your Bkash number to receive amount" id="receive_bkash_number" name="receive_bkash_number" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success btn-lg mi-buy-now currency_order_btn" type="button">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="width: 1.5rem; height: 1.5rem;"></span> <?=($data['option'] == 1?'Buy':'Sell')?> Now
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
            <?=mi_include('inc/related-products.php');?>
        </div>
    </div>
</div>
<?=mi_footer();?>
