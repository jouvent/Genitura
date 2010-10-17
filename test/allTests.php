<?php
$pwd = realpath(dirname(__FILE__).'/../src').'/';
require_once $pwd.'boot.php';
require_once 'PHPUnit/Framework.php';
require_once 'routerTest.php';
require_once 'routesTest.php';
require_once 'routeTest.php';
require_once 'requestTest.php';
require_once 'genericTest.php';

class Framework_AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit Framework');

        $suite->addTestSuite('RouteLoaderTest');
        $suite->addTestSuite('RouterTest');
        $suite->addTestSuite('RouteTest');
        $suite->addTestSuite('RequestTest');
        $suite->addTestSuite('GenericListTest');
        $suite->addTestSuite('GenericViewTest');
        $suite->addTestSuite('GenericAddTest');
        $suite->addTestSuite('GenericEditTest');
        $suite->addTestSuite('GenericDeleteTest');

        return $suite;
    }
}
?>
