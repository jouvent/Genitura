<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * router.php
 *
 * contain classes needed to find the controller corresponding to given URI
 *
 * PHP version 5
 *
 * @category   Boot
 * @package    Core
 * @subpackage Core_Boot
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */

/**
 * Walk through the list of route and find the matching one
 *
 * @category   Routing
 * @package    Core
 * @subpackage Core_Route
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */
class Router
{
    /**
     * the requested url
     *
     * @var string 
     */
    private $_url;
    private $_routes;

    /**
     * sanitize en store params
     *
     * @param string      $url    the requested url
     * @param RouteLoader $routes the Loader for the Route list
     */
    public function Router($url, RouteLoader $routes)
    {
        // enlever le premier / qui est innutile
        $this->_url = preg_replace('/^\//', '', $url, 1);
        $this->_routes = $routes;
    }

    /**
     * return the first matching routes with matching additionnal param if any,
     * return false if no match 
     *
     * @return mixed the first matching Route or false if no match
     */
    function route()
    {
        $routes = $this->_routes->getRoutes();
        foreach ($routes as $route) {
            $options = $route->match($this->_url);
            if (is_array($options)) {
                if ($route->isKnownLocation()) {
                    return $route;
                } else {
                    $simplified_url = $route->simplify($this->_url);
                    $location = $route->getLocation();
                    $router = new Router($simplified_url, $location);
                    return $router->route();
                }
            }
        }
        return false;
    }
}


/**
 * tell the function to run on matching url
 *
 * @category   Routing
 * @package    Core
 * @subpackage Core_Route
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */
class Route
{
    private $_patern;
    private $_location;
    private $_options;

    /**
     * Route 
     * 
     * @param string $patern   the patern to match
     * @param mixed  $location the function location
     * @param array  $options  additionnal options to return
     *
     * @access public
     * @return void
     */
    public function Route( $patern, $location, $options = array())
    {
        $this->_patern = '/'.str_replace('/', '\\/', $patern).'/';
        $this->_location = $location;
        $this->_options = $options;
    }

    /**
     * match
     *
     * return false on non matching patern, 
     * return matched param (only associatives ones) if match
     *
     * @param string $url the url to match
     *
     * @access public
     * @return boolean
     */
    public function match($url)
    {
        $options = array();

        if (preg_match($this->_patern, $url, $options)) {
            foreach ($options as $key => $value) {
                if (is_string($key)) {
                    $this->_options[$key] = $value;
                }
            }
            return $this->_options;
        }
        return false;
    }

    /**
     * isKnownLocation 
     *
     * a route can lead to others...
     * this nethod retirn false if location is a collection of 
     * sub-routes
     * 
     * @access public
     * @return boolean
     */
    public function isKnownLocation()
    {
        return is_string($this->_location);
    }

    /**
     * getLocation 
     * 
     * @access public
     * @return string
     */
    public function getLocation()
    {
        return $this->_location;
    }

    /**
     * getOptions 
     * 
     * @access public
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * simplify
     *
     * remove what alredy traveled from the url
     *
     * @param string $url the initial url
     *
     * @return string what's left
     */
    public function simplify($url)
    {
        $patern = $this->_patern;
        return preg_replace($patern, '', $url, 1);
    }
}

/**
 * store a file paht and include it on demand
 *
 * @category   Routing
 * @package    Core
 * @subpackage Core_Route
 * @author     Julien Jouvent-Halle <julienhalle@heptacube.com>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @link       http://github.com/jouvent/Genitura
 * @since      0.0.2
 */
class RouteLoader
{
    private $_path;
    private $_var_name;
    private $_routes = null;

    /**
     * RouteLoader 
     * 
     * @param string $path     the file path to include
     * @param string $var_name the variable name to return
     *
     * @access public
     * @return void
     */
    public function RouteLoader($path, $var_name = 'urls')
    {
        $this->_path = $path;
        $this->_var_name = $var_name;
    }

    /**
     * getRoutes 
     * 
     * @access public
     * @return mixed
     */
    public function getRoutes()
    {
        if ($this->_routes === null) {
            if (file_exists($this->_path)) {
                include $this->_path;
            } else {
                throw new RuntimeException('File '.$this->_path.' not found!');
            }
            if (isset(${$this->_var_name})) {
                $this->_routes = ${$this->_var_name};
            } else {
                throw new RuntimeException();
            }
        }
        return $this->_routes;
    }
}

/**
 * router 
 * 
 * convinient wrapper to create router
 *
 * @param string $url      the url to match against
 * @param string $path     the urls file path
 * @param string $var_name the urls list var name
 *
 * @access public
 * @return Router
 */
function router($url, $path, $var_name = 'urls')
{
    return new Router($url, new RouteLoader($path, $var_name));
}

/**
 * route 
 * 
 * convinient wrapper to create route
 *
 * @param string $patern   the patern to match
 * @param string $location the function location
 * @param array  $options  additional options to return
 *
 * @access public
 * @return Route
 */
function route($patern, $location, $options =array() )
{
    return new Route($patern, $location, $options);
}

/**
 * routes 
 * 
 * convinient wrapper to create route loader
 *
 * @param string $path     the file to load 
 * @param string $var_name the var to extract
 *
 * @access public
 * @return RouteLoader
 */
function routes($path, $var_name = 'urls')
{
    return new RouteLoader($path, $var_name);
}
?>
