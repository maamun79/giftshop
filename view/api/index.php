<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 11/30/2020
 * Time: 3:27 AM
 */

$msg = '';

if (isset($_POST['get_redeems_all']) && !empty($_POST['get_redeems_all']) && $_POST['get_redeems_all']){

    $item = mi_secure_input($_POST['id']);
    $type = mi_secure_input($_POST['type']);

    $get_item = mi_db_read_by_id('game_topup', array('id'=>$item, 'status'=>1));
    if (count($get_item)>0){

        $variations = json_decode($get_item[0]['variation'], true);
        $keys       = array_search($type, array_column($variations, 'type_id'));
        $var        = $variations[$keys];
        $msg        = array('status'=>'success', 'msg'=>'Data Fetched', 'redeems'=>$var);
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to fetch redeems');
    }

    echo json_encode($msg);
}


if (isset($_POST['get_player_info_all']) && !empty($_POST['get_player_info_all']) && $_POST['get_player_info_all'] == 1){
    $game_top = mi_secure_input($_POST['game_top']);
    $type     = mi_secure_input($_POST['type']);
    $id       = mi_secure_input($_POST['id']);

    $get_item = mi_db_read_by_id('game_topup', array('id'=>$game_top, 'status'=>1));
    if (count($get_item)>0){

        $variations = json_decode($get_item[0]['variation'], true);
        $keys = array_search($type, array_column($variations, 'type_id'));
        $var = $variations[$keys]['type_redems'];

        $player_var = array_search($id, array_column($var, 'redem_id'));
        $players = $var[$player_var];
        $msg = array('status'=>'success', 'msg'=>'Data Fetched', 'player_info'=>$players['player_info']);
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to fetch player info');
    }

    echo json_encode($msg);
}


if (isset($_POST['get_options_all']) && !empty($_POST['get_options_all']) && $_POST['get_options_all'] == 1){
    $id = mi_secure_input($_POST['id']);
    $type = mi_secure_input($_POST['type']);
    $get_item = mi_db_read_by_id('gift_cards', array('id'=>$id, 'status'=>1));
    if (count($get_item) > 0 && $get_item[0]['type'] == 2){

        $variations = json_decode($get_item[0]['variation'], true);
        $keys = array_search($type, array_column($variations, 'region_id'));

        $msg = array('status'=>'success', 'msg'=>'Data Fetched', 'options'=>$variations[$keys]['region_options']);

    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to fetch options');
    }

    echo json_encode($msg);
}


