<?php
require_once 'h2o/h2o.php';
h2o::addFilter('MyHtmlFilters');
class MyHtmlFilters extends FilterCollection {
    function checked($data) {
        if($data){
            return 'checked';
        }
    }
    function select($case,$default='')
    {
        $select = new select_class($case,$case);
        $select->set_default($default);

        return $select->get_html();
    }
    function title($type)
    {
        return title($type);
    }
    function slug_title($type)
    {
        return slug_title($type);
    }
    function bool($data)
    {
        $lang = $_COOKIE['deb_lang'];
        if($lang == 'fr') {
            if($data) {
                return "Oui";
            }
            return "Non";
        }
        if($data) {
            return "Yes";
        }
        return "No";
    }
    function status($status)
    {
        if($status < -1)
            return "annul&eacute;e";
        if($status == -1)
            return "cours d'envois";
        if($status <= 3)
            return "non confirm&eacute;";
        if($status >= 4)
            return "confirm&eacute;";
    }
    function gender($sex){
        $lang = $_COOKIE['deb_lang'];
        if($lang == 'fr'){
            if($sex = 'm')
                return "M.";
            else
                return "Mme.";
        } else {
            if($sex = 'm')
                return "Mr.";
            else
                return "Mrs.";
        }
    }
    function register_step($status, $step)
    {
        $class = '';
        if($status < $step){
            $class .= ' done';
        }
        if($status == $step){
            $class .= ' current';
        }
        if($status > $step){
            $class .= ' not_done';
        }
        return $class;
    }
}

