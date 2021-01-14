<?php
$role_session = mi_get_session('role');
if ($role_session['orders'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}
?>


<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>
<?php

if (isset($_GET['eo']) && !empty($_GET['eo'])){
    $or = mi_secure_input(base64_decode($_GET['eo']));
    $get_ord = mi_db_read_by_id('currency_orders', array('id'=>$or));
    if (count($get_ord)>0){
        $order = $get_ord[0];
    }else{
        mi_redirect(MI_BASE_URL.'admin/currency-orders.php');
    }
}
?>

<style>
    .pro-info-table table tr th, .pro-info-table table tr td{
        margin: 0;
        line-height: 19px;
        font-size: 12px;
        padding: 1px 5px;
        border: none;
        border-bottom: 1px solid #e3e3e3;
    }
    .mi_order_details{
        margin-top: 4rem;
    }
</style>

<!-- Main container -->
<main>

    <div class="main-content">
        <div class="row card mi_order_details border p-3 w-100">
            <div class="card-header">
                <div class="col-12">
                    <h4 class="float-left">Order Details - #<?=$order['order_id'];?></h4>
                    <button class="btn bg-danger float-right deleteOrder" val="<?=$order['id']?>"><i class="icon fa fa-trash"></i></button>
                    <button class="btn float-right mr-2" onclick="printDiv('mi_order_details_admin');"><i class="icon fa fa-print"></i></button>
                    <div class="form-group form-type-material float-right m-0 mr-2" style="width: 180px;padding-top: 2px;">
                        <?php if ($order['order_status'] == 5) { ?>
                            <h6 class="text-danger">Cancelled</h6>
                        <?php } else { ?>
                            <select class="form-control orderStatus" order_id="<?=$order['id']?>" order-type="3">
                                <option value="1" <?=($order['order_status'] == 1)?'selected':'';?>>Pending</option>
                                <option value="2" <?=($order['order_status'] == 2)?'selected':'';?>>Confirm</option>
                                <option value="3" <?=($order['order_status'] == 3)?'selected':'';?>>Completed</option>
                                <option value="4" <?=($order['order_status'] == 4)?'selected':'';?>>Cancelled</option>
                            </select>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="card-body" id="mi_order_details_admin">
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <h5 class="font-weight-bolder border-bottom">Order Info</h5>
                        <p class="mb-0"><i class="fa fa-shopping-bag"></i> &nbsp;Order ID: #<?=$order['order_id'];?></p>
                        <p>
                            <i class="fa fa-calendar"></i>&nbsp; <?=date('M d, Y', strtotime($order['created_at']))?> &nbsp;&nbsp;
                            | &nbsp;&nbsp;
                            <i class="fa fa-clock"></i>&nbsp; <?=date('H:i a', strtotime($order['created_at']))?>
                        </p>
                        <h5 class="text-success">
                            Status: &nbsp;
                            <?php if ($order['order_status'] == 1){
                                echo 'Pending';
                            }elseif($order['order_status'] == 2){
                                echo 'Confirm';
                            }elseif($order['order_status'] == 3){
                                echo 'Completed';
                            }elseif($order['order_status'] == 4){
                                echo 'Cancelled';
                            }else{
                                echo 'N/A';
                            }
                            ?>
                        </h5>
                    </div>
                    <div class="col-sm-4 col-12">
                        <h5 CLASS="pb-0 mb-0 border-bottom">Payment Info</h5>
                        <?php if ($order['exchange_type'] == 1){?>
                            <p class="pb-0 mb-0 font-weight-bolder">
                                Sender Bkash Number : <?=$order['sender_bkash_number']?>
                            </p>
                            <p class="pb-0 mb-0 font-weight-bolder">
                                Trx ID : <?=$order['bkash_transaction_id']?>
                            </p>
                            <p class="pb-0 mb-0 font-weight-bolder">
                                Receiver Name : <?=$order['receiver_name']?>
                            </p>
                            <p class="pb-0 mb-0 font-weight-bolder">
                                Receiving Account Email : <?=$order['received_account_mail']?>
                            </p>
                        <?php }elseif($order['exchange_type'] == 2){?>
                            <p class="pb-0 mb-0 font-weight-bolder">
                                Sender Account Email : <?=$order['sender_account_mail']?>
                            </p>
                            <p class="pb-0 mb-0 font-weight-bolder">
                                Trx ID : <?=$order['payment_transaction_id']?>
                            </p>
                            <p class="pb-0 mb-0 font-weight-bolder">
                                Receiving Bkash Number : <?=$order['receive_bkash_number']?>
                            </p>
                        <?php }?>
                    </div>
                    <div class="col-sm-4 col-12 text-right">
                        <h5 class="border-bottom">Customer Info</h5>
                        <p class="mb-0">User IP : <?=$order['user_ip']?></p>
                        <p class="mb-0">Order Email : <?=$order['order_email']?></p>
                    </div>

                    <div class="col-12">
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h5>Exchange Details</h5>
                        <table class="table table-bordered text-nowrap">
                            <thead>
                            <tr>
                                <th>Exchanger Information</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $ex_method = mi_db_read_by_id('exchanger', array('id'=> $order['exchange_method_id']))[0];
                            ?>
                            <tr>

                                <td class="pro-info-table">
                                    <h5 class="pb-0 mb-0 font-weight-bolder float-left"><?=$ex_method['name'];?></h5>
                                    <div class="clearfix"></div>
                                    <hr style="margin: 10px 0px;">
                                    <table class="table table-bordered detTable">
                                        <tbody>
                                            <tr>
                                                <th><strong>Exchange Amount</strong></th>
                                                <td><?=(!empty($order['exchange_amount']))?$order['exchange_amount']:'';?> USD</td>
                                                <th><strong>Exchange Type</strong></th>
                                                <td><?=(!empty($order['exchange_type']) && $order['exchange_type'] == 1)?'Buy':'Sell';?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Exchange Rate</strong></th>
                                                <td><?=(!empty($order['exchange_rate']))?$order['exchange_rate']:'';?> BDT</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-right">
                                    <h3>BDT <?=$order['order_amount'];?></h3>
                                </td>
                            </tr>


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>
                                    <h2 class="text-success">Total</h2>
                                </th>
                                <th>
                                    <h2 class="text-right text-success">BDT <?=$order['order_amount'];?></h2>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
<script>
    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
