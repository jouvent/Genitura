<?php
$pwd = realpath(dirname(__FILE__).'/../src').'/';

require_once('PHPUnit/Framework.php');
require_once($pwd.'router.php');

class RequestTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request;
    }

    public function testParams()
    {
        $this->request->addParams(array('key'=>'value'));
        $this->assertEquals($this->request->getParam('key'),'value');
    }

    public function testRequestMethod()
    {
        $this->request->addServerParam('REQUEST_METHOD','POST');
        $this->assertTrue($this->request->is_post());
        $this->assertFalse($this->request->is_get());
        $this->assertFalse($this->request->is_put());
        $this->assertFalse($this->request->is_delete());
    }

}
