<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * cms/page.php
 *
 * PHP version 5
 *
 * @category   Controllee
 * @package    CMS_Controller
 * @subpackage CMS_Page
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * page 
 * 
 * @access public
 * @return string
 */
function page($slug)
{
    $data = array();
    $page = Pages::fetchBySlug($slug);
    if(!$page){
        throw new NotFoundException();
    }
    if($_COOKIE['lang'] == 'fr'){
        $page->mapValue('content',$page->content_fr);
        $page->mapValue('title',$page->title_fr);
    } else {
        $page->mapValue('content',$page->content_en);
        $page->mapValue('title',$page->title_en);
    }
    $data['page'] = $page;
    return render('page_view.tpl',$data);
}

/**
 * page_add 
 * 
 * @access public
 * @return string
 */
function page_add()
{
    $data = array();
    $page = new Pages();
    if(is_post()){
        $page->fromArray($_POST);
        if($page->isValid()){
            $page->save();
            return redirect('/page/list');
        } else {
            $errors = array();
            $errors['page'] = get_errors($page);
            print_r($errors['page']);
        }
    }
    $data['page'] = $page;
    return render('page_form.tpl',$data);
}

/**
 * page_edit 
 * 
 * @param mixed $slug 
 * @access public
 * @return string
 */
function page_edit($slug)
{
    $data = array();
    $page = Pages::fetchBySlug($slug);
    if(!$page){
        throw new NotFoundException();
    }
    if(is_post()){
        $page->fromArray($_POST);
        if($page->isValid()){
            $page->save();
            return redirect('/page/list');
        } else {
            $data['errors'] = array();
            $data['errors']['page'] = format_error($page);
        }
    }
    $data['page'] = $page;
    return render('page_form.tpl',$data);
}

/**
 * page_list 
 * 
 * @access public
 * @return string
 */
function page_list()
{
    $data = array();
    $q = Doctrine_Query::create()
            ->from('Pages u');
    if($_COOKIE['lang'] == 'fr'){
            $q->select('u.slug, u.title_fr as title');
    } else {
            $q->select('u.slug, u.title_en as title');
    }
    $data['pages'] = $q->execute();
    return render('page_list.tpl',$data);
}
