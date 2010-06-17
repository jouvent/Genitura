<?php

$faq_routes = array(
        route('^$','cms::faq',array()),
        route('^add$','cms::faq_add',array()),
        route('^list$','cms::faq_list',array()),
        route('^edit/(?<id>\d+)$','cms::faq_edit',array()),
    );
