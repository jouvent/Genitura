<?php
$pwd = realpath(dirname(__FILE__).'/../src').'/';

require_once('PHPUnit/Framework.php');
require_once($pwd.'include/request/request.php');
require_once($pwd.'include/response/response.php');
require_once($pwd.'boot.php');
require_once($pwd.'include/generic/init.php');

$pwd = realpath(dirname(__FILE__).'/../src').'/';
Doctrine_Core::loadModels($pwd.'include/models/generated');
Doctrine_Core::loadModels($pwd.'include/models');

class GenericListTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request;
    }

    public function testGenericListFindTemplate()
    {
        $this->request->addParam('object','User');
        $response = generic_list($this->request);
        $this->assertEquals($response->template, 'user_list.html');
    }

    public function testGenericListNameListWithObjectName()
    {
        $this->request->addParam('object','User');
        $response = generic_list($this->request);
        $this->assertTrue(isset($response->datas['users']));
    }
}

class GenericViewTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request;
    }

    public function testGenericViewFindTemplate()
    {
        $this->request->addParam('object','User');
        $this->request->addParam('id',1);
        $response = generic_view($this->request);
        $this->assertEquals($response->template, 'user_view.html');
    }

    public function testGenericViewNameObjectWithObjectName()
    {
        $this->request->addParam('object','User');
        $this->request->addParam('id',1);
        $response = generic_view($this->request);
        $this->assertTrue(isset($response->datas['user']));
    }
}

class GenericAddTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request;
    }

    public function testGenericAddFindTemplateOnGet()
    {
        $this->request->addParam('object','User');
        $this->request->addServerParam('REQUEST_METHOD','get');
        $response = generic_add($this->request);
        $this->assertEquals($response->template, 'user_form.html');
    }

    public function testGenericAddNameObjectWithObjectName()
    {
        $this->request->addParam('object','User');
        $this->request->addServerParam('REQUEST_METHOD','get');
        $response = generic_list($this->request);
        $this->assertTrue(isset($response->datas['users']));
    }
}

class GenericEditTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request;
    }

    public function testGenericEditFindTemplate()
    {
        $this->request->addParam('object','User');
        $this->request->addParam('id',1);
        $this->request->addServerParam('REQUEST_METHOD','get');
        $response = generic_edit($this->request);
        $this->assertEquals($response->template, 'user_form.html');
    }

    public function testGenericEditNameObjectWithObjectName()
    {
        $this->request->addParam('object','User');
        $this->request->addParam('id',1);
        $this->request->addServerParam('REQUEST_METHOD','get');
        $response = generic_edit($this->request);
        $this->assertTrue(isset($response->datas['user']));
    }
}

class GenericDeleteTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request;
    }

    public function testGenericDeleteRedirectToIndex()
    {
        $this->request->addParam('object','User');
        $this->request->addParam('id',1);
        $response = generic_delete($this->request);
        $this->assertEquals($response->location, '/user');
    }
}
