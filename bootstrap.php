<?php

// bootstrap.php
require_once "vendor/autoload.php";
 
use DoctrineORMToolsSetup;
use DoctrineORMEntityManager;
 
$paths = array("src");
$isDevMode = true;
 
// the connection configuration
$dbParams = array(
    'driver'    => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'test',
);
 
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);











?>
