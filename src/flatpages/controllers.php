<?php

function index()
{
    return render('home.tpl',array());
}

function about()
{
    return render('about.tpl',array());
}

function images()
{
    return render('images.tpl',array());
}

function news()
{
    return render('news.tpl',array());
}

function rules($lang){
    return render('rules.tpl',array());
}
