<?php
/*
 * Copyright (c) 2010 Daniel LeBlanc, Julien Jouvent-Hallé
 * 
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */


require_once('PHPUnit/Framework.php');
require_once('includes/lib/common/dispatcher.php');

class DispatcherTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    /**
     * test that invalid uri don't
     * find a match
     * @dataProvider data_bad_match
     * @test
     */
    public function bad_match($url,$patern)
    {
        $paterns = array($patern);
        $disp = new Dispatcher($url, $paterns);
        $this->assertFalse($disp->hasMatch());
    }

    public function data_bad_match()
    {
        return array(
            array('url',array('uri'=>'pattern')),
            array('',array('uri'=>'pattern'))
        );
    }

    /**
     * @dataProvider data_good_match
     */
    public function test_good_match($url,$patern,$result)
    {
        $paterns = array($patern);
        $disp = new Dispatcher($url, $paterns);
        $this->assertTrue($disp->hasMatch());
    }

    public function data_good_match()
    {
        return array(
            array('',array('uri'=>'')),
            array('non vide',array('uri'=>'non vide')),
            array('bar',array('uri'=>'(?<foo>\w+)'),array('foo'=>'bar')),
        );
    }

    /**
     * @dataProvider data_bad_routes 
     */
    public function test_bad_routes($url,$routes)
    {
        $disp = new Dispatcher(null,$routes);
        $this->assertNotEquals($disp->getRoute(),$routes);
    }

    public function data_bad_routes()
    {
        return array(
            array('/',array(array('uri'=>'pattern','location::method',array()))),
        );
    }

    /**
     * @dataProvider data_good_route 
     */
    public function test_good_route($url,$routes)
    {
        $disp = new Dispatcher(null,$routes);
        $this->assertEquals($disp->getRoute(),$routes[0]);
    }

    public function data_good_route()
    {
        return array(
            array('/',array(
                    array('uri'=>'^$','',array()),
                )),
        );
    }
}

?>
