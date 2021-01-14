<?php
/**
 * Author: Monirul Islam
 * Author Url: http://www.misujon.com/
 */

/*======================================= MI IMAGE MERGE FUNCTION ===========================================*/
require_once 'libs/mi_image_merge/vendor/autoload.php';
use Treinetic\ImageArtist\lib\Image;
use Treinetic\ImageArtist\lib\Text\TextBox;
use Treinetic\ImageArtist\lib\Text\Color;
use Treinetic\ImageArtist\lib\Text\Font;

function mi_image_marge($images_path = array(), $output_image_path, $output_image_name, $output_image_extension, $output_url='', $output_text = array()){

    if (!is_array($images_path)){
        die("Invalid data type");
    }elseif (!isset($output_image_name) || empty($output_image_name)){
        die("Invalid image output name");
    }elseif (!isset($output_image_extension) || empty($output_image_extension)){
        die("Invalid image output extension");
    }elseif (count($images_path) < 1){
        die("There must be two images for merging.");
    }else{

        $new = new Image($images_path[0], 0,0);
        foreach ($images_path as $key => $img){
            if (!empty($img) && $key > 0 && file_exists($img)){
                $new->merge(new Image($img), 0,0);
            }
        }

        if (count($output_text)>0 && isset($output_text['position']) && !empty($output_text['position'])){
            $newcolor = new Color(intval($output_text['color'][0]), intval($output_text['color'][1]), intval($output_text['color'][2]));

            $textBox = new TextBox(100,20);
            $textBox->setColor($newcolor);
            if ($output_text['font'] == 'DANCING'){
                $textBox->setFont(Font::getFont(Font::$DANCING));
            }elseif ($output_text['font'] == 'FREDOKA'){
                $textBox->setFont(Font::getFont(Font::$FREDOKA));
            }else{
                $textBox->setFont(Font::getFont(Font::$ROMANESCO));
            }
            $textBox->setSize(12);
            $textBox->setMargin(1);
            $textBox->setText($output_text['text']);

            if ($output_text['position'] == 1){
                $txtY = 375;
                $txtX = 550;
            }elseif ($output_text['position'] == 2){
                $txtY = 675;
                $txtX = 520;
            }elseif ($output_text['position'] == 3){
                $txtY = 965;
                $txtX = 725;
                $textBox->setAngle(100);
            }elseif ($output_text['position'] == 4){
                $txtY = 975;
                $txtX = 440;
                $textBox->setAngle(90);
            }else{
                $txtY = 675;
                $txtX = 520;
            }
            $new->setTextBox($textBox, $txtX, $txtY);
        }

        if (empty($output_image_path)){
            $path = './';
        }else{
            $path = $output_image_path;
        }

        if ($output_image_extension == 'jpeg'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_JPEG);
        }elseif ($output_image_extension == 'png'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_PNG);
        }elseif ($output_image_extension == 'gif'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_GIF);
        }elseif ($output_image_extension == 'bmp'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_BMP);
        }elseif ($output_image_extension == 'ico'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_ICO);
        }elseif ($output_image_extension == 'iff'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_IFF);
        }elseif ($output_image_extension == 'jb2'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_JB2);
        }elseif ($output_image_extension == 'jp2'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_JP2);
        }elseif ($output_image_extension == 'jpc'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_JPC);
        }elseif ($output_image_extension == 'jpeg2000'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_JPEG2000);
        }elseif ($output_image_extension == 'jpx'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_JPX);
        }elseif ($output_image_extension == 'psd'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_PSD);
        }elseif ($output_image_extension == 'swc'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_SWC);
        }elseif ($output_image_extension == 'swf'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_SWF);
        }elseif ($output_image_extension == 'tiff_ii'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_TIFF_II);
        }elseif ($output_image_extension == 'tiff_mm'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_TIFF_MM);
        }elseif ($output_image_extension == 'wbmp'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_WBMP);
        }elseif ($output_image_extension == 'webp'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_WEBP);
        }elseif ($output_image_extension == 'xbm'){
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_XBM);
        }else{
            $new->save($path.$output_image_name.".".$output_image_extension, IMAGETYPE_PNG);
        }

        $outUrl = ((!empty($output_url))?$output_url:MI_BASE_URL);

        $path_replace = $outUrl.str_replace(dirname(__DIR__).DIRECTORY_SEPARATOR.'view/', '', $path);
        return $path_replace.$output_image_name.".".$output_image_extension;
    }
}

/*======================================= MI IMAGE MERGE FUNCTION END =======================================*/