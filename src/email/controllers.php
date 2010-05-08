<?php

function email_all()
{
    $session = get_session();
    $me = $session->whoAMI();
    if($me[2] != 'A'){
        return redirect('/');
    }
    $sender_id = $me[0];
    $subject = addslashes($_POST['email_subject']);
    $body = addslashes($_POST['email_body']);
    $dbh = get_dbh();
    $attachement_id = 'NULL';
    $attachement = upload_file('attachement');
    if($attachement){
        $query = "INSERT INTO attachement (fk_user_id, file_path) VALUES ($sender_id, '$attachement')";
        $dbh->execute($query);
        $attachement_id = $dbh->last_insert_id();
    }
    
    $query = "INSERT INTO mail_queue ( sender_id , dest_id , subject , body, fk_attachement_id )
        SELECT  $sender_id, id, '$subject', '$body', $attachement_id
        FROM user 
        WHERE invite_status > 3 
        AND is_blacklisted = 0";
    $dbh->execute($query);
    return redirect('/mypage');
}

function email_bus($id)
{
    i_am_logged();
    i_can_edit_that('Bus',$id);
    $session = get_session();
    $me = $session->whoAMI();
    if($me[2] != 'A'){
        return redirect('/');
    }
    $id = addslashes($id);
    $sender_id = $me[0];
    $subject = addslashes($_POST['email_subject']);
    $body = addslashes($_POST['email_body']);
    $dbh = get_dbh();
    $attachement_id = 'NULL';
    $attachement = upload_file('attachement');
    if($attachement){
        $query = "INSERT INTO attachement (fk_user_id, file_path) VALUES ($sender_id, '$attachement')";
        $dbh->execute($query);
        $attachement_id = $dbh->last_insert_id();
    }
    
    $query = "INSERT INTO mail_queue ( sender_id , dest_id , subject , body, fk_attachement_id )
        SELECT  $sender_id, id, '$subject', '$body', $attachement_id
        FROM user 
        WHERE invite_status > 3 
        AND is_blacklisted = 0
        AND fk_bus_id = $id";
    $dbh->execute($query);
    return redirect('/mypage');
}

function email_group($id)
{
    i_am_logged();
    i_can_edit_that('Group',$id);
    $session = get_session();
    $me = $session->whoAMI();

    $id = addslashes($id);
    $sender_id = $me[0];
    $subject = addslashes($_POST['email_subject']);
    $body = addslashes($_POST['email_body']);
    $dbh = get_dbh();
    $attachement_id = 'NULL';
    $attachement = upload_file('attachement');
    if($attachement){
        $query = "INSERT INTO attachement (fk_user_id, file_path) VALUES ($sender_id, '$attachement')";
        $dbh->execute($query);
        $attachement_id = $dbh->last_insert_id();
    }
    
    $query = "INSERT INTO mail_queue ( sender_id , dest_id , subject , body, fk_attachement_id )
        SELECT  $sender_id, id, '$subject', '$body', $attachement_id
        FROM user 
        WHERE invite_status > 3 
        AND is_blacklisted = 0
        AND fk_group_id = $id";
    $dbh->execute($query);
    return redirect('/mypage');
}

function email_user($id)
{
    i_am_logged();
    i_can_edit_that('User',$id);
    $user = User::fetch($id);
    if(!$user){ throw new NotFoundException(); }
    
    $session = get_session();

    if(is_post())
    {
        $dbh = get_dbh();
        $attachement_id = 'NULL';
        $attachement = upload_file('attachement');
        if($attachement){
            $query = "INSERT INTO attachement (fk_user_id, file_path) VALUES ($sender_id, '$attachement')";
            $dbh->execute($query);
            $attachement_id = $dbh->last_insert_id();
        }
        
        $query = "INSERT INTO mail_queue ( sender_id , dest_id , subject , body, fk_attachement_id )
            VALUES ( $sender_id, id, '$subject', '$body', $attachement_id)";
        $dbh->execute($query);

        return redirect('/mypage');
    }
    if (user.GroupChiefOf)
    {
        $credit = "Chef de groupe";
    } else if( user.BusChiefOf)
    {
        $credit = "Chef de bus";
    } else 
    { $credit = "Invite"; }
    return render('email_user.tpl',array('user'=>$user,'credit'=>$credit));
}
