<?php

//=======================================================
//|                   ADMIN LOGIN                       |
//=======================================================

if (isset($_POST['admin_login'])){
    $uphn = mi_secure_input($_POST['username']);
    $upass = mi_secure_input($_POST['password']);

    if (empty($uphn) || empty($upass)){
        $msg = array('status'=>'error', 'msg'=>'All the fields are required');
    }elseif (!filter_var($uphn, FILTER_VALIDATE_EMAIL)){
        $msg = array('status'=>'error', 'msg'=>'Invalid email address');
    }else{

        $getdata = mi_db_read_by_id('mi_admin', array('user_email'=>$uphn));

        if (count($getdata) > 0){

            if ($getdata[0]['user_status'] == 2){

                $attempt_time = strtotime(date('Y-m-d H:i:s'));
                $remove_time = strtotime($getdata[0]['user_authen_time']);
                if ($getdata[0]['user_attepts'] >= 5 && $attempt_time < $remove_time){
                    $minutes = round(abs(strtotime($getdata[0]['user_authen_time']) - time()) / 60);
                    $msg = array('status'=>'error', 'msg'=>'Sorry you have failed to login 5 times. Please try again after '.$minutes.' minute!');
                }else{
                    if ($getdata[0]['user_password'] != md5($upass)){
                        $attept_data = array(
                            'user_attepts' => $getdata[0]['user_attepts'] + 1,
                            'user_authen_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))+strtotime("+10 minutes", strtotime('Y-m-d H:i:s')))
                        );
                        $attept_update = mi_db_update('mi_admin', $attept_data, array('id'=>$getdata[0]['id']));
                        $msg = array('status'=>'error', 'msg'=>'Password not matching.');
                    }else{
                        $logger = array(
                            'user_attepts' => '',
                            'user_authen_time' => '',
                            'user_last_login' => date('Y-m-d H:i:s')
                        );
                        mi_db_update('mi_admin', $logger, array('id'=>$getdata[0]['id']));
                        mi_set_session('admin', base64_encode($getdata[0]['id']));
                        $role = mi_db_read_by_id('user_roles', array('id'=> $getdata[0]['role_id'], 'status' == 1))[0];
                        mi_set_session('role', $role);
                        $msg = array('status'=>'success', 'msg'=>'Login Successfully');
                    }
                }
            }else{
                $msg = array('status'=>'error', 'msg'=>'Sorry, Your account account is not activated');
            }

        }else{
            $msg = array('status'=>'error', 'msg'=>'User not exists.');
        }

    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/login.php');
}

//=======================================================
//|     GAME TOPUP ORDERS SERVER SIDE RENDERING         |
//=======================================================

if (isset($_GET['get_topup_orders']) && !empty($_GET['get_topup_orders']) && $_GET['get_topup_orders'] ==1) {

    $request=$_REQUEST;
    $col=array(
        0 =>"id",
        1 =>"order_id",
        2 =>"bkash_number",
        3 =>"order_amount",
        4 =>"order_status",
        5 =>"order_status",
    );
    $sql=mi_db_custom_query('SELECT * FROM topup_orders');

    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;

    $query='SELECT * FROM topup_orders';

    if (!empty($request['search']['value'])) {
        $query.=' WHERE id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_amount LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_status LIKE "%'.$request['search']['value'].'%"';
//    print_r($query);
    }

    $sql=mi_db_custom_query($query);
    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;
    $query.=" ORDER BY ".$col[$request['order'][0]['column']]."  ".$request['order'][0]['dir']." LIMIT ".$request['start'].", ".$request['length']."  ";
    $sql=mi_db_custom_query($query);

    $data=array();
    foreach ($sql as $key=> $row) {
        $topup = mi_db_read_by_id('game_topup', array('id'=> $row['topup_id']))[0];

        $subData=array();
        $subData[]=$key+1;
        $subData[]='<h5>'.$row['order_id'].'</h5>
                    <small>'.date('M d, Y - H:i a', strtotime($row['created_at'])).'</small>';

        $subData[]='<h5>'.$topup['name'].'</h5>';

        $subData[]='<h5>Bkash Number : '.$row['bkash_number'].'</h5>
                    <p>Trx ID : '.$row['bkash_transaction_id'].'</p>';

        $subData[]='<h5>BDT '.$row['order_amount'].'</h5>';

        $subData[]='<div class="form-group form-type-material style="max-width: 180px;">
                                <select class="form-control orderStatus" order-type="1" order_id="'.$row['id'].'">
                                     <option value="1" '.(($row['order_status'] == 1) ? 'selected' : '').'>
                                        Pending
                                    </option>
                                    <option value="2" '.(($row['order_status'] == 2) ? 'selected' : '').'>
                                        Confirm
                                    </option>
                                    <option value="3" '.(($row['order_status'] == 3) ? 'selected' : '').'>
                                        Completed
                                    </option>
                                    <option value="4" '.(($row['order_status'] == 4) ? 'selected' : '').'>
                                        Cancelled
                                    </option>
                               </select>                                
                            </div>';

        $subData[]='<a class="btn btn-dark btn-sm mb-2" href="single-topup-order.php?to='.base64_encode($row['id']).'">View <i class="fa fa-eye"></i></a>
                    <a val="'.$row['id'].'" class="btn btn-danger btn-sm text-white deleteData" del-type="topup-order">Delete <i class="fa fa-times"></i></a>';

        $data[]=$subData;
    }
    $json_data=array(
        'draw'           => intval($request['draw']),
        'recordsTotal'   => intval($totalRecord),
        'recordsFiltered'=> $totalRecord,
        'data'           =>$data

    );
    echo json_encode($json_data);

}

//=======================================================
//|      GIFT CARD ORDERS SERVER SIDE RENDERING         |
//=======================================================

if (isset($_GET['get_giftcard_orders']) && !empty($_GET['get_giftcard_orders']) && $_GET['get_giftcard_orders'] ==1) {

    $request=$_REQUEST;
    $col=array(
        0 =>"id",
        1 =>"order_id",
        2 =>"bkash_number",
        3 =>"order_amount",
        4 =>"order_status",
        5 =>"order_status",
    );
    $sql=mi_db_custom_query('SELECT * FROM gift_card_orders');

    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;

    $query='SELECT * FROM gift_card_orders';

    if (!empty($request['search']['value'])) {
        $query.=' WHERE id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_amount LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_status LIKE "%'.$request['search']['value'].'%"';
//    print_r($query);
    }

    $sql=mi_db_custom_query($query);
    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;
    $query.=" ORDER BY ".$col[$request['order'][0]['column']]."  ".$request['order'][0]['dir']." LIMIT ".$request['start'].", ".$request['length']."  ";
    $sql=mi_db_custom_query($query);

    $data=array();
    foreach ($sql as $key=> $row) {
        $card = mi_db_read_by_id('gift_cards', array('id'=> $row['gift_card_id']))[0];

        $subData=array();
        $subData[]=$key+1;
        $subData[]='<h5>'.$row['order_id'].'</h5>
                    <small>'.date('M d, Y - H:i a', strtotime($row['created_at'])).'</small>';

        $subData[]='<h5>'.$card['name'].'</h5>';

        $subData[]='<h5>Bkash Number : '.$row['bkash_number'].'</h5>
                    <p>Trx ID : '.$row['bkash_transaction_id'].'</p>';

        $subData[]='<h5>BDT '.$row['order_amount'].'</h5>';

        $subData[]='<div class="form-group form-type-material style="max-width: 180px;">
                                <select class="form-control orderStatus" order-type="2" order_id="'.$row['id'].'">
                                     <option value="1" '.(($row['order_status'] == 1) ? 'selected' : '').'>
                                        Pending
                                    </option>
                                    <option value="2" '.(($row['order_status'] == 2) ? 'selected' : '').'>
                                        Confirm
                                    </option>
                                    <option value="3" '.(($row['order_status'] == 3) ? 'selected' : '').'>
                                        Completed
                                    </option>
                                    <option value="4" '.(($row['order_status'] == 4) ? 'selected' : '').'>
                                        Cancelled
                                    </option>
                               </select>                                
                            </div>';

        $subData[]='<a class="btn btn-dark btn-sm mb-2" href="single-card-order.php?co='.base64_encode($row['id']).'">View <i class="fa fa-eye"></i></a>
                    <a val="'.$row['id'].'" class="btn btn-danger btn-sm text-white deleteData" del-type="gift-card-order">Delete <i class="fa fa-times"></i></a>';

        $data[]=$subData;
    }
    $json_data=array(
        'draw'           => intval($request['draw']),
        'recordsTotal'   => intval($totalRecord),
        'recordsFiltered'=> $totalRecord,
        'data'           =>$data

    );
    echo json_encode($json_data);

}

//=============================================================
//|      CURRENCY EXCHANGE ORDERS SERVER SIDE RENDERING       |
//=============================================================

if (isset($_GET['get_currency_orders']) && !empty($_GET['get_currency_orders']) && $_GET['get_currency_orders'] ==1) {

    $request=$_REQUEST;
    $col=array(
        0 =>"id",
        1 =>"order_id",
        2 =>"exchange_method_id",
        3 =>"order_amount",
        4 =>"order_status",
        5 =>"order_status",
    );
    $sql=mi_db_custom_query('SELECT * FROM currency_orders');

    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;

    $query='SELECT * FROM currency_orders';

    if (!empty($request['search']['value'])) {
        $query.=' WHERE id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_amount LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR order_status LIKE "%'.$request['search']['value'].'%"';
//    print_r($query);
    }

    $sql=mi_db_custom_query($query);
    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;
    $query.=" ORDER BY ".$col[$request['order'][0]['column']]."  ".$request['order'][0]['dir']." LIMIT ".$request['start'].", ".$request['length']."  ";
    $sql=mi_db_custom_query($query);

    $data=array();
    foreach ($sql as $key=> $row) {
        $ex_method = mi_db_read_by_id('exchanger', array('id'=> $row['exchange_method_id']))[0];

        $subData=array();
        $subData[]=$key+1;
        $subData[]='<h5>'.$row['order_id'].'</h5>
                    <small>'.date('M d, Y - H:i a', strtotime($row['created_at'])).'</small>';

        $subData[]='<h5>Exchange Method : '.$ex_method['name'].'</h5>
                    <p>Exchange Amount : '.$row['exchange_amount'].' USD</p>
                    <p>Exchange Rate : '.$row['exchange_rate'].' BDT</p>
                    <p>Exchange Type : '.($row['exchange_type'] == 1?'Buy':'Sell').'</p>';

        if ($row['exchange_type'] == 1){
            $subData[]='<h5>Sender Bkash Number : '.$row['sender_bkash_number'].'</h5>
                        <p>Trx ID : '.$row['bkash_transaction_id'].'</p>
                        <p>Receiver Name : '.$row['receiver_name'].'</p>
                        <p>Receiving Account Email : '.$row['received_account_mail'].'</p>';

        }elseif ($row['exchange_type'] == 2){
            $subData[]='<h5>Sender Account Email : '.$row['sender_account_mail'].'</h5>
                        <p>Trx ID : '.$row['payment_transaction_id'].'</p>
                        <p>Receiving Bkash Number : '.$row['receive_bkash_number'].'</p>';
        }


        $subData[]='<h5>BDT '.$row['order_amount'].'</h5>';

        $subData[]='<div class="form-group form-type-material style="max-width: 180px;">
                                <select class="form-control orderStatus" order-type="3" order_id="'.$row['id'].'">
                                     <option value="1" '.(($row['order_status'] == 1) ? 'selected' : '').'>
                                        Pending
                                    </option>
                                    <option value="2" '.(($row['order_status'] == 2) ? 'selected' : '').'>
                                        Confirm
                                    </option>
                                    <option value="3" '.(($row['order_status'] == 3) ? 'selected' : '').'>
                                        Completed
                                    </option>
                                    <option value="4" '.(($row['order_status'] == 4) ? 'selected' : '').'>
                                        Cancelled
                                    </option>
                               </select>                                
                            </div>';

        $subData[]='<a class="btn btn-dark btn-sm mb-2" href="single-currency-order.php?eo='.base64_encode($row['id']).'">View <i class="fa fa-eye"></i></a>
                    <a val="'.$row['id'].'" class="btn btn-danger btn-sm text-white deleteData" del-type="currency-order">Delete <i class="fa fa-times"></i></a>';

        $data[]=$subData;
    }
    $json_data=array(
        'draw'           => intval($request['draw']),
        'recordsTotal'   => intval($totalRecord),
        'recordsFiltered'=> $totalRecord,
        'data'           =>$data

    );
    echo json_encode($json_data);

}

//=======================================================
//|                   STATUS CHANGE                     |
//=======================================================
if (isset($_POST['change_order_status_request']) && !empty($_POST['change_order_status_request']) && $_POST['change_order_status_request'] == 1){
    $id = mi_secure_input($_POST['id']);
    $status = mi_secure_input($_POST['status']);
    $order_type = mi_secure_input($_POST['order_type']);

    if ($order_type == 1){
        $update = mi_db_update('topup_orders', array('order_status'=> $status), array('id'=> $id));
    }elseif ($order_type == 2){
        $update = mi_db_update('gift_card_orders', array('order_status'=> $status), array('id'=> $id));
    }elseif ($order_type == 3){
        $update = mi_db_update('currency_orders', array('order_status'=> $status), array('id'=> $id));
    }elseif ($order_type == 'topup'){
        $update = mi_db_update('game_topup', array('status'=> $status), array('id'=> $id));
    }elseif ($order_type == 'gift-card'){
        $update = mi_db_update('gift_cards', array('status'=> $status), array('id'=> $id));
    }


    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Status updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update status');
    }


    echo json_encode($msg);
}

