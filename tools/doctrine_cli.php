<?php
require_once(realpath(dirname(__FILE__)).'/../src/boot.php');

spl_autoload_register(array('Doctrine', 'autoload'));

// Configure Doctrine Cli
// Normally these are arguments to the cli tasks but if they are set here the arguments will be auto-filled
$config = array(
    'data_fixtures_path'  =>  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'fixtures',
    'models_path'         =>  $pwd . DIRECTORY_SEPARATOR . '/include/models',
    'migrations_path'     =>  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'migrations',
    'sql_path'            =>  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'sql',
    'yaml_schema_path'    =>  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'schema');

$cli = new Doctrine_Cli($config);
$cli->run($_SERVER['argv']);
