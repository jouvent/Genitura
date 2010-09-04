<?php

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
