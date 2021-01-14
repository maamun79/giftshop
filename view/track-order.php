<?php mi_set_meta('site_base', 0);?>
<?=mi_header();?>
<?=mi_nav();?>

<div class="pb-35 pt-50" style="padding-bottom: 100px">
    <div class="container">
        <h4 class="text-center">Track Your Orders</h4>
        <hr style="margin: 35px 0">

<!--        =================================================-->
        <div class="mb-30 m-0 p-5 mi-tracking-form">
            <div class="row w-100">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                    <label>Order ID</label>
                    <input type="text" class="form-control" name="track_order_id" id="track_order_id" placeholder="Enter your order ID">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 form-group">
                    <label>Select Item Type</label>
                    <select class="form-control" name="order_item_type" id="order_item_type">
                        <option value="1">Game top up</option>
                        <option value="2">Gift Card</option>
                        <option value="3">Currency Exchange</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                    <label></label>
                    <button type="button" class="btn w-100 order-track-btn" id="order-track-btn">
                        Track Order &nbsp;&nbsp;<i class="fa fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
<!--        =================================================-->

        <!--        ------------------------order tracking------------------------>
        <div class="row justify-content-center pt-5">
            <div class="col-md-6" >

                <div class="card px-2 d-none" id="order-track-container">
                    <div class="card-header bg-white">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p class="text-muted track-details-order-id"> Order ID <span class="font-weight-bold text-dark"></span></p>
                            </div>
                            <div class="flex-col my-auto">
                                <p class="text-muted ml-auto mr-3 track-details-order-date"> Place On <span class="font-weight-bold text-dark"></span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="media flex-column flex-sm-row">
                            <div class="media-body ">

                                <div class="text-center mb-2">
                                    <h5 class="font-weight-bold track-details-item-type"></h5>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <p class="bold mb-0">Order total : <span class="mt-5">BDT</span> <span class="track-details-order-total"></span></p>
                                        <p class="bold mb-0 track-details-order-status">Order status : <span></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="currency-tracking-details d-none">
                                            <p class="bold ml-auto mr-2 track-details-ex-method mb-0"> Exchange Method : <span></span> </p>
                                            <p class="bold ml-auto mr-2 track-details-ex-type mb-0"> Exchange Type : <span></span> </p>
                                            <p class="bold ml-auto mr-2 track-details-ex-amount mb-0"> Exchange Amount : <span></span> </p>
                                        </div>
                                        <div class="topup-giftcard-tracking-img d-none">
                                            <img class="text-muted ml-auto mr-2 img-fluid track-details-order-img pull-right" src="" width="150 " height="120">
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col">
                            <ul id="progressbar">
                                <li class="step0 " id="step1">PENDING</li>
                                <li class="step0 text-center" id="step2">CONFIRM</li>
                                <li class="step0 text-muted text-right" id="step3">COMPLETED</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--        ------------------------order tracking------------------------>

    </div>
</div>

<?=mi_footer();?>
