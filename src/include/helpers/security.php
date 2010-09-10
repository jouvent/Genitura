<?php

function fetch_or_404($class, $id)
{
    $obj = call_user_func(array($class ,'fetch'),$id);
    if(!$obj){ throw new NotFoundException(); }
    return $obj;
}

function i_am_logged()
{
    $session = get_session();
    if(!$session->islogged()){ throw new LoginRequiredException(); }
    return true;
}
