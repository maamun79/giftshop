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
            <div class="card-header">
                MI Tailoring Setup Credentials
            </div>
            <div class="card-body">
                <?php
                    if (isset($_GET['alert']) && !empty($_GET['alert'])){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_GET['alert'];?>
                </div>
                <?php }?>
                <form action="action.php" method="post" enctype="multipart/form-data">
                    <p>Below you should enter your database connection details. If you’re not sure about these, contact your host.</p>
                    <table class="table">
                        <tr>
                            <th>Site Url</th>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="siteurl" placeholder="Enter Website Url">
                                </div>
                            </td>
                            <td style="max-width: 300px;">Site Url will be the domain name of your site. That will follow the strict structure. <strong>Example: http://example.com/</strong></td>
                        </tr>
                        <tr>
                            <th>Database Name</th>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="dbname" placeholder="Enter Database Name">
                                </div>
                            </td>
                            <td style="max-width: 300px;">The name of the database you want to use on the system.</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="dbuser" placeholder="Enter Username">
                                </div>
                            </td>
                            <td style="max-width: 300px;">Your database username.</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="dbpass" placeholder="Enter Password">
                                </div>
                            </td>
                            <td style="max-width: 300px;">Your database password.</td>
                        </tr>
                        <tr>
                            <th>Database Host</th>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="dbhost" placeholder="Enter Database Host" value="localhost">
                                </div>
                            </td>
                            <td style="max-width: 300px;">You should be able to get this info from your web host, if localhost doesn’t work.</td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                <button class="btn btn-lg btn-primary" type="submit" name="setupComplete">Complete Setup</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>