<?php
    if (empty(mi_get_session('admin'))){
        mi_redirect(MI_BASE_URL.'admin/logout.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TheAdmin - Responsive Bootstrap 4 Admin, Dashboard &amp; WebApp Template">
    <meta name="keywords" content="dashboard, index, main">

    <title>Mi Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i|Dosis:300,500" rel="stylesheet">

    <!-- Styles -->
    <link href="assets/css/core.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/style.min.css" rel="stylesheet">
    <link href="assets/css/mi.css" rel="stylesheet">
    <link href="assets/vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!--mdb-->
<!--    <link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
<!--    <link href="assets/css/mdb.min.css" rel="stylesheet">-->
<!--    Font Awesome-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">-->

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.png">

</head>

<body class="pace-done">
<input type="hidden" id="base_url" value="<?=MI_BASE_URL;?>">

<?php if (!empty(mi_get_session('alert')) && count(mi_get_session('alert'))>0){?>
<div class="alert alert-<?=((mi_get_session('alert')['status']) == 'success'?'success':'danger');?> alert-dismissible fade show" role="alert" style="position: absolute;z-index: 999999;left: 35%;right: auto;">

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <?=mi_get_session('alert')['msg'];?>
</div>
<?php mi_unset('alert');}?>

<!-- Preloader -->
<div class="preloader">
    <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
    </div>
</div>