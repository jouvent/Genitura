<?php
require_once('PHPUnit/Framework.php');
require_once('router.php');

class RouteLoaderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->pwd = dirname(__FILE__);
    }

    public function testLoad() {
        $routes = new RouteLoader($this->pwd.'/urls.php');
    }

    public function testIsArray() {
        $routes = new RouteLoader($this->pwd.'/urls.php');
        $this->assertTrue(is_array($routes->getRoutes()));
    }
    /**
     * @expectedException RuntimeException
     */
    public function testFileNotFound() {
        $routes = new RouteLoader('notHere.php');
        $routes->getRoutes();
    }
    /**
     * @expectedException RuntimeException
     */
    public function testArrayNotFound() {
        $routes = new RouteLoader($this->pwd.'/urls.php','foo');
        $routes->getRoutes();
    }

    public function testWrapper(){
        $this->assertTrue(is_a(routes($this->pwd.'/urls.php'),'RouteLoader'));
    }
}
