<?php
class Request
{
    private $_params = array();
    private $_server = array();

    public function addParam($key, $value)
    {
        $this->_params[$key] = $value;
    }

    public function addParams($params)
    {
        $this->_params = array_merge($this->_params, $params);
    }

    public function getParam($key)
    {
        return $this->_params[$key];
    }

    public function is_get()
    {
        return $this->method_is('get');
    }

    public function is_post()
    {
        return $this->method_is('post');
    }

    public function is_put()
    {
        return $this->method_is('put');
    }

    public function is_delete()
    {
        return $this->method_is('delete');
    }

    public function method_is($method)
    {
        return $this->_server['REQUEST_METHOD'] == strtoupper($method);
    }

    public function addServerParam($key, $value)
    {
        $this->_server[$key] = $value;
    }
}

function requestFromEnv()
{
    $request = new Request;
    foreach($_SERVER as $key=>$value) {
        $request->addServerParam($key, $value);
    }
    return $request;
}
?>
