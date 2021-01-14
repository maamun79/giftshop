<?php
/**
 * Author: Monirul Islam
 * Author Url: http://www.misujon.com/
 */

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Dhaka');

/*==================================== MI SESSION STARTS =======================================*/
define('MI_SESSION', mi_env('APP_SESSION'));
/*==================================== MI SESSION ENDS =======================================*/

/*==================================== MI BASE URL =========================================*/
define('MI_BASE_URL', mi_env('APP_URL'));
/*==================================== MI BASE URL END =========================================*/

/*==================================== MI CDN URL =========================================*/
define('MI_CDN_URL', mi_env('APP_CDN_URL'));
/*==================================== MI CDN URL END =========================================*/

/*==================================== MI DB CONFIGURATION ======================================*/
define('MI_DB_HOST', mi_env('DB_HOST'));
define('MI_DB_NAME', mi_env('DB_DATABASE'));
define('MI_DB_USER', mi_env('DB_USERNAME'));
define('MI_DB_PASS', mi_env('DB_PASSWORD'));
/*==================================== MI DB CONFIGURATION END ==================================*/

/*==================================== MI SMTP MAIL CONFIGURATION ======================================*/
define('MI_MAIL_HOST', mi_env('MAIL_HOST'));
define('MI_MAIL_USER', mi_env('MAIL_USERNAME'));
define('MI_MAIL_PASS', mi_env('MAIL_PASSWORD'));
define('MI_MAIL_LAYER', mi_env('MAIL_ENCRYPTION'));
define('MI_MAIL_LAYER_CODE', mi_env('MAIL_PORT'));
define('MI_MAIL_FROM_NAME', mi_env('MAIL_FROM_NAME'));
define('MI_MAIL_FROM_EMAIL', mi_env('MAIL_FROM_ADDRESS'));
/*==================================== MI SMTP MAIL CONFIGURATION END ==================================*/
