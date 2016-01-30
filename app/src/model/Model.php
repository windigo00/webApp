<?php

namespace App\Model;

use App\Management\EntityManager;

/**
 * Description of Model
 *
 * @author KuBik
 */
abstract class Model {
	use \App\Model\Traits\ModelGetSetTrait,
		\App\Model\Traits\SearchTrait;
	
	protected static $entityClass;
	/**
	 *
	 * @var Entity
	 */
	protected $entity;
	
	public function __construct(Entity $entity = NULL) {
		if ($entity !== NULL) {
			$this->entity = $entity;
		} else {
			$class = static::getEntityClass();
			$this->entity = new $class;
		}
	}
	
	public function getEntity() {
		return $this->entity;
	}
	/**
	 * Returns string name if entity class or throws an exception to warn developer to set model entity class.
	 * @return string
	 * @throws \Exception
	 */
	public static function getEntityClass() {
		if (!isset(static::$entityClass)) {
			throw new \Exception('Class "' . get_class() . '" does not have $entityClass value set!');
		} 
//		elseif (!class_exists(static::$entityClass, TRUE)) {
//			throw new \Exception('Class "' . static::$entityClass . '" does not exist!');
//		}
		return static::$entityClass;
	}
	/**
	 * Stores changes in database
	 * @param boolean $autoflush
	 */
	public function persist($autoflush = TRUE) {
		if ($this->entity) {
			$this->entity->persist($autoflush);
		}
	}
}
