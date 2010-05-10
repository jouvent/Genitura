<?php

function upload_file($name, $valid_extentions = array()){
    $uploadFolderName = UPLOAD;

    // get the target path where we want to copy the original file
    $target_path = $uploadFolderName . basename( $_FILES[$name]['name']);

    // get the uploaded file name and extension
    $fileInfo = pathinfo($target_path);
    $fileExtension = $fileInfo['extension'];

    // check for valid file extensions
    if( in_array($fileExtension, $valid_extentions) || empty($valid_extentions) ) {

        // copy the uploaded file from the temp folder to its final destination
        if( move_uploaded_file($_FILES[$name]['tmp_name'], $target_path) ) {
            return $target_path;
        }
    echo "return false";
    }
    return false;
}
