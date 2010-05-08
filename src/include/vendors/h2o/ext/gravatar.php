<?php
h2o::addTag('gravatar');

class Gravatar_Tag extends H2o_Node {
    private $email;
    private $img_size;
    
    function __construct($argstring, $parser, $pos = 0) {
		if (!empty($argstring)) {
	    	$args = explode(" ", trim($argstring));
    		$this->email = strtolower($args[0]);
    		$this->img_size = ($args[1] ? $args[1] : 80);
            if(is_numeric($this->email)){
                $this->img_size = $this->email;
                $this->email = '';
            }
    		/*
    		 * TODO Fix to manage custom default image
    		 */
		} else {
			$this->img_size = 80;
		}
    }
    
    function render($context, $stream) {
    	$context->push();
    	if (substr($this->email, 0, 1) == ":")
    		$this->email = $context->resolve($this->email);
    	$output = '<img src="http://www.gravatar.com/avatar/'.
    		(!empty($this->email) ? md5($this->email) . '.jpg' : '') .
    		'?s='.$this->img_size.'" alt="gravatar-image"/>';

    	$context->pop();
        $stream->write($output);
    }
}
 

?>
