<?php

namespace App\Management;

use Doctrine\ORM\Tools\Setup;
/**
 * Description of EntityManager
 *
 * @author KuBik
 */
class EntityManager {
	/**
	 *
	 * @var \Doctrine\ORM\EntityManager
	 */
	public static $_instance;
	
	public static function set(\SystemContainer $cfg) {
		$p = $cfg->getParameters();
		$config = Setup::createAnnotationMetadataConfiguration(array($p['doctrine']['entityDir']), false);
		$connection_cfg = $p['doctrine']['connection'];
		self::$_instance = \Doctrine\ORM\EntityManager::create($connection_cfg, $config);
	}
	/**
	 * 
	 * @return \Doctrine\ORM\EntityManager
	 */
	public static function get() {
		return self::$_instance;
	}
}
