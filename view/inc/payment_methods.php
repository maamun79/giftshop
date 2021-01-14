<?php function payment_methods($type=null, $price=0){?>

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

                <div class="payment-price-container <?=(isset($type) && $type == 2)?'':'card-prc';?>">
                    <div class="price_label" id="priceLabel_470">PRICE</div>
                    <div class="price pr" id="priceInfo" order-amount = "<?= $price ?>"><?=(isset($type) && $type == 2)?'':'Tk '.$price;?></div>
                </div>
                <div class="payment-option-container row">
                    <div class="col-6">
                        <input type="tel" class="pro-chx form-control" placeholder="Enter your Bkash number" id="payment_number" name="payment_number" required>
                    </div>
                    <div class="col-6">
                        <input type="text" class="pro-chx form-control" placeholder="Enter Bkash Transaction ID" id="payment_trx" name="payment_trx" required>
                    </div>
                    <div class="col-12">
                        <input type="email" class="pro-chx form-control mt-3" placeholder="Enter Order Email Address" id="order_email" name="order_email" required>
                    </div>
                </div>
                <div class="payment-tagline-container">
                    <p class="payment-tagline" id="payment-channel__tagline_470">Pay with bKash</p>
                </div>
            </div>
            <input type="hidden" id="price_470" name="price_total" value="<?=(isset($type) && $type == 2)?'Tk '.$price:'';?>">
        </li>
    </ul>

<?php }?>
