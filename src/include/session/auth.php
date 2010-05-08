<?php

function login($l, $p, $dbh) {
    $dbh = SQL_Class::getDB();
    $sql = $dbh->execute("SELECT id
        FROM admin
        WHERE username = '".addslashes($l)."' AND password = '".md5($p)."'");
    if ($sql->num_row() == 1) {
        list($id, $level) = $sql->fetch_array();
        
        session_start();
        $_SESSION['admin_id'] = $id;
        $_SESSION['admin_level'] = $level;

        return true;
    } else {
        return false;
    }
}

function is_loged() {
    if(!isset($_SESSION['admin_id'])){
        return false;
    }
    return true;
}
