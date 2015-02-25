<?php

namespace App\Management;

use Doctrine\ORM\Tools\Setup;
/**
 * Description of EntityManager
 *
 * @author KuBik
 */
class EntityManager extends \Nette\Database\Context{

	/**
	 *
	 * @var \Doctrine\ORM\EntityManager
	 */
	public static $config;
	
	public function __construct($connection, $entityDir, $devmode = FALSE) {
		if (self::$config === NULL) {
			$config = Setup::createAnnotationMetadataConfiguration(array($entityDir), $devmode);
			self::$config = \Doctrine\ORM\EntityManager::create($connection, $config);
			
		}
	}
	
//	public static function set($cfg) {
//		if (!self::$_instance)
//			self::$_instance = new self($cfg);
//		return self::$_instance->ge;
//	}
	/**
	 * 
	 * @return \Doctrine\ORM\EntityManager
	 */
	public static function get() {
		return self::$config;
	}
	public function getRepository($classStr) {
		return self::get()->getRepository($classStr);
	}
}
