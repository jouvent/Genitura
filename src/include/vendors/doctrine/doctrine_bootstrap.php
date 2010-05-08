<?php
spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));

$manager = Doctrine_Manager::getInstance();
$manager->setAttribute(
    Doctrine_Core::ATTR_MODEL_LOADING,
    Doctrine_Core::MODEL_LOADING_CONSERVATIVE
);

$manager->setAttribute(
    Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES,
    true
);

$manager->setAttribute(
    Doctrine_Core::ATTR_VALIDATE,
    Doctrine_Core::VALIDATE_ALL
);

$manager->setAttribute(
    Doctrine_Core::ATTR_USE_DQL_CALLBACKS,
    true
);

$manager->setAttribute(
    Doctrine_Core::ATTR_AUTO_FREE_QUERY_OBJECTS,
    true
);

$manager = Doctrine_Manager::getInstance();
$dsn = SQL_URL;
$conn = Doctrine_Manager::connection(array($dsn, SQL_USER, SQL_PASS));
$manager->connection()->setCharset('utf8');   