if (isset($_POST['get_topup_order']) && !empty($_POST['get_topup_order']) && $_POST['get_topup_order'] == 1){
    $user_ip          = mi_server_ip();
    $order_id         = mi_get_unique_code(8);
    $topup_id         = mi_secure_input($_POST['topup_id']);
    $item_type_id     = mi_secure_input($_POST['item_type_id']);
    $item_redem_id    = mi_secure_input($_POST['item_redem_id']);
    $player_info_id   = mi_secure_input($_POST['player_info_id']);
    $character_id     = mi_secure_input($_POST['character_id']);
    $character_name   = mi_secure_input($_POST['character_name']);
    $character_number = mi_secure_input($_POST['character_number']);
    $login_type       = mi_secure_input($_POST['login_type']);
    $login_id         = mi_secure_input($_POST['login_id']);
    $login_password   = mi_secure_input($_POST['login_password']);
    $login_number     = mi_secure_input($_POST['login_number']);
    $bkash_number     = mi_secure_input($_POST['bkash_number']);
    $transaction_id   = mi_secure_input($_POST['transaction_id']);
    $order_email      = mi_secure_input($_POST['order_email']);
    $order_amount     = mi_secure_input($_POST['order_amount']);

    if (empty($item_type_id)){
        $msg = array('status'=>'error', 'msg'=>'Item Type is required!');
    }else{
        if (!empty($item_redem_id)){
            if (!empty($player_info_id) && $player_info_id == 1){
                $login_type = '';
                if (empty($character_id)){
                    $msg = array('status'=>'error', 'msg'=>'Character ID is required!');
                }elseif (empty($character_name)){
                    $msg = array('status'=>'error', 'msg'=>'Character Name is required!');
                }elseif (empty($character_number)){
                    $msg = array('status'=>'error', 'msg'=>'Contact Number is required!');
                }
            }elseif (!empty($player_info_id) && $player_info_id == 2){
                if (empty($login_type)){
                    $msg = array('status'=>'error', 'msg'=>'Login Type is required!');
                }elseif (empty($login_id)){
                    $msg = array('status'=>'error', 'msg'=>'Login ID is required!');
                }elseif (empty($login_password)){
                    $msg = array('status'=>'error', 'msg'=>'Login Password is required!');
                }elseif (empty($login_number)){
                    $msg = array('status'=>'error', 'msg'=>'Contact Number is required!');
                }
            }else{
                $character_id     = '';
                $character_name   = '';
                $character_number = '';
                $login_type       = '';
                $login_id         = '';
                $login_password   = '';
                $login_number     = '';
            }
        }else{
            $item_redem_id = '';
            $login_type    = '';
        }

        if (empty($bkash_number)){
            $msg = array('status'=>'error', 'msg'=>'Bkash Number is required!');
        }elseif(strlen($bkash_number) != 11){
            $msg = array('status'=>'error', 'msg'=>'Bkash Number should be 11 digit');
        }elseif (empty($transaction_id)){
            $msg = array('status'=>'error', 'msg'=>'Bkash Transaction ID is required!');
        }elseif (empty($order_email)){
            $msg = array('status'=>'error', 'msg'=>'Order Email Address is required!');
        }else{
            if (empty($msg) && $msg['status'] !== 'error'){
                $data = array(
                    'user_ip'               => $user_ip,
                    'order_id'              => $order_id,
                    'topup_id'              => $topup_id,
                    'item_type_id'          => $item_type_id,
                    'item_redem_id'         => $item_redem_id,
                    'player_info_id'        => $player_info_id,
                    'character_id'          => $character_id,
                    'character_name'        => $character_name,
                    'player_contact_number' => $character_number,
                    'login_info_type'       => $login_type,
                    'login_id'              => $login_id,
                    'login_password'        => $login_password,
                    'login_contact_number'  => $login_number,
                    'bkash_number'          => $bkash_number,
                    'bkash_transaction_id'  => $transaction_id,
                    'order_email'           => $order_email,
                    'order_amount'          => $order_amount
                );

                $insert = mi_db_insert('topup_orders', $data);

                if ($insert){
                    $msg = array('status'=>'success', 'msg'=>'Order submitted successfully', 'order_id' => base64_encode($order_id));
                    mi_include('../mail-template/topup_order.php');
                    mi_do_mail([$order_email], 'Order submitted successfully', mi_order_complete_invoice_template($data));
                }else{
                    $msg = array('status'=>'error', 'msg'=>'Error to submit order!');
                }
            }
        }

    }


    echo json_encode($msg);
}


if (isset($_POST['get_gift_card_order']) && !empty($_POST['get_gift_card_order']) && $_POST['get_gift_card_order'] == 1){
    $user_ip        = mi_server_ip();
    $order_id       = mi_get_unique_code(8);
    $card_id        = mi_secure_input($_POST['card_id']);
    $card_type_id   = mi_secure_input($_POST['card_type_id']);
    $card_option_id = mi_secure_input($_POST['card_option_id']);
    $bkash_number   = mi_secure_input($_POST['bkash_number']);
    $transaction_id = mi_secure_input($_POST['transaction_id']);
    $order_email    = mi_secure_input($_POST['order_email']);
    $order_amount   = mi_secure_input($_POST['order_amount']);

    if (!empty($card_id)){
        if (empty($bkash_number)){
            $msg = array('status'=>'error', 'msg'=>'Bkash Number is required!');
        }elseif(strlen($bkash_number) != 11){
            $msg = array('status'=>'error', 'msg'=>'Bkash Number should be 11 digit');
        }elseif (empty($transaction_id)){
            $msg = array('status'=>'error', 'msg'=>'Bkash Transaction ID is required!');
        }elseif (empty($order_email)){
            $msg = array('status'=>'error', 'msg'=>'Order Email Address is required!');
        }else{
            if (empty($msg) && $msg['status'] !== 'error'){
                $data = array(
                    'user_ip'              => $user_ip,
                    'order_id'             => $order_id,
                    'gift_card_id'         => $card_id,
                    'card_type_id'         => $card_type_id,
                    'card_option_id'       => $card_option_id,
                    'bkash_number'         => $bkash_number,
                    'bkash_transaction_id' => $transaction_id,
                    'order_email'          => $order_email,
                    'order_amount'         => $order_amount
                );

                $insert = mi_db_insert('gift_card_orders', $data);

                if ($insert){
                    $msg = array('status'=>'success', 'msg'=>'Order submitted successfully', 'order_id' => base64_encode($order_id));
                    mi_include('../mail-template/giftcard_order.php');
                    mi_do_mail([$order_email], 'Order submitted successfully', mi_order_complete_invoice_template($data));
                }else{
                    $msg = array('status'=>'error', 'msg'=>'Error to submit order!');
                }
            }
        }
    }

    echo json_encode($msg);
}

