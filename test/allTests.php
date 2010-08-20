<?php
$pwd = realpath(dirname(__FILE__).'/../src').'/';
require_once $pwd.'boot.php';
require_once 'PHPUnit/Framework.php';
require_once 'routerTest.php';
require_once 'routesTest.php';
require_once 'routeTest.php';

class Framework_AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit Framework');

        $suite->addTestSuite('RouteLoaderTest');
        $suite->addTestSuite('RouterTest');
        $suite->addTestSuite('RouteTest');

        return $suite;
    }
}
?>
