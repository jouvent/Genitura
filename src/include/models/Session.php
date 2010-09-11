<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * models/Session.php
 *
 * php version 5
 *
 * @category Model
 * @package  Auth_Model
 * @author   julien jouvent-halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php mit license
 * @link     http://github.com/jouvent/genitura
 * @since    0.0.2
 */

/**
 * Session
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @category Model
 * @package  Auth_Model
 * @author   julien jouvent-halle <julienhalle@heptacube.com>
 * @license  http://www.opensource.org/licenses/mit-license.php mit license
 * @link     http://github.com/jouvent/genitura
 * @since    0.0.2
 */
class Session extends BaseSession
{
    /**
     * getSession 
     * 
     * @param mixed $key        the unique secret key
     * @param mixed $ip         the client ip
     * @param mixed $expiration the expiration date
     *
     * @static
     * @access public
     * @return Session
     */
    static function getSession($key, $ip, $expiration)
    {
        $q = Doctrine_Query::create()
            ->from('Session s')
            ->leftJoin('s.User u')
            ->where('s.session_key = ?', $key)
            ->andWhere('s.ip = ?', $ip)
            ->andWhere('s.expiration >= ?', $expiration);
        return $q->fetchOne();
    }

}