if (isset($_POST['currency_convert']) && !empty($_POST['currency_convert']) && $_POST['currency_convert'] == 1){
    $amount = mi_secure_input($_POST['amount']);
    $option = mi_secure_input($_POST['option']);
    $method = mi_secure_input($_POST['method']);

    $exchanger = mi_db_read_by_id('exchanger', array('id' => $method))[0];

    if (empty($amount)){
        $msg = array('status'=>'error', 'msg'=>'Please enter exchange amount!');
    }elseif($amount < 0){
        $msg = array('status'=>'error', 'msg'=>'Invalid exchange amount!');
    }else{
        if ($option == 1){
            $total = $amount * $exchanger['buy_rate'];
            $msg = ['total' => $total, 'method' => $exchanger['name'], 'method_id' => $method, 'rate' => $exchanger['buy_rate'], 'option' => $option, 'amount' => $amount];
            mi_set_session('currency_order_details', $msg);
        }elseif ($option == 2){
            $total = $amount * $exchanger['sell_rate'];
            $msg = ['total' => $total, 'method' => $exchanger['name'], 'method_id' => $method, 'rate' => $exchanger['sell_rate'], 'option' => $option, 'amount' => $amount];
            mi_set_session('currency_order_details', $msg);
        }
    }
    echo json_encode($msg);

}

if (isset($_POST['currency_order']) && !empty($_POST['currency_order']) && $_POST['currency_order'] == 1){
    $exchange_details      = mi_get_session('currency_order_details');
    $user_ip               = mi_server_ip();
    $order_id              = mi_get_unique_code(8);
    $sender_bkash_number   = mi_secure_input($_POST['sender_bkash_number']);
    $sender_bkash_trans_id = mi_secure_input($_POST['sender_bkash_trans_id']);
    $receive_account_email = mi_secure_input($_POST['receive_account_email']);
    $sender_mail           = mi_secure_input($_POST['sender_mail']);
    $sender_mail_trans_id  = mi_secure_input($_POST['sender_mail_trans_id']);
    $receive_bkash_number  = mi_secure_input($_POST['receive_bkash_number']);
    $receiver_name         = mi_secure_input($_POST['receiver_name']);
    $order_email           = mi_secure_input($_POST['order_email']);

    if ($exchange_details['option'] == 1){
        if (empty($sender_bkash_number)){
            $msg = array('status'=>'error', 'msg'=>'Sender Bkash number is required!');
        }elseif(strlen($sender_bkash_number) != 11){
            $msg = array('status'=>'error', 'msg'=>'Bkash Number should be 11 digit');
        }elseif (empty($sender_bkash_trans_id)){
            $msg = array('status'=>'error', 'msg'=>'Sender Bkash Transaction ID is required!');
        }elseif (empty($receive_account_email)){
            $msg = array('status'=>'error', 'msg'=>'Receive account mail address is required!');
        }elseif (empty($receiver_name)){
            $msg = array('status'=>'error', 'msg'=>'Receiver name is required!');
        }elseif (empty($order_email)){
            $msg = array('status'=>'error', 'msg'=>'Order email is required!');
        }else{
            $sender_mail          = '';
            $sender_mail_trans_id = '';
            $receive_bkash_number = '';
        }
    }else{
        if (empty($sender_mail)){
            $msg = array('status'=>'error', 'msg'=>'Sender mail address is required!');
        }elseif (empty($sender_mail_trans_id)){
            $msg = array('status'=>'error', 'msg'=>'Sender mail transaction ID is required!');
        }elseif (empty($receive_bkash_number)){
            $msg = array('status'=>'error', 'msg'=>'Receive Bkash number is required!');
        }elseif(strlen($receive_bkash_number) != 11){
            $msg = array('status'=>'error', 'msg'=>'Bkash Number should be 11 digit');
        }else{
            $sender_bkash_number   = '';
            $sender_bkash_trans_id = '';
            $receive_account_email = '';
        }
    }

    if (empty($msg) && $msg['status'] !== 'error'){
        $data = array(
            'user_ip'                => $user_ip,
            'order_id'               => $order_id,
            'exchange_amount'        => $exchange_details['amount'],
            'exchange_method_id'     => $exchange_details['method_id'],
            'exchange_rate'          => $exchange_details['rate'],
            'exchange_type'          => $exchange_details['option'],
            'order_amount'           => $exchange_details['total'],
            'sender_bkash_number'    => $sender_bkash_number,
            'bkash_transaction_id'   => $sender_bkash_trans_id,
            'received_account_mail'  => $receive_account_email,
            'sender_account_mail'    => $sender_mail,
            'payment_transaction_id' => $sender_mail_trans_id,
            'receive_bkash_number'   => $receive_bkash_number,
            'receiver_name'          => $receiver_name,
            'order_email'            => $order_email
        );
        $insert = mi_db_insert('currency_orders', $data);
        if ($insert){
            $msg = array('status'=>'success', 'msg'=>'Your order submitted successfully!', 'order_id' => base64_encode($order_id));
            mi_include('../mail-template/currency_order.php');
            mi_do_mail([$sender_mail, $order_email], 'Order submitted successfully', mi_order_complete_invoice_template($data));
            mi_unset('currency_order_details');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to order currency!');
        }
    }
    echo json_encode($msg);
}

