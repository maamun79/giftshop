<?php
/**
 * Created by PhpStorm.
 * User: Sujon
 * Date: 8/20/2019
 * Time: 5:33 PM
 */


function mi_order_complete_invoice_template($data){
    $product = mi_db_read_by_id('game_topup', array('id' => $data['topup_id']))[0];
    $item_type = mi_db_read_by_id('item_types', array('id'=> $data['item_type_id']))[0];
    $item_redem = mi_db_read_by_id('item_redems', array('id'=> $data['item_redem_id']))[0];
    $player_info = mi_db_read_by_id('player_info', array('id'=> $data['player_info_id']))[0];

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
                    <div class="col-12 mt-3 mb-3 pl-0">
                        <h3 style="font-size: 25px;padding-bottom: 6px; text-align: center">Here is your Order Details</h3>
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
                          <td style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: left;">
                              <a href="#" style="vertical-align: middle;"><img src="'.MI_BASE_URL.$product['thumb'].'" width="60px" height="60px;"></a>
                              <a href="#" style="vertical-align: middle;">'.$product['name'].'</a>
                          </td>
                          <td style="border: 1px solid #E3E3E3;text-align: left; padding: 5px">
                              <p style="padding: 2px; margin: 0"><strong>Item Info</strong></p>
                              <p style="padding: 2px; margin: 0"><small>Item Type : '.$item_type['name'].'</small></p>
                              <p style="padding: 2px; margin: 0"><small>'.(!empty($data['item_redem_id'])?'Item Reedem : '.$item_redem['title']:'').'</small></p>
                              
                              <p style="padding: 2px; margin: 0"><strong>'.(!empty($data['player_info_id'])?'Player Info ('.$player_info['title'].')':'').'</strong></p>
                              <p style="padding: 2px; margin: 0"><small>'.(!empty($data['character_id'])?'Character ID : '.$data['character_id']:'').'</small></p>
                              <p style="padding: 2px; margin: 0"><small>'.(!empty($data['character_name'])?'Character Name : '.$data['character_name']:'').'</small></p>
                              <p style="padding: 2px; margin: 0"><small>'.(!empty($data['player_contact_number'])?'Player Contact : '.$data['player_contact_number']:'').'</small></p>
                              <p style="padding: 2px; margin: 0"><small>'.(!empty($data['login_info_type'])?'Login Info Type : '.$data['login_info_type']:'').'</small></p>
                              <p style="padding: 2px; margin: 0"><small>'.(!empty($data['login_id'])?'Login ID : '.$data['login_id']:'').'</small></p>
                              <p style="padding: 2px; margin: 0"><small>'.(!empty($data['login_password'])?'Login Password : '.$data['login_password']:'').'</small></p> 
                              <p style="padding: 2px; margin: 0"><small>'.((!empty($data['login_contact_number'])?'Player Contact : '.$data['login_contact_number']:'')).'.</small></p>
                              
                              <p style="padding: 2px; margin: 0"><strong>Payment Info</strong></p>
                              <p style="padding: 2px; margin: 0"><small>Bkash Number : '.$data['bkash_number'].'</small></p>
                              <p style="padding: 2px; margin: 0"><small>Transaction ID : ' .$data['bkash_transaction_id'].'</small></p>
                              
                              
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
