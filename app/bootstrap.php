<?php
use Nette\Configurator,
	Nette\Diagnostics\Debugger,
	Nette\Environment
		;

ob_start();

//require_once __DIR__.'/config/autoconfig.php';

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;
$debugMode = TRUE;
$configSection = $debugMode ? Environment::DEVELOPMENT : Environment::PRODUCTION; 
$configurator->setDebugMode($debugMode);  // debug mode MUST NOT be enabled on production server
$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__ . '/../vendor/others')
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/settings.neon');
$configurator->addConfig(__DIR__ . '/config/settings.db.neon');
$tmp = explode('/', $_SERVER['REQUEST_URI']);
$module = strtolower($tmp[1]);

//$moduleCfg = __DIR__ . '/config/'.$module.'/settings.neon';
//if (file_exists($moduleCfg)) $configurator->addConfig($moduleCfg);
//$moduleCfg = __DIR__ . '/config/'.$module.'/settings.db.neon';
//if (file_exists($moduleCfg)) $configurator->addConfig($moduleCfg);
$modCfg = __DIR__.'/modules/'.  ucfirst($module).'/bootstrap.php';
if (file_exists($modCfg))
	require $modCfg;
//$isDevMode = true;
//
//$entityManager = EntityManager::create(array('driver' => 'pdo_mysql'), $config);

$container = $configurator->createContainer();
//\App\Management\EntityManager::set($container);
\App\Configs\AppConfig::set($configurator, $container);

return $container; 