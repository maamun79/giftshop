<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 8/11/2020
 * Time: 12:31 PM
 */


function mi_paypal_payment($client, $amount_id, $trx_id, $order_submit_id){
    if(!isset($amount_id) || empty($amount_id)){
        return false;
    }elseif(!isset($client) || empty($client)){
        return false;
    }elseif(!isset($trx_id) || empty($trx_id)){
        return false;
    }elseif(!isset($order_submit_id) || empty($order_submit_id)){
        return false;
    }else{
?>

<?php }}