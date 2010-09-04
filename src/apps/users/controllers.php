<?php

function view_user($id)
{
    $user = User::fetch($id);
    if(!$user) throw new NotFoundException();
    return render('user_view.tpl', compact('user'));
}

function my_page()
{
    $session = get_session();
    if(!$session->logged)
    {
        return redirect('/');
    }
    $me = $session->whoAMI();
    return view_user($me[0]);
}

function edit_user($id)
{
    i_am_logged();
    $user = fetch_or_404('User',$id);

    if(is_post()){
        $user->fromArray($_POST);
        if($user->isValid()){
            $user->save();
            return redirect('/user/page/'.$user->id);
        } else {
            $errors = array();
            $errors['user'] = get_errors($user);
        }
    }

    return render('user_edit.tpl',compact('user','errors'));
}
