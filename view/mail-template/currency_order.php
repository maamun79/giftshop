<?php
/**
 * Created by PhpStorm.
 * User: Sujon
 * Date: 8/20/2019
 * Time: 5:33 PM
 */


function mi_order_complete_invoice_template($data){
    $ex_method = mi_db_read_by_id('exchanger', array('id' => $data['exchange_method_id']))[0];

    $template = '<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">	
</head>

<body class="clean-body" style="margin: 0 auto;padding: 25px;background-color: #ffffff;max-width: 1000px;border: 1px solid #e3e3e3;">
	<div class="ie-browser">
	    <div class="container">   
            <div class="row">
                <div class="mi_thank_you_invoice">
                    <div class="col-12 text-center mt-2" style="text-align: center;">
                        <img src="https://i.ibb.co/kBJvdQj/logo-4.png" alt="Prothom Proneta" style="max-width: 300px;" class="m-auto">
                    </div>
                    <div class="col-12 text-center mt-4 mb-5" style="text-align: center;">
                        <img src="https://i.ibb.co/0yF9PYR/thank-you.png" alt="Prothom Proneta" style="max-width: 60%;padding-top: 5%;" class="m-auto">
                        <p style="max-width: 80%;margin: 0 auto;font-size: 20px;">
                            Your Order has been submitted successfully.
                            Please keep it for your record.
                        </p>
                    </div>
                    <hr>
                    <div class="col-12 mt-3 mb-3 pl-0" style="text-align: center">
                        <h3 style="font-size: 25px;padding-bottom: 6px;" >Here is your Order Details</h3>
                    </div>
                    <div class="clearfix" style="clear: both;"></div>
                    <div class="row" style="width: 100%;">
                        <div class="col-sm-6 col-12 mb-5" style="width: 50%; text-align: left;float: left;">
                            <h4><strong>Order ID: </strong> '.$data['order_id'].'</h4>
                            <p class="m-0"><strong>Order Date: </strong> '.date('M d, Y').'</p>
                            <p class="m-0"><strong>Order Time: </strong> '.date('H:i A').'</p>
                        </div>
                    </div>
                    <div class="clearfix" style="clear: both;"></div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered" style="width: 100%;text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px;">Item</th>
                                        <th style="border: 1px solid #E3E3E3;">Item Details</th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>';

    $template .= '<tr>
                          <td style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;">
                              <p style="padding: 2px"><strong>Currency Exchange</strong></p>
                          </td>
                          <td style="border: 1px solid #E3E3E3;text-align: left; padding: 5px">
                              <p style="padding: 2px; margin: 0"><strong> Item Info</strong></p>
                              <p style="padding: 2px; margin: 0"><small> Exchange Amount : '.$data['exchange_amount']. ' USD </small></p>
                              <p style="padding: 2px; margin: 0"><small> Method : ' .$ex_method['name'].'</small></p>
                              <p style="padding: 2px; margin: 0"><small> Exchange Rate : '.$data['exchange_rate'].' BDT </small></p>
                              <p style="padding: 2px; margin: 0"><small> Exchange Type : '.($data['exchange_type'] == 1?'Buy':'Sell').'</small></p>
                              
                              <div style="'.($data['exchange_type'] != 1?'display:none':'').'">
                                  <p style="padding: 2px; margin: 0"><strong> Receiver Info</strong></p>
                                  <p style="padding: 2px; margin: 0"><small>'.(!empty($data['exchange_type'] == 1)?'Receiver Name : '.$data['receiver_name']:''). '</small></p>
                                  <p style="padding: 2px; margin: 0"><small> ' .(!empty($data['exchange_type'] == 1)?'Receive Email : '.$data['received_account_mail']:'').'</small></p>
                                  <p style="padding: 2px; margin: 0"><small> ' .(!empty($data['exchange_type'] == 1)?'Bkash Number : '.$data['sender_bkash_number']:'').'</small></p>
                                  <p style="padding: 2px; margin: 0"><small> ' .(!empty($data['exchange_type'] == 1)?'Bkash transaction ID : '.$data['bkash_transaction_id']:'').'</small></p>
                              </div>
                              
                              <div style="'.($data['exchange_type'] != 2?'display:none':'').'">
                                  <p style="padding: 2px; margin: 0"><strong>Sender Info</strong></p>
                                  <p style="padding: 2px; margin: 0"><small>'.(!empty($data['exchange_type'] == 2)?'Sender account mail : '.$data['sender_account_mail']:'').'</small></p>
                                  <p style="padding: 2px; margin: 0"><small> ' .(!empty($data['exchange_type'] == 2)?'Sender transaction ID : '.$data['payment_transaction_id']:'').' </small></p>
                                  <p style="padding: 2px; margin: 0"><small> ' .(!empty($data['exchange_type'] == 2)?'Receiving Bkash Number : '.$data['receive_bkash_number']:'').'</small></p>
                              </div>
                              
                             
                          </td>
                          <td style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;">
                              <p class="m-0"><strong>'.$data['order_amount'].' BDT</strong></p>
                          </td>
                      </tr>
                     </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>
</html>';
    return $template;
}
