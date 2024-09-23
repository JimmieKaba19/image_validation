<?php

function image_validation($image_name, $image_size, $image_temp, $image_type){
    if(empty($image_name)){
        return "Please select a file";
    }

    $file_info = new finfo(FILEINFO_MIME_TYPE);

    $mine_type = $file_info->file($image_temp);

    $allowed_image_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    if(in_array($mine_type, $allowed_image_types) == false){
        return "Only Jpeg, jpg, png, gif images allowed";
    }

    $upload_max_size = 2 * 1024 * 1024; //2MB

    if($image_size > $upload_max_size){
        return "Image must not be larger than 2 MB";
    }

    $new_name = rename_image($image_name);
    $move_file = move_uploaded_file($image_temp, "uploads/".$new_name);
    if(!$move_file){
        return "File not saved, please try again";
    }

    return "success";

}

function rename_image($image_name){
    $str = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    $length = 10;
    $shuffled_str = str_shuffle($str);
    $random_string = substr($shuffled_str, 0, $length);
    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $new_name = $random_string . "." . $extension;

    if(file_exists("uploads/".$new_name)){
        return rename_image();
    } else {
        return $new_name;
    }
}