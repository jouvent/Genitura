<?php

function credit($user_type)
{
    return title($user_type);
}

function slug_title($user_type){
    switch($user_type)
    {
    case 'A':
        return "organisateur";
    case 'G':
        return "groupe";
    case 'B':
        return "bus";
    }
    return "invite";
}
function title($user_type){
    $lang = $_COOKIE['deb_lang'];
    if($lang == 'fr'){
    switch($user_type)
    {
    case 'A':
        return "Organisateur";
    case 'G':
        return "Chef de groupe";
    case 'B':
        return "Chef de bus";
    }
    return "Invit&eacute;";
    } else {
    switch($user_type)
    {
    case 'A':
        return "Organisateur";
    case 'G':
        return "Group Chief";
    case 'B':
        return "Bus Chief";
    }
    return "Invit&eacute;";
    }
}

function create_invite_key($user_id)
{
    $id = addslashes($id);
    $invite_key = strtoupper(dechex(time()+($id*10000)));
    return $invite_key;
}