if (isset($_POST['order_track']) && !empty($_POST['order_track']) && $_POST['order_track'] == 1){
    $order_id = mi_secure_input($_POST['order_id']);
    $item_type = mi_secure_input($_POST['item_type']);

    if (empty($order_id)){
        $msg = array('status'=>'error', 'msg'=>'Please enter your order ID!');
    }elseif (empty($item_type)){
        $msg = array('status'=>'error', 'msg'=>'Please Choose item type!');
    }else{
        if ($item_type == 1){
            $topUpOrders    = mi_db_read_by_id('topup_orders', array('order_id' => $order_id))[0];
            $topupDetails    = mi_db_read_by_id('game_topup', array('id' => $topUpOrders['topup_id']))[0];

            $order_details = $topUpOrders;
            $item_details = $topupDetails;
        }elseif ($item_type == 2){
            $giftCardOrders = mi_db_read_by_id('gift_card_orders', array('order_id' => $order_id))[0];
            $giftCardDetails = mi_db_read_by_id('gift_cards', array('id' => $giftCardOrders['gift_card_id']))[0];

            $order_details = $giftCardOrders;
            $item_details = $giftCardDetails;
        }elseif ($item_type == 3){
            $currencyOrders = mi_db_read_by_id('currency_orders', array('order_id' => $order_id))[0];
            $currencyDetails = mi_db_read_by_id('exchanger', array('id' => $currencyOrders['exchange_method_id']))[0];

            $order_details = $currencyOrders;
            $item_details = $currencyDetails;
        }
        if (empty($order_details)){
            $msg = array('status'=>'error', 'msg'=>'No order found!');
        }else{
            $msg = array('order_details' => $order_details, 'item_details' => $item_details);
        }
    }
    echo json_encode($msg);
}

//--------------------------Contact request--------------------------
if (isset($_POST['contact_request']) && !empty($_POST['contact_request']) && $_POST['contact_request'] == 1){
    $name      = mi_secure_input($_POST['name']);
    $email     = mi_secure_input($_POST['email']);
    $subject   = mi_secure_input($_POST['subject']);
    $message   = mi_secure_input($_POST['message']);

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Name is required');
    }elseif (empty($email)){
        $msg = array('status'=>'error', 'msg'=>'Email is required');
    }elseif (empty($message)){
        $msg = array('status'=>'error', 'msg'=>'Message is required');
    }else{
        $data = array(
            'name'    => $name,
            'email'   => $email,
            'subject' => $subject,
            'message' => $message,
        );

        $insert = mi_db_insert('contact_request', $data);
        if ($insert){
            $msg = array('status'=>'success', 'msg'=>'Your contact request submitted successfully!');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to submit contact request');
        }
    }

    echo json_encode($msg);
}