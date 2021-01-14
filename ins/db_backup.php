<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 8/8/2020
 * Time: 1:08 PM
 */


function mi_db_export($name, $extension, $path, $full=false){
    $tables = array();
    $result = mysqli_query(mi_db(),"SHOW TABLES");
    while($row = mysqli_fetch_row($result)){
        $tables[] = $row[0];
    }
    $return = '';
    foreach($tables as $table){
        $result = mysqli_query(mi_db(),"SELECT * FROM ".$table);
        $num_fields = mysqli_num_fields($result);

        if ($full == true){
            $return .= 'DROP TABLE IF EXISTS '.$table.';<MI_BREAK>';
            $row2 = mysqli_fetch_row(mysqli_query(mi_db(),"SHOW CREATE TABLE ".$table));
            $return .= $row2[1].";<MI_BREAK>";
        }

        for($i=0;$i<$num_fields;$i++){
            while($row = mysqli_fetch_row($result)){
                $return .= "INSERT INTO ".$table." VALUES(";
                for($j=0;$j<$num_fields;$j++){
                    $row[$j] = addslashes($row[$j]);
                    if(isset($row[$j])){ $return .= '"'.$row[$j].'"';}
                    else{ $return .= '""';}
                    if($j<$num_fields-1){ $return .= ',';}
                }
                $return .= ");<MI_BREAK>";
            }
        }
    }

    $file_name = $path.date('Y-m-d-H-i-s').$name.'.'.$extension;
    $handle = fopen($file_name,"w+");
    if (fwrite($handle,$return)){
        fclose($handle);
        $exported = MI_BASE_URL.str_replace(dirname(__DIR__).'\view\\', '', $file_name);
        return $exported;
    }else{
        return false;
    }
}


function mi_db_import($file){
    $mFilename = $file;
    $filename = realpath($mFilename['tmp_name']);
    $handle = fopen($filename,"r+");
    $contents = fread($handle, filesize($filename));
    $sql = explode('<MI_BREAK>', $contents);
    $message = [];
    unset($sql[count($sql)-1]);

    foreach($sql as $query){
        $result = mysqli_query(mi_db(), $query);
        if ($result){
            $message[] = 1;
        }else{
            $message[] = 0;
        }
    }
    fclose($handle);

    return $message;
}