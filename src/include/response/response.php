<?php
class Response
{
    var $datas = array();
    var $template;

    public function Response($template, $datas)
    {
        $this->datas = $datas;
        $this->template = $template;
    }

    public function render() 
    {
        if (!isset($_COOKIE['lang'])) {
            $lang = 'fr';
        } else {
            $lang = $_COOKIE['lang'];
        }
        $h2o = new h2o(
            $this->template,
            array(
                'searchpath' => 'templates',
                'php-i18n' => array(
                    'locale' => $lang,
                    'charset' => 'UTF-8',
                    'gettext_path' => '/usr/bin/',
                    //'extract_message' => true,
                    //'compile_message' => true,
                    'tmp_dir' => '/tmp/',
                )
            )
        );
        //$session = get_session();
        //$logged = $session->get_logged_user();
        $globals = array(
            'lang' => $lang, 
            'IMG_URL' => IMG_URL,
            //'islogged' => $session->isLogged(),
            //'logged' => $logged,
        );
        return $h2o->render(array_merge($globals, $this->datas));
    }

    public function __toString()
    {
        return $this->render();
    }
}

class Redirect
{
    var $location;

    public function Redirect($location)
    {
        $this->location = $location;
    }

    public function render()
    {
        header('Location: '.$this->location);
        return '';
    }

    public function __toString()
    {
        return $this->render();
    }
}
?>
