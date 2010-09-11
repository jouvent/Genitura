<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * helpers/upload.php
 *
 * PHP version 5
 *
 * @category   Helpers
 * @package    Core
 * @subpackage Core_Helpers
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * upload_file 
 * 
 * @param string $name             the name of the uploaded file
 * @param array  $valid_extentions the accepables extentions to check
 *
 * @access public
 * @return boolean
 */
function upload_file($name, $valid_extentions = array())
{
    $uploadFolderName = UPLOAD;

    // get the target path where we want to copy the original file
    $target_path = $uploadFolderName . basename($_FILES[$name]['name']);

    // get the uploaded file name and extension
    $fileInfo = pathinfo($target_path);
    $fileExtension = $fileInfo['extension'];

    // check for valid file extensions
    if ( in_array($fileExtension, $valid_extentions) || empty($valid_extentions) ) {

        // copy the uploaded file from the temp folder to its final destination
        if ( move_uploaded_file($_FILES[$name]['tmp_name'], $target_path) ) {
            return $target_path;
        }
    }
    return false;
}
