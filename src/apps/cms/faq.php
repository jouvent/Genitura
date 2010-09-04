<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * cms/faq.php
 *
 * PHP version 5
 *
 * @category   Controllee
 * @package    CMS_Controller
 * @subpackage CMS_FAQ
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * faq 
 * 
 * @access public
 * @return string
 */
function faq()
{
    $data = array();
    $q = Doctrine_Query::create()
            ->from('Faq u');
    if ($_COOKIE['lang'] == 'fr') {
            $q->select('u.id, u.question_fr as question, u.response_fr as response');
    } else {
            $q->select('u.id, u.question_en as question, u.response_en as response');
    }
    $data['faqs'] = $q->execute();
    return render('faq.tpl', $data);
}

/**
 * faq_add 
 * 
 * @access public
 * @return string
 */
function faq_add()
{
    $data = array();
    $data['faq'] = new Faq();
    if(is_post()){
        $faq->fromArray($_POST);
        $faq->id = null;
        if($faq->isValid()){
            $faq->save();
            return redirect('/faq/list');
        } else {
            $errors = array();
            $data['errors']['faq'] = get_errors($faq);
        }
    }
    return render('faq_form.tpl',$data);
}

/**
 * faq_edit 
 * 
 * @param string $id unique identifier for te FAQ
 *
 * @access public
 * @return string
 */
function faq_edit($id)
{
    $data = array();
    $faq = Faq::fetch($id);
    if(!$faq){
        throw new NotFoundException();
    }
    if (is_post()) {
        $faq->fromArray($_POST);
        if ($faq->isValid()) {
            $faq->save();
            return redirect('/faq/list');
        } else {
            $data['errors'] = array();
            $data['errors']['faq'] = format_error($faq);
        }
    }
    $data['faq'] = $faq;
    return render('faq_form.tpl', $data);
}

/**
 * faq_list 
 * 
 * @access public
 * @return string
 */
function faq_list()
{
    $data = array();
    $q = Doctrine_Query::create()
            ->from('Faq u');
    if ($_COOKIE['lang'] == 'fr') {
            $q->select('u.id, u.question_fr as question');
    } else {
            $q->select('u.id, u.question_en as question');
    }
    $data['faqs'] = $q->execute();
    return render('faq_list.tpl', $data);
}
