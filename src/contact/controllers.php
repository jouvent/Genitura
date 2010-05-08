<?php
/*
 * Created on Apr 10, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 function contact(){
     i_am_logged();

 	$dbh = get_dbh();
 	$session = get_session();

 	$id = $session->user_id;

 	$stmt = $dbh->execute("SELECT name, login_email FROM user WHERE id = (SELECT bus_chief_id FROM bus WHERE id = (SELECT fk_bus_id FROM user WHERE id = '".$id."'))");
 	list($bus_name, $bus_email) = $stmt->fetch_array();

 	$stmt2 = $dbh->execute("SELECT name, login_email FROM user WHERE id = (SELECT group_chief_id FROM groupe WHERE id = (SELECT fk_group_id FROM user WHERE id = '".$id."'))");
 	list($group_name, $group_email) = $stmt2->fetch_array();

 	return render('contact.tpl', compact('bus_name','bus_email','group_name','group_email'));

 }
?>
