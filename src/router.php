<?php
class Router
{
    public function Router($url, RouteLoader $routes) {
        // enlever le premier / qui est innutile
        $this->url = preg_replace('/^\//','',$url,1);
        $this->routes = $routes;
    }

    /**
     * return the first matching routes with matching additionnal param if any,
     * return false if no match 
     */
    function route() {
        $routes = $this->routes->getRoutes();
        foreach($routes as $route){
            $options = $route->match($this->url);
            if(is_array($options)){
                if($route->is_known_location()){
                    return $route;
                } else {
                    $router = new Router($route->simplify($this->url),$route->getLocation());
                    return $router->route();
                }
            }
        }
        return false;
    }

}

class Route
{
    private $patern;
    private $location;
    private $options;

    public function Route( $patern, $location, $options = array()) {
        $this->patern = '/'.str_replace('/','\\/',$patern).'/';
        $this->location = $location;
        $this->options = $options;
    }

    /**
     * return false on non matching patern, 
     * return matched param (only associatives ones) if match
     */
    public function match($url) {
        $options = array();

        if(preg_match($this->patern,$url,$options)){
            foreach($options as $key => $value){
                if(is_string($key)){
                    $this->options[$key] = $value;
                }
            }
            return $this->options;
        }
        return false;
    }

    /**
     * is_known_location 
     *
     * a route can lead to others...
     * this nethod retirn false if location is a collection of 
     * sub-routes
     * 
     * @access public
     * @return boolean
     */
    public function is_known_location() {
        return is_string($this->location);
    }

    public function getLocation() {
        return $this->location;
    }

    public function getOptions() {
        return $this->options;
    }

    /**
     * simplify
     *
     * remove what alredy traveled from the url
     * return what's left
     */
    public function simplify($url) {
        $patern = $this->patern;
        return preg_replace($patern,'',$url,1);
    }
}

class RouteLoader
{
    private $path;
    private $var_name;
    private $routes = null;

    public function RouteLoader($path, $var_name = 'urls') {
        $this->path = $path;
        $this->var_name = $var_name;
    }

    public function getRoutes() {
        if($this->routes === null) {
            if(file_exists($this->path)) {
                include($this->path);
            } else {
                throw new RuntimeException('File '.$this->path.' not found!');
            }
            if(isset(${$this->var_name})) {
                $this->routes = ${$this->var_name};
            } else {
                throw new RuntimeException();
            }
        }
        return $this->routes;
    }
}

function router($url, $path, $var_name = 'urls') {
    return new Router($url, new RouteLoader($path, $var_name));
}

function route($patern, $location, $options =array() ) {
    return new Route($patern, $location, $options);
}

function routes($path, $var_name = 'urls') {
    return new RouteLoader($path, $var_name);
}
?>
