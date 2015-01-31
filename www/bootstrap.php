<?php
// bootstrap.php
require_once "../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup,
	Doctrine\ORM\EntityManager;

$paths = array("../app/lib/map");

use Doctrine\ORM\Mapping\Driver\YamlDriver;

$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '1111',
    'dbname'   => 'system5',
);

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);