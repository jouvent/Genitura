<?php
require_once('PHPUnit/Framework.php');
require_once('router.php');

class RouteLoaderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testLoad() {
        $routes = new RouteLoader('urls.php');
    }

    public function testIsArray() {
        $routes = new RouteLoader('urls.php');
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
        $routes = new RouteLoader('urls.php','foo');
        $routes->getRoutes();
    }

    public function testWrapper(){
        $this->assertTrue(is_a(routes('urls.php'),'RouteLoader'));
    }
}
