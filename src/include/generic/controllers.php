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
function generic_list($request)
{
    $object = $request->getParam('object');
    $object_name = get_object_name($object);
    $object_name_plural = get_plural($object_name);
    $objects = Doctrine::getTable($object)->findAll();
    $data = array();
    $data[$object_name_plural] = $objects;
    return render("{$object_name}_list.html", $data);
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
function generic_view($request)
{
    $object = $request->getParam('object');
    $id = $request->getParam('id');
    $object_name = get_object_name($object);
    $object = Doctrine::getTable($object)->find($id);
    $data = array();
    $data[$object_name] = $object;
    return render("{$object_name}_view.html", $data);
}

/**
 * generic_add 
 * 
 * @param mixed $object the object class name
 *
 * @access public
 * @return string
 */
function generic_add($request)
{
    $object = $request->getParam('object');
    $object_name = get_object_name($object);
    $object = new $object();
    $message = '';
    if ($request->is_post()) {
        $object->fromArray($_POST);
        if ($object->isValid()) {
            $object->save();
            return redirect('/'.$object_name);
        } else {
            $message = nl2br($object->getErrorStackAsString());
        }
    }
    $data = array();
    $data['message'] = $message;
    $data[$object_name] = $object;

    return render("{$object_name}_form.html", $data);
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
function generic_edit($request)
{
    $object = $request->getParam('object');
    $id = $request->getParam('id');
    $object_name = get_object_name($object);
    $object = Doctrine::getTable($object)->find($id);
    $message = '';
    if ($request->is_post()) {
        $object->fromArray($_POST);
        if ($object->isValid()) {
            $object->save();
            return redirect("/$object_name");
        } else {
            $message = nl2br($object->getErrorStackAsString());
        }
    }
    $data = array();
    $data['message'] = $message;
    $data[$object_name] = $object;

    return render("{$object_name}_form.html", $data);
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
function generic_delete($request)
{
    $object = $request->getParam('object');
    $id = $request->getParam('id');
    $object_name = get_object_name($object);
    $object = Doctrine::getTable($object)->find($id);
    if($object) {
        $object->delete();
    }
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
