<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 8/9/2020
 * Time: 10:07 PM
 */

if (isset($_POST['setupComplete'])){
    $siteUrl = trim($_POST['siteurl']);
    $dbhost = trim($_POST['dbhost']);
    $dbname = trim($_POST['dbname']);
    $dbuser = trim($_POST['dbuser']);
    $dbpass = trim($_POST['dbpass']);
    $msg = '';
    $flag = true;
    if (empty($dbname)){
        $msg = 'Database Name is required';
        $flag = false;
    }elseif (empty($siteUrl)){
        $msg = 'Site Url is required';
        $flag = false;
    }elseif (empty($dbhost)){
        $msg = 'Database Host is required';
        $flag = false;
    }elseif (empty($dbuser)){
        $msg = 'Database Username is required';
        $flag = false;
    }else{
        $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if(mysqli_connect_errno()){
            $msg = 'Database connection failed: '. mysqli_connect_error();
            $flag = false;
        }else{
            echo '<pre>';
            $env = '../../.env';

            if (file_exists($env)){
                $envData = 'APP_NAME=Laravel
APP_URL='.$siteUrl.'
APP_SESSION=true

DB_HOST='.$dbhost.'
DB_DATABASE='.$dbname.'
DB_USERNAME='.$dbuser.'
DB_PASSWORD='.$dbpass.'

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=example@email.com
MAIL_PASSWORD=123456MI
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=example@email.com
MAIL_FROM_NAME=Mi';

                if (file_put_contents($env, $envData)){
                    $contents = file_get_contents('setup_data.mi');
                    $sql = explode('<MI_BREAK>', $contents);

                    $message = [];
                    unset($sql[count($sql)-1]);

                    foreach($sql as $query){
                        $result = mysqli_query($db, $query);
                        if ($result){
                            $message[] = 1;
                        }else{
                            $message[] = 0;
                        }
                    }
//                    fclose($handle);

                    if (!in_array(0, $message)){
                        $msg = 'Setup completed successfully';
                        $flag = true;
                    }else{
                        $msg = 'Error to Import Data!';
                        $flag = false;
                    }
                }else{
                    $msg = 'Setup env not generated.';
                    $flag = false;
                }
            }else{
                $msg = 'Setup File Not Found!';
                $flag = false;
            }
        }
    }

    if ($flag == false){
        mi_redirect('credentials.php?alert='.$msg);
    }else{
        mi_redirect('finish.php?alert='.$msg);
    }
}