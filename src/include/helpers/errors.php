<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * hepres/errors.php
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
 * format_error 
 * 
 * @param mixed $errors a Doctrine error stack as an array
 *
 * @access public
 * @return void
 */
function format_error($errors)
{
    $formated_errors = array();
    foreach ($errors as $field => $field_errors) {
        $fliped = array_fill_keys($field_errors, 1);
        $formated_errors[$field] = $fliped;
    }
    return $formated_errors;
}

/**
 * get_errors 
 * 
 * @param mixed $record a Doctrine model 
 *
 * @access public
 * @return void
 */
function get_errors($record)
{
    $record->isValid();
    return format_error($record->getErrorStack()->toArray()); 
}
