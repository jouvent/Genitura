<?php

function faq()
{
    $q = Doctrine_Query::create()
            ->from('Faq u');
    if($_COOKIE['lang'] == 'fr'){
            $q->select('u.id, u.question_fr as question, u.response_fr as response');
    } else {
            $q->select('u.id, u.question_en as question, u.response_en as response');
    }
    $faqs = $q->execute();
    return render('faq.tpl',compact('faqs'));
}

function faq_add()
{
    $faq = new Faq();
    if(is_post()){
        $faq->fromArray($_POST);
        $faq->id = null;
        if($faq->isValid()){
            $faq->save();
            return redirect('/faq/list');
        } else {
            $errors = array();
            $errors['faq'] = get_errors($faq);
        }
    }
    return render('faq_form.tpl',compact('faq','errors'));
}

function faq_edit($id)
{
    $faq = Faq::fetch($id);
    if(!$faq){
        throw new NotFoundException();
    }
    if(is_post()){
        $faq->fromArray($_POST);
        if($faq->isValid()){
            $faq->save();
            return redirect('/faq/list');
        } else {
            $errors = array();
            $errors['faq'] = format_error($faq);
        }
    }
    return render('faq_form.tpl',compact('faq','errors'));
}

function faq_list()
{
    $q = Doctrine_Query::create()
            ->from('Faq u');
    if($_COOKIE['lang'] == 'fr'){
            $q->select('u.id, u.question_fr as question');
    } else {
            $q->select('u.id, u.question_en as question');
    }
    $faqs = $q->execute();
    return render('faq_list.tpl',compact('faqs'));
}
