<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 8/9/2020
 * Time: 7:24 PM
 */

function mi_env($variable = null){
    error_reporting(0);
    $env_url = dirname(__DIR__).'/.env';
    $data = [];
    foreach (file($env_url) as $env){
        if (
            !empty($env) &&
            !empty(explode('=', $env)[0]) &&
            !empty(explode('=', $env)[1])
        ){
            $key = trim(explode('=', $env)[0]);
            $value = trim(explode('=', $env)[1]);
            $data[$key] = $value;
        }
    }

    if ($variable != null){
        return trim($data[$variable]);
    }else{
        return $data;
    }
}