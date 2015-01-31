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
	protected $_em;
	/**
	 *
	 * @var EntityManager
	 */
	public static $_instance;
	
	public function __construct($connection, $entityDir, $devmode = FALSE) {
		$config = Setup::createAnnotationMetadataConfiguration(array($entityDir), $devmode);
		$this->_em = \Doctrine\ORM\EntityManager::create($connection, $config);
	}
	
	public static function set($cfg) {
		if (!self::$_instance)
			self::$_instance = new self($cfg);
//		return self::$_instance->ge;
	}
	/**
	 * 
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function get() {
		return $this->_em;
	}
	public function getRepository($classStr) {
		return $this->_em->getRepository($classStr);
	}
}
