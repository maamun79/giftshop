<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 8/14/2020
 * Time: 8:45 PM
 */

function mi_rmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                    rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                else
                    unlink($dir. DIRECTORY_SEPARATOR .$object);
            }
        }
        rmdir($dir);
    }
}

function mi_permission_setup($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object)){
                    chmod($dir. DIRECTORY_SEPARATOR .$object, 0777);
                    mi_permission_setup($dir. DIRECTORY_SEPARATOR .$object);
                }else{
                    chmod($dir. DIRECTORY_SEPARATOR .$object, 0777);
                }
            }
        }
    }
}