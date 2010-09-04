<?php

/*
 * Yes, i know, singleton is evil....
 * but i dont'have time to comeup with a better idea
 */

function get_session(){
    static $session;
    if(!$session){
        $session = new session_class();
    }
    return $session;
}

function get_dbh(){
    static $dbh;
    if(!$dbh){
        $dbh = new SQL_Class;
    }
    return $dbh;
}

function get_logged_user()
{
    static $user;
    if(!$user){
        $session = get_session();
        $user = $session->get_logged_user();
    }
    return $user;
}
