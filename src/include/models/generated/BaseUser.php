<?php

/**
 * BaseUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property integer $is_admin
 * @property integer $is_deleted
 * @property Doctrine_Collection $Session
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseUser extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('email', 'string', 256, array(
             'type' => 'string',
             'notnull' => true,
             'email' => true,
             'length' => '256',
             ));
        $this->hasColumn('username', 'string', 256, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '256',
             ));
        $this->hasColumn('password', 'string', 256, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '256',
             ));
        $this->hasColumn('is_admin', 'integer', 1, array(
             'type' => 'integer',
             'default' => 0,
             'notnull' => true,
             'length' => '1',
             ));
        $this->hasColumn('is_deleted', 'integer', 1, array(
             'type' => 'integer',
             'default' => 0,
             'notnull' => true,
             'length' => '1',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Session', array(
             'local' => 'id',
             'foreign' => 'user_id'));
    }
}