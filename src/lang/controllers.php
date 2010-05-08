<?php

function en(){
    return switch_Lang('en');
}

function fr(){
    return switch_Lang('fr');
}

function switch_lang($lang)
{
	setcookie('deb_lang', $lang , time()+60*60*24*30, '/');

	return redirect($_SERVER['HTTP_REFERER']);
}
