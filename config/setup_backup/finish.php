<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MI Tailoring Setup</title>
    <meta name="description" content="MI Tailoring Setup Processor">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

<section>
    <div class="container">
        <div class="col-6 offset-3 text-center mt-5 pt-4">
            <img src="Logo.png" alt="" style="max-width: 200px;">
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <?php
                if (isset($_GET['alert']) && !empty($_GET['alert'])){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?=$_GET['alert'];?>
                    </div>
                <?php }?>
                <form action="<?=MI_BASE_URL;?>" method="post" enctype="multipart/form-data" class="text-center">
                    <h1>Setup Completed Successfully</h1>
                    <br>
                    <p>For security reason please delete the setup folder by clicking below button. After clicking on the button the system will be in live.</p>
                    <p>Thank you for your patience!</p>
                    <button type="submit" name="delete_setup" class="btn btn-lg btn-primary">
                        Delete Setup Folder!
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>