<?php
if (!empty(mi_get_session('admin'))){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}

$brand_logo = mi_db_read_by_id('settings_meta', array('meta_name' => 'site_logo'))[0];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="login, signin">

    <title>Perennial Admin Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="assets/css/core.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.png">
  </head>

  <body>



    <div class="row min-h-fullscreen center-vh p-20 m-0">
      <div class="col-12">
        <div class="text-center">
            <img src="<?=MI_BASE_URL.$brand_logo['meta_value'];?>" alt="logo icon" style="max-width: 350px;margin-bottom: 30px;">
        </div>
        <div class="card card-shadowed px-50 py-30 w-400px mx-auto" style="max-width: 100%">
          <h5 class="text-uppercase">Sign in</h5>
          <br>
            <?php if (!empty(mi_get_session('alert')) && count(mi_get_session('alert'))>0){?>
                <p class="font-weight-bold text-danger"><?=mi_get_session('alert')['msg'];?></p>
            <?php mi_unset('alert');}?>

          <form class="form-type-material" action="actions.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control" id="username" name="username">
              <label for="username">Username</label>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password">
              <label for="password">Password</label>
            </div>

            <div class="form-group">
              <button class="btn btn-bold btn-block btn-primary" name="admin_login" type="submit">Login</button>
            </div>
          </form>
        </div>
      </div>


      <footer class="col-12 align-self-end text-center fs-13">
        <p class="mb-0"><small>Copyright © 2020 <a href="http://misujon.com/">M.i.sujon</a>. All rights reserved.</small></p>
      </footer>
    </div>




    <!-- Scripts -->
    <script src="assets/js/core.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/script.min.js"></script>

  </body>
</html>
