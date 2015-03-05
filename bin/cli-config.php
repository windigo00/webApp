<?php
/**
 * @var \SystemContainer
 */
$container = require __DIR__ . '/../app/bootstrap.php';
use App\Configs\AppConfig,
	App\Management\EntityManager;
$conn = $container->getParameters()['doctrine']['connection'];
$entDir = $container->getParameters()['doctrine']['entityDir'];
$em = new EntityManager($conn, $entDir);
$em = $em->get();
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));