/**
 * Created by monir on 11/30/2020.
 */
(function($) {
    'use strict';

    function mi_notify(type=null, message) {
        // Display an info toast with no title
        toastr.options.closeButton = true;
        if (type == 'success'){
            toastr.success(message);
        }else{
            toastr.info(message);
        }
    }

    function get_redeems(id, type) {
        $.ajax({
            type:'post',
            url:'api/',
            data: {
                get_redeems_all: 1,
                id: id,
                type: type
            },
            success:function(data){
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    var html = '';
                    if (res.redeems.type_redems != undefined && res.redeems.type_redems != "" && res.redeems.type_redems.length > 0){
                        for (var i = 0; i < res.redeems.type_redems.length; i++){
                            html+=`<li class="pz">
                                   <label class="radio-inline">
                                       <input type="radio" id="redeem_id`+res.redeems.type_redems[i].redem_id+`" name="item_redeem" class="pro-chx" value="`+res.redeems.type_redems[i].redem_id+`">
                                       <div class="clab">`+res.redeems.type_redems[i].redem_name+`</div>
                                   </label>
                               </li>`;
                        }

                        $('#item_redeem_container ul.chec-radio').html(html);
                        $('#item_redeem_container').fadeIn();
                        $('#item_player_container').hide();
                        $('.mi-buy-now').attr('disabled', true);
                        $('#item_player_credentials').hide();
                    }else{
                        if (res.redeems.player_info != undefined && res.redeems.player_info != "" && res.redeems.player_info.length > 0){
                            if (res.redeems.player_info[0].pinfo_id == 1){
                                $('#item_player_credentials #via_character').show();
                                $('#item_player_credentials #via_login').hide();
                            }else{
                                $('#item_player_credentials #via_character').hide();
                                $('#item_player_credentials #via_login').show();
                            }
                            $('#item_player_credentials').fadeIn();
                            $('#item_redeem_container').hide();
                            $('#item_player_container').hide();
                            $('.mi-buy-now').attr('disabled', false);
                            $('#item_player_credentials').show();
                        }
                    }
                }
            }
        });
    }

    function get_player_info(id, game_top, type) {
        $.ajax({
            type:'post',
            url:'api/',
            data: {
                get_player_info_all: 1,
                game_top: game_top,
                type: type,
                id: id
            },
            success:function(data){
                var res = JSON.parse(data);
                // cosole.log(res);
                if (res.status == 'success'){
                    var html = '';
                    for (var i = 0; i < res.player_info.length; i++){
                        html+=`<li class="pz">
                                   <label class="radio-inline">
                                       <input type="radio" id="redeem_id`+res.player_info[i].pinfo_id+`" name="item_player_info" class="pro-chx" value="`+res.player_info[i].pinfo_id+`">
                                       <div class="clab">`+res.player_info[i].pinfo_name+`</div>
                                   </label>
                               </li>`;
                    }
                    if (res.player_info.length <= 0){
                        $('.mi-buy-now').attr('disabled', false);
                        $('#item_player_container ul.chec-radio').html('');
                        $('#item_player_container').hide();
                        $('#item_player_credentials').hide();
                    }else{
                        $('.mi-buy-now').attr('disabled', true);
                        $('#item_player_container ul.chec-radio').html(html);
                        $('#item_player_container').fadeIn();
                    }
                }
            }
        });
    }

    $('input[name=item_type]').on('change', function (e) {
        e.preventDefault();
        var id = $(this).val();
        var type = $(this).attr('type_id');
        var price = $(this).attr('type_price');
        $('#priceInfo').html('TK '+price);
        $('#priceInfo').attr('order-amount', price);
        $('.payment-price-container').fadeIn();
        get_redeems(id, type);
    });

    $('body').on('change', 'input[name=item_redeem]', function (e) {
        e.preventDefault();
        var game_top = $('input[name=item_type]:checked').val();
        var type = $('input[name=item_type]:checked').attr('type_id');
        var id = $(this).val();
        get_player_info(id, game_top, type);
    });

    $('body').on('change', 'input[name=item_player_info]', function (e) {
        e.preventDefault();
        var id = $(this).val();
        if (id == 1){
            $('#item_player_credentials #via_character').show();
            $('#item_player_credentials #via_login').hide();
        }else{
            $('#item_player_credentials #via_character').hide();
            $('#item_player_credentials #via_login').show();
        }
        $('#item_player_credentials').fadeIn();
        $('.mi-buy-now').attr('disabled', false);
    });



    function get_options(id, type) {
        $.ajax({
            type:'post',
            url:'api/',
            data: {
                get_options_all: 1,
                id: id,
                type: type
            },
            success:function(data){
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    var html = '';
                    if (res.options != undefined && res.options != "" && res.options.length > 0){
                        for (var i = 0; i < res.options.length; i++){
                            html+=`<li class="pz">
                                   <label class="radio-inline">
                                       <input type="radio" id="redeem_id`+res.options[i].option_id+`" name="item_options" class="pro-chx" value="`+res.options[i].option_id+`">
                                       <div class="clab">`+res.options[i].option_name+`</div>
                                   </label>
                               </li>`;
                        }

                        $('.mi-buy-now').attr('disabled', true);
                        $('#item_redeem_container ul.chec-radio').html(html);
                        $('#item_redeem_container').fadeIn();
                    }else{
                        $('#item_redeem_container').hide();
                        $('.mi-buy-now').attr('disabled', false);
                    }
                }
            }
        });
    }


    $('input[name=region_type]').on('change', function (e) {
        e.preventDefault();
        var id = $(this).val();
        var type = $(this).attr('type_id');
        get_options(id, type);
    });

    $('body').on('change', 'input[name=item_options]', function (e) {
        e.preventDefault();
        $('.mi-buy-now').attr('disabled', false);
    });

    $('body').on('click', '.topup-order', function () {
        var topup_id         = $('#topup-id').val();
        var item_type_id     = $('input[name="item_type"]:checked').attr('type_id');
        var item_redem_id    = $('input[name="item_redeem"]:checked').val();
        var player_info_id   = $('input[name="item_player_info"]:checked').val();
        var character_id     = $('#character_id').val();
        var character_name   = $('#character_name').val();
        var character_number = $('#character_number').val();
        var login_type       = $('input[name="login_info_type"]:checked').val();
        var login_id         = $('#login_id').val();
        var login_password   = $('#login_password').val();
        var login_number     = $('#player_number').val();
        var bkash_number     = $('#payment_number').val();
        var transaction_id   = $('#payment_trx').val();
        var order_email      = $('#order_email').val();
        var order_amount     = $('#priceInfo').attr('order-amount');

        $.ajax({
           type: 'POST',
           url: 'api/',
           data:{
               get_topup_order  :1,
               topup_id         : topup_id,
               item_type_id     : item_type_id,
               item_redem_id    : item_redem_id,
               player_info_id   : player_info_id,
               character_id     : character_id,
               character_name   : character_name,
               character_number : character_number,
               login_type       : login_type,
               login_id         : login_id,
               login_password   : login_password,
               login_number     : login_number,
               bkash_number     : bkash_number,
               transaction_id   : transaction_id,
               order_email      : order_email,
               order_amount     : order_amount

           },beforeSend:function () {
                $('.topup-order').attr('disabled', true);
                $('.topup-order span').removeClass('d-none');
            },success:function (res) {
                var data = JSON.parse(res);
                mi_notify(data.status, data.msg);
                if (data.status == 'success'){
                    // $('.topup-order').attr('disabled', true);
                    // $('.topup-order span').removeClass('d-none');
                    setTimeout(function(){
                        window.location.href = 'order-confirmation.php?o='+data.order_id;
                    }, 3000);
                }else if(data.status == 'error'){
                    $('.topup-order').removeAttr('disabled', true);
                    $('.topup-order span').addClass('d-none');
                }
            }
        });
    });


    $('body').on('click', '.gift-card-order', function () {
        var card_id          = $('#gift-card-id').val();
        var card_type_id     = $('input[name="region_type"]:checked').attr('type_id');
        var card_option_id    = $('input[name="item_options"]:checked').val();
        var bkash_number     = $('#payment_number').val();
        var transaction_id   = $('#payment_trx').val();
        var order_email      = $('#order_email').val();
        var order_amount     = $('#priceInfo').attr('order-amount');

        $.ajax({
            type: 'POST',
            url: 'api/',
            data:{
                get_gift_card_order  :1,
                card_id         : card_id,
                card_type_id     : card_type_id,
                card_option_id    : card_option_id,
                bkash_number     : bkash_number,
                transaction_id   : transaction_id,
                order_email      : order_email,
                order_amount     : order_amount

            },beforeSend:function () {
                $('.gift-card-order').attr('disabled', true);
                $('.gift-card-order span').removeClass('d-none');
            },success:function (res) {
                var data = JSON.parse(res);
                mi_notify(data.status, data.msg);
                if (data.status == 'success'){
                    // $('.gift-card-order').attr('disabled', true);
                    // $('.gift-card-order span').removeClass('d-none');
                    setTimeout(function(){
                        window.location.href = 'order-confirmation.php?o='+data.order_id;
                    }, 3000);
                }else if(data.status == 'error'){
                    $('.gift-card-order').removeAttr('disabled');
                    $('.gift-card-order span').addClass('d-none');
                }
            }
        });
    });

    $('body').on('click', '#currency-convert-btn', function () {
       var amount = $('#currency_amount').val();
       var option = $('#currency_option').val();
       var method = $('#currency_method').val();

       $.ajax({
           type: 'POST',
           url: 'api/',
           data: {
               currency_convert: 1,
               amount : amount,
               option : option,
               method : method
           },success:function (res) {
                var data = JSON.parse(res);
                if (data.status == 'error'){
                    mi_notify(data.status, data.msg);
                }else{
                    var html =`<h4 class="text-white">`+ amount +` `+ data.method +` = <br>
                                    <span class="pt-5" style="font-size: 40px">`+ data.total +` BDT</span>
                               </h4>
                               <p class="text-white">1 `+ data.method +` = `+ data.rate +` BDT</p>`;

                    $('.exchange_details').removeClass('d-none');
                    $('.exchange_details').html(html);
                    $('.currency-confirm-buttons').removeClass('d-none');
                    $('.currency-converter').addClass('d-none');
                }
           }
       });
    });

    $('body').on('click', '#go-back-currency-convert-btn', function () {
        $('.exchange_details').addClass('d-none');
        $('.currency-confirm-buttons').addClass('d-none');
        $('.currency-converter').removeClass('d-none');
    });

    $('body').on('click', '.currency_order_btn', function () {
        var sender_bkash_number = $('#payment_number').val();
        var sender_bkash_trans_id = $('#payment_trx').val();
        var receive_account_email = $('#receive_account_email').val();
        var receiver_name = $('#receiver_name').val();

        var sender_mail = $('#sender_mail').val();
        var sender_mail_trans_id = $('#trans_id').val();
        var receive_bkash_number = $('#receive_bkash_number').val();
        var order_email = $('#order_email').val();

        $.ajax({
            type: 'POST',
            url: 'api/',
            data:{
                currency_order: 1,
                sender_bkash_number: sender_bkash_number,
                sender_bkash_trans_id: sender_bkash_trans_id,
                receive_account_email: receive_account_email,
                sender_mail: sender_mail,
                sender_mail_trans_id: sender_mail_trans_id,
                receive_bkash_number: receive_bkash_number,
                receiver_name: receiver_name,
                order_email: order_email
            },beforeSend:function () {
                $('.currency_order_btn').attr('disabled', true);
                $('.currency_order_btn span').removeClass('d-none');
            },success:function (res) {
                var data = JSON.parse(res);
                mi_notify(data.status, data.msg);
                if (data.status == 'success'){
                    setTimeout(function(){
                        window.location.href = 'order-confirmation.php?o='+data.order_id;
                    }, 3000);
                }else if(data.status == 'error'){
                    $('.currency_order_btn').removeAttr('disabled');
                    $('.currency_order_btn span').addClass('d-none');
                }
            }
        });
    });

    $('body').on('click', '#order-track-btn', function () {
       var order_id = $('#track_order_id').val();
       var item_type = $('#order_item_type').val();

       $.ajax({
           type: 'POST',
           url: 'api/',
           data:{
               order_track: 1,
               order_id: order_id,
               item_type: item_type
           },success:function (res) {
               var data = JSON.parse(res);
               // console.log(data.order_details.order_id);
               if (data.status == 'error'){
                   $('#order-track-container').addClass('d-none');
                   mi_notify(data.status, data.msg);
               }else{
                    $('#order-track-container').removeClass('d-none');
                    $('.track-details-order-id span').text(data.order_details.order_id);
                    $('.track-details-order-date span').text(data.order_details.created_at);
                    if (item_type == 1){
                        $('.track-details-item-type').text('Game top up');

                        $('.topup-giftcard-tracking-img').removeClass('d-none');
                        $('.currency-tracking-details').addClass('d-none');
                        $('.track-details-order-img').attr('src', data.item_details.thumb);
                    }else if(item_type == 2){
                        $('.track-details-item-type').text('Gift card');

                        $('.topup-giftcard-tracking-img').removeClass('d-none');
                        $('.currency-tracking-details').addClass('d-none');
                        $('.track-details-order-img').attr('src', data.item_details.thumb);
                    }else if(item_type == 3){
                        $('.track-details-item-type').text('Currency exchange');

                        $('.currency-tracking-details').removeClass('d-none');
                        $('.topup-giftcard-tracking-img').addClass('d-none');
                        $('.track-details-ex-method span').text(data.item_details.name);
                        $('.track-details-ex-amount span').text(data.order_details.exchange_amount +' USD');
                        if (data.order_details.exchange_type == 1){
                            $('.track-details-ex-type span').text('Buy');
                        }else{
                            $('.track-details-ex-type span').text('Sell');
                        }
                    }

                    $('.track-details-order-total').text(data.order_details.order_amount);

                    if (data.order_details.order_status == 1){
                        $('#step1').addClass('active');

                        $('#step2').removeClass('active');
                        $('#step3').removeClass('active');

                        $('#step1').removeClass('cancel');
                        $('#step2').removeClass('cancel');
                        $('#step3').removeClass('cancel');

                        $('.track-details-order-status span').text('Pending');
                    }else if (data.order_details.order_status == 2){
                        $('#step1').addClass('active');
                        $('#step2').addClass('active');

                        $('#step3').removeClass('active');

                        $('#step1').removeClass('cancel');
                        $('#step2').removeClass('cancel');
                        $('#step3').removeClass('cancel');

                        $('.track-details-order-status span').text('Confirm');
                    }else if (data.order_details.order_status == 3){
                        $('#step1').addClass('active');
                        $('#step2').addClass('active');
                        $('#step3').addClass('active');

                        $('#step1').removeClass('cancel');
                        $('#step2').removeClass('cancel');
                        $('#step3').removeClass('cancel');

                        $('.track-details-order-status span').text('Completed');
                    }else{
                        $('#step1').removeClass('active');
                        $('#step2').removeClass('active');
                        $('#step3').removeClass('active');

                        $('#step1').addClass('cancel');
                        $('#step2').addClass('cancel');
                        $('#step3').addClass('cancel');

                        $('.track-details-order-status span').text('Cancelled');
                    }
               }
           }
       });
    });

    $('body').on('click', '.contact_submit', function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();

        $.ajax({
            type: 'POST',
            url: 'api/',
            data: {
                contact_request: 1,
                name: name,
                email: email,
                subject: subject,
                message: message
            },success:function (res) {
                var data = JSON.parse(res);
                mi_notify(data.status, data.msg);
                if (data.status == 'success'){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                }
            }
        });
    });


})(jQuery);