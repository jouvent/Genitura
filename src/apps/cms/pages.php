<?php

function page($slug)
{
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
    return render('page_view.tpl',compact('page'));
}

function page_add()
{
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
    return render('page_form.tpl',compact('page','errors'));
}

function page_edit($slug)
{
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
            $errors = array();
            $errors['page'] = format_error($page);
        }
    }
    return render('page_form.tpl',compact('page','errors'));
}

function page_list()
{
    $q = Doctrine_Query::create()
            ->from('Pages u');
    if($_COOKIE['lang'] == 'fr'){
            $q->select('u.slug, u.title_fr as title');
    } else {
            $q->select('u.slug, u.title_en as title');
    }
    $pages = $q->execute();
    return render('page_list.tpl',compact('pages'));
}
