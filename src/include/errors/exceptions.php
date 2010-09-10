<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * errors/exceptions.php
 *
 * PHP version 5
 *
 * @category   Errors
 * @package    Core
 * @subpackage Core_Errors
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * NotFoundException 
 *
 * walk through the list of route and find the matching one
 *
 * @category   Errors
 * @package    Code
 * @subpackage Core_Errors
 * @author     julien jouvent-halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php mit license
 * @link       http://github.com/jouvent/genitura
 * @since      0.0.2
 */
class NotFoundException extends Exception
{
} 

/**
 * LoginRequiredException 
 *
 * walk through the list of route and find the matching one
 *
 * @category   Errors
 * @package    Code
 * @subpackage Core_Errors
 * @author     julien jouvent-halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php mit license
 * @link       http://github.com/jouvent/genitura
 * @since      0.0.2
 */
class LoginRequiredException extends Exception
{
} 

/**
 * AccessDeniedException 
 *
 * walk through the list of route and find the matching one
 *
 * @category   Errors
 * @package    Code
 * @subpackage Core_Errors
 * @author     julien jouvent-halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php mit license
 * @link       http://github.com/jouvent/genitura
 * @since      0.0.2
 */
class AccessDeniedException extends Exception
{
} 
