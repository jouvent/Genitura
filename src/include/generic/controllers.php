<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * generic/controllers.php
 *
 * PHP version 5
 *
 * @category Init
 * @package  Generic_Init
 * @author   julien jouvent-halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php mit license
 * @link     http://github.com/jouvent/genitura
 * @since    0.0.3
 */

/**
 * generic_list 
 * 
 * @param string $object the object class to list
 *
 * @access public
 * @return string
 */
function generic_list($object)
{
    $object_name = get_object_name($object);
    $object_name_plural = get_plural($object_name);
    $$object_name_plural = Doctrine::getTable($object)->findAll();
    return render("{$object_name}_list.html", compact($object_name_plural));
}

/**
 * generic_view 
 * 
 * @param mixed $object the object class name
 * @param mixed $id     the unique identifier
 *
 * @access public
 * @return string
 */
function generic_view($object, $id)
{
    $object_name = get_object_name($object);
    $$object_name = Doctrine::getTable('Sprint')->find($id);
    return render("{$object_name}_view.html", compact($object_name));
}

/**
 * generic_add 
 * 
 * @param mixed $object the object class name
 *
 * @access public
 * @return string
 */
function generic_add($object)
{
    $object_name = get_object_name($object);
    $$object_name = new $object();
    if (is_post()) {
        $$object_name->fromArray($_POST);
        if ($$object_name->isValid()) {
            $$object_name->save();
            return redirect('/'.$object_name);
        } else {
            $message = nl2br($$object_name->getErrorStackAsString());
        }
    }
    return render("{$object_name}_form.html", compact($object_name, 'message'));
}

/**
 * generic_edit 
 * 
 * @param mixed $object the object class name
 * @param mixed $id     the unique identifier
 *
 * @access public
 * @return string
 */
function generic_edit($object, $id)
{
    $object_name = get_object_name($object);
    $$object_name = Doctrine::getTable($object)->find($id);
    if (is_post()) {
        $$object_name->fromArray($_POST);
        if ($$object_name->isValid()) {
            $$object_name->save();
            return redirect("/$object_name");
        } else {
            $message = nl2br($$object_name->getErrorStackAsString());
        }
    }
    return render("{$object_name}_form.html", compact($object_name, 'message'));
}

/**
 * generic_delete 
 * 
 * @param mixed $object the object class name
 * @param mixed $id     the unique identifier
 *
 * @access public
 * @return string
 */
function generic_delete($object, $id)
{
    $object_name = get_object_name($object);
    $$object_name = Doctrine::getTable($object)->find($id);
    $$object_name->delete();
    return redirect('/'.$object_name);
}

/**
 * get_object_name 
 * 
 * @param mixed $class the object class name
 *
 * @access public
 * @return string
 */
function get_object_name($class)
{
    return strtolower($class);
}

/**
 * get_plural 
 * 
 * @param mixed $name what to be pluralized
 *
 * @access public
 * @return string
 */
function get_plural($name)
{
    return $name.'s';
}
