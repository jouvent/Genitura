<?php
require_once('PHPUnit/Framework.php');
require_once($pwd.'/router.php');

class RouterTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $pwd = dirname(__FILE__);
        $this->routes = new RouteLoader($pwd.'/urls.php');
    }

    public function testLoad() {
        $router = new Router('',$this->routes);
    }

    public function testMatch() {
        $router = new Router('',$this->routes);
        $this->assertNotEquals(false,$router->route());
        $this->assertTrue(is_a($router->route(),'Route'));

    }

    public function testNoMatch() {
        $router = new Router('foo',$this->routes);
        $this->assertEquals(false,$router->route());
    }
}
