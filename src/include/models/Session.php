<?php

/**
 * Session
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Session extends BaseSession
{
    static function getSession($key, $ip, $expiration) {
        $q = Doctrine_Query::create()
            ->from('Session s')
            ->leftJoin('s.User u')
            ->where('s.session_key = ?',$key)
            ->andWhere('s.ip = ?',$ip)
            ->andWhere('s.expiration >= ?',$expiration);
        return $q->fetchOne();
    }

}
