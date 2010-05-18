<?php

function en(){
    return set_Lang('en');
}

function fr(){
    return set_Lang('fr');
}

function set_lang($lang)
{
	setcookie('lang', $lang , time()+60*60*24*30, '/');

	return redirect($_SERVER['HTTP_REFERER']);
}
