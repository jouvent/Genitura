<?php

function is_post(){
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function redirect($location){
    if($location)
    {
        return header("Location: $location");
    }
    else
    {
        return header("Location: /");
    }
}
