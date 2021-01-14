/**
 * Created by monir on 6/11/2020.
 */

(function( $ ) {

    "use strict";
    var base_url = $('#base_url').val();

    // -------------notify toaster-------------
    function mi_notify(message) {
        app.toast(message, {
            duration: 4000
        });
    }

    function change_status(id, type, status) {
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                mi_update_status_request: 1,
                type: type,
                id: id,
                status: status
            },
            success:function(data){
                console.log(data);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });
    }

    $('.mi-status-update').on('change', function (e) {
        e.preventDefault();
        var type = $(this).attr('mitype');
        var id = $(this).attr('mid');
        var status = $(this).find('option:selected').val();
        change_status(id, type, status);
    });


    // --------------------data delete-------------------
    $('body').on('click','.deleteData', function(){
        var id = $(this).attr('val');
        var type = $(this).attr('del-type');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    data_delete_request: 1,
                    id: id,
                    type: type
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Data deleted.',
                        'success'
                    );
                    setTimeout(function () {
                        window.location.reload();

                    }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });


    // ---------------------------change status----------------------
    $('body').on('change', '.orderStatus', function () {
        var id = $(this).attr('order_id');
        var status = $(this).find('option:selected').val();
        var order_type = $(this).attr('order-type');
        // console.log(id);
        // console.log(status);
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                change_order_status_request: 1,
                id: id,
                status: status,
                order_type: order_type
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    if (status == 5){
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });


    });

    // $('body').on('click', '.item-type-selection', function () {
    //    if ($(this).is(":checked")){
    //        $('.item-redem-selection').removeClass('d-none');
    //    }
    // });

    $('input[type="checkbox"].item-type-selection').on('change', function(){
        var thisContainer = $(this).data('key');
        if($(this).is(":checked")){
            $('.'+thisContainer).removeClass('d-none');
        }else{
            $('.'+thisContainer).addClass('d-none');
        }
    });

    $('input[type="checkbox"].item-redem-selection').on('change', function(){
        var thisContainer = $(this).data('key');
        if($(this).is(":checked")){
            $('.'+thisContainer).removeClass('d-none');
        }else{
            $('.'+thisContainer).addClass('d-none');
        }
    });


    $('.redem_check').on('click', function (e) {
        e.preventDefault();
        var target = $(this).attr('type-key');
        var typeVal = $(this).attr('type-val');

        $(target).val(typeVal);
    });

    $('input[type="checkbox"].card-type-selection').on('change', function(){
        var thisContainer = $(this).data('key');
        if($(this).is(":checked")){
            $('.'+thisContainer).removeClass('d-none');
        }else{
            $('.'+thisContainer).addClass('d-none');
        }
    });

    $('body').on('change', '#gift_card_type', function () {
       var type_val = $(this).val();

       if (type_val == 1){
            $('.variations_container').addClass('d-none');
       }else{
           $('.variations_container').removeClass('d-none');
       }
    });


 
})(jQuery);