<?php
/**
 * Created by PhpStorm.
 * User: Sujon
 * Date: 8/21/2019
 * Time: 12:10 PM
 */

mi_unset('admin');
session_destroy();
mi_redirect(MI_BASE_URL.'admin/login.php');