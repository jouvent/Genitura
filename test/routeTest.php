<?php
$pwd = realpath(dirname(__FILE__).'/../src').'/';

require_once('PHPUnit/Framework.php');
require_once($pwd.'router.php');

class RouteTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testLoad() {
        $route = new Route('^$','flatpage::home');
    }

    public function testMatch() {

        $route = new Route('^$','flatpage::home');
        $this->assertTrue(is_array($route->match('')));

        $route = new Route('^home$','flatpage::home');
        $this->assertTrue(is_array($route->match('home')));

        $route = new Route('^home/info$','flatpage::home');
        $this->assertTrue(is_array($route->match('home/info')));
    }

    public function testNoMatch() {

        $route = new Route('^$','flatpage::home');
        $this->assertFalse(is_array($route->match('foo')));

        $route = new Route('^home$','flatpage::home');
        $this->assertFalse(is_array($route->match('home/')));

        $route = new Route('^home$','flatpage::home');
        $this->assertFalse(is_array($route->match('/home')));

        $route = new Route('^/home/info$','flatpage::home');
        $this->assertFalse(is_array($route->match('home/patate')));
    }

    public function testParamCapture() {

        $route = new Route('^$','flatpage::home');
        $params = $route->match('');
        $this->assertTrue(empty($params));

        $route = new Route('^edit/(?<id>\d+)$','flatpage::home');
        $params = $route->match('edit/42');
        $this->assertEquals($params['id'],42);

        $route = new Route('^home/info$','flatpage::home',array('id'=>42));
        $params = $route->match('home/info');
        $this->assertEquals($params['id'],42);
    }

    public function testParamOverwrite() {

        $route = new Route('^edit/(?<id>\d+)$','flatpage::home',array('id'=>34));
        $params = $route->match('edit/42');
        $this->assertEquals($params['id'],42);
    }

    public function testWrapper(){
        $this->assertTrue(is_a(route('',''),'Route'));
    }

}
