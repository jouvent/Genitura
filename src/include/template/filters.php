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
}

