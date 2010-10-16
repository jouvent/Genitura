<?php
class Request
{
    private $_params = array();

    public function addParams($params)
    {
        $this->_params = array_merge($this->_params, $params);
    }

    public function getParam($key)
    {
        return $this->_params[$key];
    }
}

function requestFromEnv()
{
    return new Request();
}
?>
