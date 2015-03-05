<?php

require __DIR__ . '/../../vendor/autoload.php';

if (!class_exists('Tester\Assert')) {
	echo "Install Nette Tester using `composer update --dev`\n";
	exit(1);
}

Tester\Environment::setup();

//$configurator = new Nette\Configurator;
//$configurator->setDebugMode(FALSE);
//$configurator->setTempDirectory(__DIR__ . '/../temp');
//$configurator->createRobotLoader()
//	->addDirectory(__DIR__ . '/../app')
//	->register();
//
//$configurator->addConfig(__DIR__ . '/../app/config/config.neon');
//$configurator->addConfig(__DIR__ . '/../app/config/settings.neon');
//$configurator->addConfig(__DIR__ . '/../app/config/settings.db.neon');
//$configurator->addConfig(__DIR__ . '/../app/config/router.neon');
//$configurator->addConfig(__DIR__ . '/../app/config/cli/config.neon');

require __DIR__ . '/../bootstrap.php';
//use App\Management\EntityManager;
//$conn = $container->getParameters()['doctrine']['connection'];
//$entDir = $container->getParameters()['doctrine']['entityDir'];
//$em = new EntityManager($conn, $entDir);
//$em = $em->get();
//ini_set('memory_limit', '1000M');
//Tracy\Debugger::enable(Tracy\Debugger::PRODUCTION);
//$configurator->addConfig(__DIR__ . '/../app/config/config.local.neon');
return $configurator;
