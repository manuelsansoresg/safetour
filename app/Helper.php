<?php
use Verot\Upload\Upload;

function uploadImage($file, $image_cover,  $path, $is_move = false, $pre = '', $is_corp = false, $width = 150, $height = 150)
{
    $handle           = new Upload($file);
    $nombre_imagen    = $pre . time() . '_' . rand(1, 999);

    $extension        = $image_cover->getClientOriginalExtension();
    $name_full        = $pre . time() . '.' . $extension;
    $name_thumb       = $pre . time();
    $name_full_return = $pre . time() . '.' . $extension;

    if ($handle->uploaded) {


        $handle->file_new_name_body = $name_thumb;
        $handle->file_name_body_pre = 'thumb_';
        $handle->file_safe_name     = true;
        $handle->image_resize       = true;

        if ($is_corp == false) {
            $handle->image_ratio_crop   = true;
        }

        $handle->image_x            = $width;
        $handle->image_y            = $height;
        $handle->process($path . '/');
    }

    if ($is_move == true) {
        $image_cover->move($path, $name_full);
    }

    return  $name_full_return;
}

function price($precio)
{
    return number_format($precio, 2, '.', ',');
}

function getPayedOnline(){
    $payed = \App\TypePay::where('name', 'payed on line')->first();
    return $payed->price;
}