//=======================================================
//|                     DELETE DATA                     |
//=======================================================
if (isset($_POST['data_delete_request']) && !empty($_POST['data_delete_request']) && $_POST['data_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);
    $type = mi_secure_input($_POST['type']);

    if ($type == 'topup-order'){
        $delete = mi_db_delete('topup_orders', 'id', array($id));
    }elseif ($type == 'gift-card-order'){
        $delete = mi_db_delete('gift_card_orders', 'id', array($id));
    }elseif ($type == 'currency-order'){
        $delete = mi_db_delete('currency_orders', 'id', array($id));
    }elseif ($type == 'topup'){
        $delete = mi_db_delete('game_topup', 'id', array($id));
    }elseif ($type == 'topup-item-type'){
        $delete = mi_db_delete('item_types', 'id', array($id));
    }elseif ($type == 'topup-item-redem'){
        $delete = mi_db_delete('item_redems', 'id', array($id));
    }elseif ($type == 'topup-player-info'){
        $delete = mi_db_delete('player_info', 'id', array($id));
    }elseif ($type == 'gift-card'){
        $delete = mi_db_delete('gift_cards', 'id', array($id));
    }elseif ($type == 'gift-card-type'){
        $delete = mi_db_delete('card_types', 'id', array($id));
    }elseif ($type == 'gift-card-option'){
        $delete = mi_db_delete('card_options', 'id', array($id));
    }elseif ($type == 'currency-exchange-method'){
        $delete = mi_db_delete('exchanger', 'id', array($id));
    }elseif ($type == 'contact-request'){
        $delete = mi_db_delete('contact_request', 'id', array($id));
    }


    if ($delete == true){
        $msg = array('status'=>'success', 'msg'=>'Deleted successfully');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error delete');
    }


    echo json_encode($msg);
}


//=======================================================
//|                   ADD ITEM TYPE                     |
//=======================================================
if (isset($_POST['item_type_add'])){
    $item_type_name = mi_secure_input($_POST['item_type_name']);
    $status         = mi_secure_input($_POST['status']);

    if (!empty($item_type_name) && isset($item_type_name)){
        $data = array(
            'name' => $item_type_name,
            'status' => $status
        );
        $insert = mi_db_insert('item_types', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Item type added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Item type');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Item type name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/item-types.php');
}

//=======================================================
//|                  EDIT ITEM TYPE                     |
//=======================================================
if (isset($_POST['item_type_edit'])){
    $item_type_id = mi_secure_input($_POST['item_type_edit_id']);
    $item_type_name = mi_secure_input($_POST['item_type_name']);
    $status = mi_secure_input($_POST['status']);

    if (!empty($item_type_name) && isset($item_type_name)){
        $data = array(
            'name' => $item_type_name,
            'status' => $status
        );
        $update = mi_db_update('item_types', $data, array('id' => $item_type_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Item type updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update item type');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Item type name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/item-types.php');
}

//=======================================================
//|                   ADD ITEM REDEM                    |
//=======================================================
if (isset($_POST['item_redem_add'])){
    $item_redem_title = mi_secure_input($_POST['item_redem_name']);
    $status         = mi_secure_input($_POST['status']);

    if (!empty($item_redem_title) && isset($item_redem_title)){
        $data = array(
            'title' => $item_redem_title,
            'status' => $status
        );
        $insert = mi_db_insert('item_redems', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Item redeem added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Item redeem');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Item redeem title is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/item-redeems.php');
}

//=======================================================
//|                  EDIT ITEM TYPE                     |
//=======================================================
if (isset($_POST['item_redem_edit'])){
    $item_redem_id = mi_secure_input($_POST['item_redem_edit_id']);
    $item_redem_title = mi_secure_input($_POST['item_redem_name']);
    $status = mi_secure_input($_POST['status']);

    if (!empty($item_redem_title) && isset($item_redem_title)){
        $data = array(
            'title' => $item_redem_title,
            'status' => $status
        );
        $update = mi_db_update('item_redems', $data, array('id' => $item_redem_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Item redeem updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update item redeem');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Item redeem title is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/item-redeems.php');
}

//=======================================================
//|                   ADD PLAYER INFO                   |
//=======================================================
if (isset($_POST['player_info_add'])){
    $player_info_title = mi_secure_input($_POST['player_info_title']);
    $type         = mi_secure_input($_POST['type']);
    $status       = mi_secure_input($_POST['status']);

    if (!empty($player_info_title) && isset($player_info_title)){
        $data = array(
            'title' => $player_info_title,
            'type' => $type,
            'status' => $status
        );
        $insert = mi_db_insert('player_info', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Player info added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Player info');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Player info title is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/player-info.php');
}

//=======================================================
//|                 EDIT PLAYER INFO                    |
//=======================================================
if (isset($_POST['player_info_edit'])){
    $player_info_edit_id = mi_secure_input($_POST['player_info_edit_id']);
    $player_info_title = mi_secure_input($_POST['player_info_title']);
    $type = mi_secure_input($_POST['type']);
    $status = mi_secure_input($_POST['status']);

    if (!empty($player_info_title) && isset($player_info_title)){
        $data = array(
            'title' => $player_info_title,
            'type' => $type,
            'status' => $status
        );
        $update = mi_db_update('player_info', $data, array('id' => $player_info_edit_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Player info updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Player info');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Player info title is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/player-info.php');
}

//=======================================================
//|                   ADD CARD TYPE                     |
//=======================================================
if (isset($_POST['card_type_add'])){
    $card_type_name = mi_secure_input($_POST['card_type_name']);
    $status       = mi_secure_input($_POST['status']);

    if (!empty($card_type_name) && isset($card_type_name)){
        $data = array(
            'name' => $card_type_name,
            'status' => $status
        );
        $insert = mi_db_insert('card_types', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Card type added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Card type');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Card type name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/card-types.php');
}

//=======================================================
//|                   EDIT CARD TYPE                    |
//=======================================================
if (isset($_POST['card_type_edit'])){
    $card_type_edit_id = mi_secure_input($_POST['card_type_edit_id']);
    $card_type_name = mi_secure_input($_POST['card_type_name']);
    $status = mi_secure_input($_POST['status']);

    if (!empty($card_type_name) && isset($card_type_name)){
        $data = array(
            'name' => $card_type_name,
            'status' => $status
        );
        $update = mi_db_update('card_types', $data, array('id' => $card_type_edit_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Card type updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Card type');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Card type name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/card-types.php');
}


//=======================================================
//|                   ADD CARD OPTION                   |
//=======================================================
if (isset($_POST['card_option_add'])){
    $card_option_name = mi_secure_input($_POST['card_option_name']);
    $status       = mi_secure_input($_POST['status']);

    if (!empty($card_option_name) && isset($card_option_name)){
        $data = array(
            'name' => $card_option_name,
            'status' => $status
        );
        $insert = mi_db_insert('card_options', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Card option added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Card option');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Card option name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/card-options.php');
}

//=======================================================
//|                   EDIT CARD OPTION                  |
//=======================================================
if (isset($_POST['card_option_edit'])){
    $card_option_edit_id = mi_secure_input($_POST['card_option_edit_id']);
    $card_option_name = mi_secure_input($_POST['card_option_name']);
    $status = mi_secure_input($_POST['status']);

    if (!empty($card_option_name) && isset($card_option_name)){
        $data = array(
            'name' => $card_option_name,
            'status' => $status
        );
        $update = mi_db_update('card_options', $data, array('id' => $card_option_edit_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Card option updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Card option');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Card option name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/card-options.php');
}

//=======================================================
//|                ADD EXCHANGE METHOD                  |
//=======================================================
if (isset($_POST['method_add'])){
    $method_name   = mi_secure_input($_POST['method_name']);
    $account_email = mi_secure_input($_POST['account_email']);
    $sell_rate     = mi_secure_input($_POST['sell_rate']);
    $buy_rate      = mi_secure_input($_POST['buy_rate']);
    $status        = mi_secure_input($_POST['status']);

    if (empty($method_name)){
        $msg = array('status'=>'error', 'msg'=>'Exchange Method name is required');
    }elseif (empty($account_email)){
        $msg = array('status'=>'error', 'msg'=>'Method Account email is required');
    }elseif (empty($sell_rate)){
        $msg = array('status'=>'error', 'msg'=>'Sell Rate is required');
    }elseif ($sell_rate < 1){
        $msg = array('status'=>'error', 'msg'=>'Invalid Sell Rate');
    }elseif (empty($buy_rate)){
        $msg = array('status'=>'error', 'msg'=>'Buy Rate is required');
    }elseif ($buy_rate < 1){
        $msg = array('status'=>'error', 'msg'=>'Invalid Buy Rate');
    }else{
        $data = array(
            'name'         => $method_name,
            'company_mail' => $account_email,
            'buy_rate'     => $sell_rate,
            'sell_rate'    => $buy_rate,
            'status'       => $status
        );
        $insert = mi_db_insert('exchanger', $data);
        if ($insert){
            $msg = array('status'=>'success', 'msg'=>'Exchange Method added successfully!');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Exchange Method');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/exchange-methods.php');
}

//=======================================================
//|                 EDIT EXCHANGE METHOD                |
//=======================================================
if (isset($_POST['method_edit'])){
    $method_edit_id = mi_secure_input($_POST['method_edit_id']);
    $method_name    = mi_secure_input($_POST['method_name']);
    $account_email  = mi_secure_input($_POST['account_email']);
    $sell_rate      = mi_secure_input($_POST['sell_rate']);
    $buy_rate       = mi_secure_input($_POST['buy_rate']);
    $status         = mi_secure_input($_POST['status']);

    if (empty($method_name)){
        $msg = array('status'=>'error', 'msg'=>'Exchange Method name is required');
    }elseif (empty($account_email)){
        $msg = array('status'=>'error', 'msg'=>'Method Account email is required');
    }elseif (empty($sell_rate)){
        $msg = array('status'=>'error', 'msg'=>'Sell Rate is required');
    }elseif ($sell_rate < 1){
        $msg = array('status'=>'error', 'msg'=>'Invalid Sell Rate');
    }elseif (empty($buy_rate)){
        $msg = array('status'=>'error', 'msg'=>'Buy Rate is required');
    }elseif ($buy_rate < 1){
        $msg = array('status'=>'error', 'msg'=>'Invalid Buy Rate');
    }else{
        $data = array(
            'name'         => $method_name,
            'company_mail' => $account_email,
            'buy_rate'     => $sell_rate,
            'sell_rate'    => $buy_rate,
            'status'       => $status
        );
        $update = mi_db_update('exchanger', $data, array('id'=> $method_edit_id));
        if ($update){
            $msg = array('status'=>'success', 'msg'=>'Exchange Method updated successfully!');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error updated add Exchange Method');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/exchange-methods.php');
}

//=======================================================
//|                   ADD ADMIN ROLES                   |
//=======================================================
if (isset($_POST['role_add'])){
    $role_name = mi_secure_input($_POST['role_name']);
    $topup     = mi_secure_input(((isset($_POST['topup_management']) && !empty($_POST['topup_management']))?$_POST['topup_management']:''));
    $card      = mi_secure_input(((isset($_POST['card_management']) && !empty($_POST['card_management']))?$_POST['card_management']:''));
    $currency  = mi_secure_input(((isset($_POST['currency_management']) && !empty($_POST['currency_management']))?$_POST['currency_management']:''));
    $order     = mi_secure_input(((isset($_POST['order']) && !empty($_POST['order']))?$_POST['order']:''));
    $settings  = mi_secure_input(((isset($_POST['settings']) && !empty($_POST['settings']))?$_POST['settings']:''));
    $u_manage  = mi_secure_input(((isset($_POST['u_manage']) && !empty($_POST['u_manage']))?$_POST['u_manage']:''));
    $status    = mi_secure_input($_POST['status']);

    if (!empty($role_name) && isset($role_name)){
        $data = array(
            'role_name'           => $role_name,
            'topup_management'    => $topup,
            'card_management'     => $card,
            'currency_management' => $currency,
            'orders'              => $order,
            'user_management'     => $u_manage,
            'settings'            => $settings,
            'status'              => $status
        );
        $insert = mi_db_insert('user_roles', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Role added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add role');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Role name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/admin-roles.php');
}

//=======================================================
//|                   EDIT ADMIN ROLES                  |
//=======================================================
if (isset($_POST['role_edit'])){
    $role_id   = mi_secure_input($_POST['role_edit_id']);
    $role_name = mi_secure_input($_POST['role_name']);
    $topup     = mi_secure_input(((isset($_POST['topup_management']) && !empty($_POST['topup_management']))?$_POST['topup_management']:''));
    $card      = mi_secure_input(((isset($_POST['card_management']) && !empty($_POST['card_management']))?$_POST['card_management']:''));
    $currency  = mi_secure_input(((isset($_POST['currency_management']) && !empty($_POST['currency_management']))?$_POST['currency_management']:''));
    $order     = mi_secure_input(((isset($_POST['order']) && !empty($_POST['order']))?$_POST['order']:''));
    $settings  = mi_secure_input(((isset($_POST['settings']) && !empty($_POST['settings']))?$_POST['settings']:''));
    $u_manage  = mi_secure_input(((isset($_POST['u_manage']) && !empty($_POST['u_manage']))?$_POST['u_manage']:''));
    $status    = mi_secure_input($_POST['status']);

    if (!empty($role_name) && isset($role_name)){
        $data = array(
            'role_name'           => $role_name,
            'topup_management'    => $topup,
            'card_management'     => $card,
            'currency_management' => $currency,
            'orders'              => $order,
            'user_management'     => $u_manage,
            'settings'            => $settings,
            'status'              => $status
        );
        $update = mi_db_update('user_roles', $data, array('id' => $role_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Role updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update role');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Role name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/admin-roles.php');
}

//=======================================================
//|                       ADD ADMIN                     |
//=======================================================
if (isset($_POST['add_staff'])){
    $name = mi_secure_input($_POST['name']);
    $email = mi_secure_input($_POST['email']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);
    $password = mi_secure_input($_POST['password']);
    $con_pass = mi_secure_input($_POST['con_pass']);
    $status = mi_secure_input($_POST['status']);
    $role = mi_secure_input($_POST['role']);

    $image = $_FILES['image'];

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Staff name is required');
    }elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = array('status'=>'error', 'msg'=>'Valid staff email is required');
    }elseif(empty($phone)){
        $msg = array('status'=>'error', 'msg'=>'Valid 10 digit Phone Number is required!');
    }elseif(empty($address)){
        $msg = array('status'=>'error', 'msg'=>'Staff address is required!');
    }elseif(empty($password)){
        $msg = array('status'=>'error', 'msg'=>'Password is required!');
    }elseif(empty($con_pass) || $password!= $con_pass){
        $msg = array('status'=>'error', 'msg'=>'Password not matching!');
    }elseif(empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }elseif(empty($role)){
        $msg = array('status'=>'error', 'msg'=>'Staff role is required');
    }else{
        if (!empty($image['name'])){
            $up_img = mi_uploader(
                $image['name'],
                $image['tmp_name'],
                'staff-uploads/staff-profile/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            );
            $data = array(
                'user_name'     => $name,
                'user_email'    => $email,
                'user_phone'    => $phone,
                'user_address'  => $address,
                'user_password' => md5($password),
                'user_salt'     => $password,
                'user_status'   => $status,
                'role_id'       => $role,
                'user_photo'    => $up_img,
            );
        }else{
            $data = array(
                'user_name'     => $name,
                'user_email'    => $email,
                'user_phone'    => $phone,
                'user_address'  => $address,
                'user_password' => md5($password),
                'user_salt'     => $password,
                'user_status'   => $status,
                'role_id'       => $role,
            );
        }

        $insert = mi_db_insert('mi_admin', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Admin added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add admin');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/admins.php');
}

//=======================================================
//|                       EDIT ADMIN                    |
//=======================================================
if (isset($_POST['edit_staff'])){
    $edit_id = mi_secure_input($_POST['edit_staff_id']);
    $name = mi_secure_input($_POST['name']);
    $email = mi_secure_input($_POST['email']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);
    $status = mi_secure_input($_POST['status']);
    $role = mi_secure_input($_POST['role']);

    $image = $_FILES['image'];

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Staff name is required');
    }elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = array('status'=>'error', 'msg'=>'Valid staff email is required');
    }elseif(empty($phone)){
        $msg = array('status'=>'error', 'msg'=>'Valid 10 digit Phone Number is required!');
    }elseif(empty($address)){
        $msg = array('status'=>'error', 'msg'=>'Staff address is required!');
    }elseif(empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }elseif(empty($role)){
        $msg = array('status'=>'error', 'msg'=>'Staff role is required');
    }else{
        $cut = mi_db_read_by_id('mi_admin', array('id' => $edit_id))[0];
        $cut_img = $cut['user_photo'];

        if (!empty($image['name'])){
            $up_img = mi_uploader(
                $image['name'],
                $image['tmp_name'],
                'staff-uploads/staff-profile/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            );
            if ($up_img != false){
                unlink($cut_img);
            }

            $data = array(
                'user_name'    => $name,
                'user_email'   => $email,
                'user_phone'   => $phone,
                'user_address' => $address,
                'user_status'  => $status,
                'role_id'      => $role,
                'user_photo'   => $up_img,
            );
        }else{
            $data = array(
                'user_name'    => $name,
                'user_email'   => $email,
                'user_phone'   => $phone,
                'user_address' => $address,
                'user_status'  => $status,
                'role_id'      => $role,
            );
        }

        $update = mi_db_update('mi_admin', $data, array('id' => $edit_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Staff updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update staff');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/admins.php');
}

//=======================================================
//|               CHANGE ADMIN PASSWORD                 |
//=======================================================
if (isset($_POST['change_staff_pass'])){
    $change_id = mi_secure_input($_POST['change_pass_id']);
    $password = mi_secure_input($_POST['password']);
    $confirm_password = mi_secure_input($_POST['con_password']);

    if (empty($password) || empty($confirm_password)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }elseif ($password != $confirm_password){
        $msg = array('status'=>'error', 'msg'=>'Passwords are not matching');
    }else{
        $data = array(
            'user_password' => md5($password),
            'user_salt' => $password
        );
        $update = mi_db_update('mi_admin', $data, array('id' => $change_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Staff Password updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Password');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/admin-edit.php?e='.$change_id);
}

//=======================================================
//|                 SHOWING GAME TOP UP                 |
//=======================================================

if (isset($_GET['get_topups']) && !empty($_GET['get_topups']) && $_GET['get_topups'] ==1) {

    $request=$_REQUEST;
    $col=array(
        0 =>"id",
        1 =>"id",
        2 =>"name",
        3 =>"created_at",
        4 =>"status",
    );
    $sql=mi_db_custom_query('SELECT * FROM game_topup');

    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;

    $query='SELECT * FROM game_topup';

    if (!empty($request['search']['value'])) {
        $query.=' WHERE id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR name LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR status LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR created_at LIKE "%'.$request['search']['value'].'%"';
//    print_r($query);
    }

    $sql=mi_db_custom_query($query);
    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;
    $query.=" ORDER BY ".$col[$request['order'][0]['column']]."  ".$request['order'][0]['dir']." LIMIT ".$request['start'].", ".$request['length']."  ";
    $sql=mi_db_custom_query($query);

    $data=array();
    foreach ($sql as $key=> $row) {

        $subData=array();
        $subData[]=$key+1;
        $subData[]='<img src="'.MI_BASE_URL.$row['thumb'].'" style="width:70px; height:70px">';

        $subData[]='<h5>'.$row['name'].'</h5>';

        $subData[]='<h5>'.date('M d, Y - H:i a', strtotime($row['created_at'])).'</h5>';

        $subData[]='<div class="form-group form-type-material style="max-width: 180px;">
                                <select class="form-control orderStatus" order-type="topup" order_id="'.$row['id'].'">
                                     <option value="1" '.(($row['status'] == 1) ? 'selected' : '').'>
                                        Active
                                    </option>
                                    <option value="2" '.(($row['status'] == 2) ? 'selected' : '').'>
                                        Inactive
                                    </option>
                               </select>                                
                            </div>';

        $subData[]='<a class="btn btn-dark btn-sm mb-2" href="single-topup.php?e='.base64_encode($row['id']).'">Edit <i class="fa fa-pencil"></i></a>
                    <a val="'.$row['id'].'" class="btn btn-danger btn-sm text-white deleteData" del-type="topup">Delete <i class="fa fa-times"></i></a>';

        $data[]=$subData;
    }
    $json_data=array(
        'draw'           => intval($request['draw']),
        'recordsTotal'   => intval($totalRecord),
        'recordsFiltered'=> $totalRecord,
        'data'           =>$data

    );
    echo json_encode($json_data);

}

//=======================================================
//|                     ADD GAME TOP UP                 |
//=======================================================
if (isset($_POST['add_game_topup'])){
    $name = mi_secure_input($_POST['name']);
    $description = mi_secure_input($_POST['description']);
    $status = mi_secure_input($_POST['status']);
    $thumb = $_FILES['thumbnail'];
    $banner = $_FILES['banner'];

    $item_type = $_POST['item_type'];


    $items_db = mi_db_read_by_id('item_types', array('status'=> 1));
    $redems_db = mi_db_read_by_id('item_redems', array('status'=> 1));
    $player_info_db = mi_db_read_by_id('player_info', array('status'=> 1));

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Game top up name is required');
    }elseif (empty($description)){
        $msg = array('status'=>'error', 'msg'=>'Game top up description is required');
    }elseif (empty($thumb['name'])){
        $msg = array('status'=>'error', 'msg'=>'Game top up thumbnail is required');
    }elseif (empty($banner['name'])){
        $msg = array('status'=>'error', 'msg'=>'Game top up banner is required');
    }else{
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        $up_banner = str_replace(
            '../',
            '',
            mi_uploader(
                $banner['name'],
                $banner['tmp_name'],
                '../uploads/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        $data = [];
        foreach ($item_type as $key => $val){
            if ($val['id']){
//            $data[] = $val;
                $index = array_search($val['id'], array_column($items_db, 'id'));
                $type_name = $items_db[$index]['name'];
                $price = $item_price[$key];

                if ($val['is_redem'] == 'redeem'){
                    $data_redems = [];
                    foreach ($val['item_redem'] as $k => $redem){
                        if ($redem['id']){
                            $redem_index = array_search($redem['id'], array_column($redems_db, 'id'));
                            $redem_name = $redems_db[$redem_index]['title'];

                            $data_info = [];
                            foreach ($redem['player_info_in'] as $pi => $info){
                                $info_index = array_search($info['id'], array_column($player_info_db, 'id'));
                                $info_name = $player_info_db[$info_index]['title'];
                                $data_info[] = array(
                                    'pinfo_id' => $info['id'],
                                    'pinfo_name' => $info_name
                                );
                            }
                            $data_redems[] = array(
                                'redem_id' => $redem['id'],
                                'redem_name' => $redem_name,
                                'player_info' => $data_info
                            );
                        }
                    }

                    $data[] = array(
                        'type_id' => $val['id'],
                        'type_name' => $type_name,
                        'type_price' => $val['item_price'],
                        'type_redems' => $data_redems,

                    );

                }else{
                    $data_pinfo = [];
                    foreach ($val['player_info'] as $pk => $pinfo){
                        $pinfo_index = array_search($pinfo['id'], array_column($player_info_db, 'id'));
                        $pinfo_name = $player_info_db[$pinfo_index]['title'];
                        $data_pinfo[] = array(
                            'pinfo_id' => $pinfo['id'],
                            'pinfo_name' => $pinfo_name
                        );
                    }
                    $data[] = array(
                        'type_id' => $val['id'],
                        'type_name' => $type_name,
                        'type_price' => $val['item_price'],
                        'player_info' => $data_pinfo,

                    );
                }
            }
        }

        $all_data = array(
            'name' => $name,
            'description' => $description,
            'thumb' => $up_thumb,
            'banner' => $up_banner,
            'variation' => json_encode($data),
            'status' => $status
        );

        $insert = mi_db_insert('game_topup', $all_data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Game top up added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Game top up');
        }


    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/add-topup.php');
    
}

//=======================================================
//|                     EDIT GAME TOP UP                 |
//=======================================================
if (isset($_POST['edit_game_topup'])){
    $edit_id = mi_secure_input($_POST['edit_game_topup_id']);

    $name = mi_secure_input($_POST['name']);
    $description = mi_secure_input($_POST['description']);
    $status = mi_secure_input($_POST['status']);
    $thumb = $_FILES['thumbnail'];
    $banner = $_FILES['banner'];

    $item_type = $_POST['item_type'];


    $items_db = mi_db_read_by_id('item_types', array('status'=> 1));
    $redems_db = mi_db_read_by_id('item_redems', array('status'=> 1));
    $player_info_db = mi_db_read_by_id('player_info', array('status'=> 1));

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Game top up name is required');
    }elseif (empty($description)){
        $msg = array('status'=>'error', 'msg'=>'Game top up description is required');
    }else{
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        $up_banner = str_replace(
            '../',
            '',
            mi_uploader(
                $banner['name'],
                $banner['tmp_name'],
                '../uploads/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        $data = [];
        foreach ($item_type as $key => $val){
            if ($val['id']){
//            $data[] = $val;
                $index = array_search($val['id'], array_column($items_db, 'id'));
                $type_name = $items_db[$index]['name'];
                $price = $item_price[$key];

                if ($val['is_redem'] == 'redeem'){
                    $data_redems = [];
                    foreach ($val['item_redem'] as $k => $redem){
                        if ($redem['id']){
                            $redem_index = array_search($redem['id'], array_column($redems_db, 'id'));
                            $redem_name = $redems_db[$redem_index]['title'];

                            $data_info = [];
                            foreach ($redem['player_info_in'] as $pi => $info){
                                $info_index = array_search($info['id'], array_column($player_info_db, 'id'));
                                $info_name = $player_info_db[$info_index]['title'];
                                $data_info[] = array(
                                    'pinfo_id' => $info['id'],
                                    'pinfo_name' => $info_name
                                );
                            }
                            $data_redems[] = array(
                                'redem_id' => $redem['id'],
                                'redem_name' => $redem_name,
                                'player_info' => $data_info
                            );
                        }
                    }

                    $data[] = array(
                        'type_id' => $val['id'],
                        'type_name' => $type_name,
                        'type_price' => $val['item_price'],
                        'type_redems' => $data_redems,

                    );

                }else{
                    $data_pinfo = [];
                    foreach ($val['player_info'] as $pk => $pinfo){
                        $pinfo_index = array_search($pinfo['id'], array_column($player_info_db, 'id'));
                        $pinfo_name = $player_info_db[$pinfo_index]['title'];
                        $data_pinfo[] = array(
                            'pinfo_id' => $pinfo['id'],
                            'pinfo_name' => $pinfo_name
                        );
                    }
                    $data[] = array(
                        'type_id' => $val['id'],
                        'type_name' => $type_name,
                        'type_price' => $val['item_price'],
                        'player_info' => $data_pinfo,

                    );
                }
            }
        }

        if (empty($thumb['name']) && empty($banner['name'])){
            $all_data = array(
                'name' => $name,
                'description' => $description,
                'variation' => json_encode($data),
                'status' => $status
            );
        }elseif (empty($thumb)){
            $all_data = array(
                'name' => $name,
                'description' => $description,
                'banner' => $up_banner,
                'variation' => json_encode($data),
                'status' => $status
            );
        }elseif (empty($banner['name'])){
            $all_data = array(
                'name' => $name,
                'description' => $description,
                'thumb' => $up_thumb,
                'variation' => json_encode($data),
                'status' => $status
            );
        }else{
            $all_data = array(
                'name' => $name,
                'description' => $description,
                'thumb' => $up_thumb,
                'banner' => $up_banner,
                'variation' => json_encode($data),
                'status' => $status
            );
        }

        $update = mi_db_update('game_topup', $all_data, array('id'=> $edit_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Game top up updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to updated Game top up');
        }


    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/topup.php');
}

//=======================================================
//|                  SHOWING GIFT CARD                  |
//=======================================================

if (isset($_GET['get_gift_cards']) && !empty($_GET['get_gift_cards']) && $_GET['get_gift_cards'] ==1) {

    $request=$_REQUEST;
    $col=array(
        0 =>"id",
        1 =>"id",
        2 =>"name",
        3 =>"type",
        4 =>"created_at",
        5 =>"status",
    );
    $sql=mi_db_custom_query('SELECT * FROM gift_cards');

    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;

    $query='SELECT * FROM gift_cards';

    if (!empty($request['search']['value'])) {
        $query.=' WHERE id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR name LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR status LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR created_at LIKE "%'.$request['search']['value'].'%"';
//    print_r($query);
    }

    $sql=mi_db_custom_query($query);
    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;
    $query.=" ORDER BY ".$col[$request['order'][0]['column']]."  ".$request['order'][0]['dir']." LIMIT ".$request['start'].", ".$request['length']."  ";
    $sql=mi_db_custom_query($query);

    $data=array();
    foreach ($sql as $key=> $row) {

        $subData=array();
        $subData[]=$key+1;
        $subData[]='<img src="'.MI_BASE_URL.$row['thumb'].'" style="width:70px; height:70px">';

        $subData[]='<h5>'.$row['name'].'</h5>';

        $subData[]='<h5>'.($row['type'] == 1?'Regular':'Condition').'</h5>';

        $subData[]='<h5>'.date('M d, Y - H:i a', strtotime($row['created_at'])).'</h5>';

        $subData[]='<div class="form-group form-type-material style="max-width: 180px;">
                                <select class="form-control orderStatus" order-type="gift-card" order_id="'.$row['id'].'">
                                     <option value="1" '.(($row['status'] == 1) ? 'selected' : '').'>
                                        Active
                                    </option>
                                    <option value="2" '.(($row['status'] == 2) ? 'selected' : '').'>
                                        Inactive
                                    </option>
                               </select>                                
                            </div>';

        $subData[]='<a class="btn btn-dark btn-sm mb-2" href="single-card.php?ce='.base64_encode($row['id']).'">Edit <i class="fa fa-pencil"></i></a>
                    <a val="'.$row['id'].'" class="btn btn-danger btn-sm text-white deleteData" del-type="gift-card">Delete <i class="fa fa-times"></i></a>';

        $data[]=$subData;
    }
    $json_data=array(
        'draw'           => intval($request['draw']),
        'recordsTotal'   => intval($totalRecord),
        'recordsFiltered'=> $totalRecord,
        'data'           =>$data

    );
    echo json_encode($json_data);

}

//=======================================================
//|                     ADD GIFT CARD                   |
//=======================================================
if (isset($_POST['add_gift_card'])){
    $name = mi_secure_input($_POST['name']);
    $description = mi_secure_input($_POST['description']);
    $status = mi_secure_input($_POST['status']);
    $type = mi_secure_input($_POST['gift_card_type']);
    $price = mi_secure_input($_POST['price']);
    $thumb = $_FILES['thumbnail'];

    $card_type = $_POST['card_type'];
//    echo '<pre>';
//    print_r($card_type); return;


    $card_type_db = mi_db_read_by_id('card_types', array('status'=> 1));
    $card_option_db = mi_db_read_by_id('card_options', array('status'=> 1));

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Gift card name is required');
    }elseif (empty($description)){
        $msg = array('status'=>'error', 'msg'=>'Gift card description is required');
    }elseif (empty($price)){
        $msg = array('status'=>'error', 'msg'=>'Gift card price is required');
    }elseif (empty($thumb['name'])){
        $msg = array('status'=>'error', 'msg'=>'Gift card thumbnail is required');
    }elseif ($type == 2 && count($card_type) < 1){
        $msg = array('status'=>'error', 'msg'=>'Gift card variation is required');
    }else{

        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        if ($type == 2){
            $data = [];
            foreach ($card_type as $key => $val){
                if ($val['id']){
//            $data[] = $val;
                    $index = array_search($val['id'], array_column($card_type_db, 'id'));
                    $type_name = $card_type_db[$index]['name'];

                    $data_options = [];
                    foreach ($val['card_option'] as $k => $option){
                        if ($option['id']){
                            $option_index = array_search($option['id'], array_column($card_option_db, 'id'));
                            $option_name = $card_option_db[$option_index]['name'];

                            $data_options[] = array(
                                'option_id' => $option['id'],
                                'option_name' => $option_name
                            );
                        }
                    }

                    $data[] = array(
                        'region_id' => $val['id'],
                        'region_name' => $type_name,
                        'region_options' => $data_options

                    );

                }
            }


            $all_data = array(
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'thumb' => $up_thumb,
                'type' => $type,
                'variation' => json_encode($data),
                'status' => $status
            );

        }else{
            $all_data = array(
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'thumb' => $up_thumb,
                'type' => $type,
                'status' => $status
            );
        }


        $insert = mi_db_insert('gift_cards', $all_data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Gift card added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Gift card');
        }


    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/add-gift-card.php');

}

//=======================================================
//|                    EDIT GIFT CARD                   |
//=======================================================
if (isset($_POST['edit_gift_card'])){
    $edit_id = mi_secure_input($_POST['edit_gift_card_id']);
    $name = mi_secure_input($_POST['name']);
    $description = mi_secure_input($_POST['description']);
    $status = mi_secure_input($_POST['status']);
    $type = mi_secure_input($_POST['gift_card_type']);
    $price = mi_secure_input($_POST['price']);
    $thumb = $_FILES['thumbnail'];

    $card_type = $_POST['card_type'];
//    echo '<pre>';
//    print_r($card_type); return;


    $card_type_db = mi_db_read_by_id('card_types', array('status'=> 1));
    $card_option_db = mi_db_read_by_id('card_options', array('status'=> 1));

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Gift card name is required');
    }elseif (empty($description)){
        $msg = array('status'=>'error', 'msg'=>'Gift card description is required');
    }elseif (empty($price)){
        $msg = array('status'=>'error', 'msg'=>'Gift card price is required');
    }elseif ($type == 2 && count($card_type) < 1){
        $msg = array('status'=>'error', 'msg'=>'Gift card variation is required');
    }else{

        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        if ($type == 2){
            $data = [];
            foreach ($card_type as $key => $val){
                if ($val['id']){
//            $data[] = $val;
                    $index = array_search($val['id'], array_column($card_type_db, 'id'));
                    $type_name = $card_type_db[$index]['name'];

                    $data_options = [];
                    foreach ($val['card_option'] as $k => $option){
                        if ($option['id']){
                            $option_index = array_search($option['id'], array_column($card_option_db, 'id'));
                            $option_name = $card_option_db[$option_index]['name'];

                            $data_options[] = array(
                                'option_id' => $option['id'],
                                'option_name' => $option_name
                            );
                        }
                    }

                    $data[] = array(
                        'region_id' => $val['id'],
                        'region_name' => $type_name,
                        'region_options' => $data_options

                    );

                }
            }


            if (!empty($thumb['name'])){
                $all_data = array(
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'thumb' => $up_thumb,
                    'type' => $type,
                    'variation' => json_encode($data),
                    'status' => $status
                );
            }else{
                $all_data = array(
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'type' => $type,
                    'variation' => json_encode($data),
                    'status' => $status
                );
            }


        }else{
            if (!empty($thumb['name'])){
                $all_data = array(
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'thumb' => $up_thumb,
                    'type' => $type,
                    'variation' => null,
                    'status' => $status
                );
            }else{
                $all_data = array(
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'type' => $type,
                    'variation' => null,
                    'status' => $status
                );
            }

        }


        $update = mi_db_update('gift_cards', $all_data, array('id'=> $edit_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Gift card updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Gift card');
        }


    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/gift-card.php');

}

//===================================================================
//|                    SETTINGS CHANGES                             |
//===================================================================
//----------------------change site logo--------------------
if (isset($_POST['change_site_logo_submit'])){
    $id = mi_secure_input($_POST['site_logo_id']);

    $logo = $_FILES['site_logo'];

    if (empty($logo['name'])){
        $msg = array('status'=>'error', 'msg'=>'Logo is required');
    }else{
        $cut = mi_db_read_by_id('settings_meta', array('id' => $id))[0];
        $cut_logo = $cut['meta_value'];

        $up_logo = str_replace(
            '../',
            '',
            mi_uploader(
                $logo['name'],
                $logo['tmp_name'],
                '../assets/img/logo/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_logo != false){
            unlink('../'.$cut_logo);
        }
        $update = mi_db_update('settings_meta', array('meta_value' => $up_logo), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Site Logo updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Logo');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');

}

//----------------------change footer copyright--------------------
if (isset($_POST['change_footer_copyright_submit'])){
    $id = mi_secure_input($_POST['footer_copyright_id']);
    $footer_copyright = mi_secure_input($_POST['footer_copyright']);

    if(empty($footer_copyright) || !isset($footer_copyright)){
        $msg = array('status'=>'error', 'msg'=>'Footer Copyright is required!');
    }else{
        $update = mi_db_update('settings_meta', array('meta_value' => $footer_copyright), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Footer Copyright updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Footer Copyright');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');
}

//----------------------change copyright link--------------------
if (isset($_POST['change_copyright_link_submit'])){
    $id = mi_secure_input($_POST['copyright_link_id']);
    $copyright_link = mi_secure_input($_POST['copyright_link']);

    if(empty($copyright_link) || !isset($copyright_link)){
        $msg = array('status'=>'error', 'msg'=>'Copyright Link is required!');
    }else{
        $update = mi_db_update('settings_meta', array('meta_value' => $copyright_link), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Copyright Link updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Copyright Link');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');
}

//----------------------change banner slider--------------------
if (isset($_POST['change_banner_slider_submit'])){
    $id = mi_secure_input($_POST['edit_slider_id']);
    $banner_title = mi_secure_input($_POST['banner_title']);
    $banner_text = mi_secure_input($_POST['banner_text']);

    $slider = $_FILES['banner_slider'];

    if (!empty($slider['name'])){
        $cut = mi_db_read_by_id('slider', array('id' => $id))[0];
        $cut_slider = $cut['image'];

        $up_slider = str_replace(
            '../',
            '',
            mi_uploader(
                $slider['name'],
                $slider['tmp_name'],
                '../assets/img/slider/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_slider != false){
            unlink('../'.$cut_slider);
        }
        $data = array(
            'image' => $up_slider,
            'banner_title' => $banner_title,
            'banner_text' => $banner_text
        );

    }else{
        $data = array(
            'banner_title' => $banner_title,
            'banner_text' => $banner_text
        );
    }
    $update = mi_db_update('slider', $data, array('id' => $id));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Slider updated successfully');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update slider');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');

}

//----------------------change page banner--------------------
if (isset($_POST['change_page_banner_submit'])){
    $id = mi_secure_input($_POST['edit_banner_id']);

    $banner = $_FILES['banner_image'];

    if (empty($banner['name'])){
        $msg = array('status'=>'error', 'msg'=>'Banner is required');
    }else{
        $cut = mi_db_read_by_id('settings_meta', array('id' => $id))[0];
        $cut_banner = $cut['meta_value'];

        $up_banner = str_replace(
            '../',
            '',
            mi_uploader(
                $banner['name'],
                $banner['tmp_name'],
                '../assets/img/banner/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_banner != false){
            unlink('../'.$cut_banner);
        }
        $update = mi_db_update('settings_meta', array('meta_value' => $up_banner), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Page banner updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update banner');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');

}

//----------------------change feature items--------------------
if (isset($_POST['change_feature_item_submit'])){
    $id = mi_secure_input($_POST['edit_feature_id']);
    $feature_title = mi_secure_input($_POST['feature_title']);
    $feature_text = mi_secure_input($_POST['feature_text']);

    $image = $_FILES['feature_image'];

    if (empty($feature_title)){
        $msg = array('status'=>'error', 'msg'=>'Feature title is required');
    }elseif (empty($feature_text)){
        $msg = array('status'=>'error', 'msg'=>'Feature text is required');
    }else{
        $existing_feature = mi_db_read_by_id('settings_meta', array('id'=> $id))[0];
        $feature_data = json_decode($existing_feature['meta_value'], true);
        if (!empty($image['name'])){

            $up_image = str_replace(
                '../',
                '',
                mi_uploader(
                    $image['name'],
                    $image['tmp_name'],
                    '../assets/img/icon-img/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
                )
            );

            $feature_data['icon'] = $up_image;
            $feature_data['title'] = $feature_title;
            $feature_data['text'] = $feature_text;

        }else{
            $feature_data['title'] = $feature_title;
            $feature_data['text'] = $feature_text;
        }
        $update = mi_db_update('settings_meta', array('meta_value'=> json_encode($feature_data)), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Feature updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update feature');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');

}

//----------------------change footer banner----------------------
if (isset($_POST['change_footer_banner_submit'])){
    $id = mi_secure_input($_POST['edit_footer_banner_id']);

    $footer_banner = $_FILES['footer_banner_image'];

    if (empty($footer_banner['name'])){
        $msg = array('status'=>'error', 'msg'=>'Footer Banner is required');
    }else{
        $cut = mi_db_read_by_id('settings_meta', array('id' => $id))[0];
        $cut_banner = $cut['meta_value'];

        $up_banner = str_replace(
            '../',
            '',
            mi_uploader(
                $footer_banner['name'],
                $footer_banner['tmp_name'],
                '../assets/img/banner/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_banner != false){
            unlink('../'.$cut_banner);
        }
        $update = mi_db_update('settings_meta', array('meta_value' => $up_banner), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Footer banner updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update footer banner');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');

}

//----------------------change about us image----------------------
if (isset($_POST['change_aboutus_img_submit'])){
    $id = mi_secure_input($_POST['edit_aboutus_img_id']);

    $image = $_FILES['aboutus_image'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Image is required');
    }else{
        $cut = mi_db_read_by_id('settings_meta', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../assets/img/icon-img/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('settings_meta', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Image updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update image');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');

}

//----------------------change about us text--------------------
if (isset($_POST['change_aboutus_text_submit'])){
    $id = mi_secure_input($_POST['edit_aboutus_text_id']);
    $text = mi_secure_input($_POST['aboutus_text']);

    if(empty($text)){
        $msg = array('status'=>'error', 'msg'=>'About us text is required');
    }else{
        $update = mi_db_update('settings_meta', array('meta_value' => $text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'About us text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update About us text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');
}

//----------------------------change social icon-------------------------
if (isset($_POST['change_social_icon_submit'])){
    $data = $_POST['social_data'];

    foreach ($data['id'] as $k => $id){
        mi_db_update(
            'settings_meta',
            array(
                'meta_name' => (isset($data['icon'][$k]) && !empty($data['icon'][$k])? mi_secure_input($data['icon'][$k]):''),
                'meta_value' => (isset($data['link'][$k]) && !empty($data['link'][$k])? mi_secure_input($data['link'][$k]):'')
            ),
            array('id' =>$id)
        );
    }
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');
}

//----------------------change contact info--------------------
if (isset($_POST['change_contact_info_submit'])){
    $id = mi_secure_input($_POST['contact_info_id']);
    $contact_info = mi_secure_input($_POST['contact_info']);

    if(empty($contact_info) || !isset($contact_info)){
        $msg = array('status'=>'error', 'msg'=>'Contact info is required!');
    }else{
        $update = mi_db_update('settings_meta', array('meta_value' => $contact_info), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Contact info updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Contact info');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/site-settings.php');
}

//=======================================================
//|               SHOWING CONTACT REQUESTS              |
//=======================================================

if (isset($_GET['get_contact_requests']) && !empty($_GET['get_contact_requests']) && $_GET['get_contact_requests'] ==1) {

    $request=$_REQUEST;
    $col=array(
        0 =>"id",
        1 =>"name",
        2 =>"email",
        3 =>"subject",
        4 =>"message",
        5 =>"created_at",
    );
    $sql=mi_db_custom_query('SELECT * FROM contact_request');

    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;

    $query='SELECT * FROM contact_request';

    if (!empty($request['search']['value'])) {
        $query.=' WHERE id LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR name LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR email LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR subject LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR message LIKE "%'.$request['search']['value'].'%"';
        $query.=' OR created_at LIKE "%'.$request['search']['value'].'%"';
//    print_r($query);
    }

    $sql=mi_db_custom_query($query);
    $totalRecord=count($sql);
    $totalFiltered=$totalRecord;
    $query.=" ORDER BY ".$col[$request['order'][0]['column']]."  ".$request['order'][0]['dir']." LIMIT ".$request['start'].", ".$request['length']."  ";
    $sql=mi_db_custom_query($query);

    $data=array();
    foreach ($sql as $key=> $row) {

        $subData=array();
        $subData[]=$key+1;

        $subData[]='<h5>'.$row['name'].'</h5>';

        $subData[]='<h5>'.$row['email'].'</h5>';

        $subData[]='<h5>'.$row['subject'].'</h5>';

        $subData[]='<small>'.$row['message'].'</small>';

        $subData[]='<h5>'.date('M d, Y - H:i a', strtotime($row['created_at'])).'</h5>';

        $subData[]='<a val="'.$row['id'].'" class="btn btn-danger btn-sm text-white deleteData" del-type="contact-request">Delete <i class="fa fa-times"></i></a>';


        $data[]=$subData;
    }
    $json_data=array(
        'draw'           => intval($request['draw']),
        'recordsTotal'   => intval($totalRecord),
        'recordsFiltered'=> $totalRecord,
        'data'           =>$data

    );
    echo json_encode($json_data);

}

//=======================================================
//|               UPDATE ADMIN PROFILE                  |
//=======================================================

if (isset($_POST['update_profile']) && !empty($_POST['update_profile'])){
    $user = mi_secure_input($_POST['update_profile']);
    $name = mi_secure_input($_POST['user_name']);
    $phone = mi_secure_input($_POST['user_phone']);
    $address = mi_secure_input($_POST['user_address']);

    $image = $_FILES['image'];

    if (empty($user) || empty($phone) || empty($address)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }else{
        $cut = mi_db_read_by_id('mi_admin', array('id' => $user))[0];
        $cut_img = $cut['user_photo'];
//        ----------------------
        if (!empty($image['name'])){
            $up_img = mi_uploader(
                $image['name'],
                $image['tmp_name'],
                'staff-uploads/staff-profile/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            );
            if ($up_img != false){
                unlink($cut_img);
            }

            $data = array(
                'user_name' => $name,
                'user_phone' => $phone,
                'user_address' => $address,
                'user_photo' => $up_img,
            );
        }else{
            $data = array(
                'user_name' => $name,
                'user_phone' => $phone,
                'user_address' => $address
            );
        }
//        ----------------------
        $update = mi_db_update('mi_admin', $data, array('id'=>$user));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Profile updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update profile.');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/profile.php');
}


if (isset($_POST['update_password']) && !empty($_POST['update_password'])){
    $user = mi_secure_input($_POST['update_password']);
    $current = mi_secure_input($_POST['current']);
    $new = mi_secure_input($_POST['new']);
    $confirm = mi_secure_input($_POST['confirm']);

    if (empty($current) || empty($new) || empty($confirm)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }elseif ($new != $confirm){
        $msg = array('status'=>'error', 'msg'=>'New passwords are not matching');
    }else{
        $check = mi_db_read_by_id('mi_admin', array('id'=>$user));
        if (count($check)>0){
            if ($check[0]['user_password'] == md5($current)){
                $data = array(
                    'user_password' => md5($confirm),
                    'user_salt' => $new
                );
                $update = mi_db_update('mi_admin', $data, array('id'=>$user));
                if ($update == true){
                    $msg = array('status'=>'success', 'msg'=>'Password updated successfully');
                }else{
                    $msg = array('status'=>'error', 'msg'=>'Error to update password.');
                }
            }else{
                $msg = array('status'=>'error', 'msg'=>'Current password not matching');
            }

        }else{
            $msg = array('status'=>'error', 'msg'=>'Undefined user');
        }

    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/profile.php');
}
