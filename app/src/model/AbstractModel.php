<?php

namespace App\Model;

use \App\Management\EntityManager;
/**
 * Description of Model
 *
 * @author KuBik
 */
abstract class AbstractModel {
	use \App\Model\Traits\ModelGetSetTrait,
		\App\Model\Traits\SearchTrait;
	
	/**
	 * Returns class'es repository
	 * @return \Doctrine\ORM\EntityRepository
	 */
	public static function rep() {
		return EntityManager::get()->getRepository(get_called_class());
	}
	/**
	 * 
	 * @param string $alias
	 * @return \Doctrine\DBAL\Query\QueryBuilder
	 */
	public static function getQB($alias = 'u') {
		return EntityManager::get()->getRepository(get_called_class())->createQueryBuilder($alias);
	}
	
//	public function __construct(Entity $entity = NULL) {
//		if ($entity !== NULL) {
//			$this->entity = $entity;
//		} else {
//			$class = static::getEntityClass();
//			$this->entity = new $class;
//		}
//	}
	
//	public function getEntity() {
//		return $this->entity;
//	}
	/**
	 * Returns string name if entity class or throws an exception to warn developer to set model entity class.
	 * @return string
	 * @throws \Exception
	 */
//	public static function getEntityClass() {
//		if (!isset(static::$entityClass)) {
//			throw new \Exception('Class "' . get_class() . '" does not have $entityClass value set!');
//		} 
////		elseif (!class_exists(static::$entityClass, TRUE)) {
////			throw new \Exception('Class "' . static::$entityClass . '" does not exist!');
////		}
//		return static::$entityClass;
//	}
	/**
	 * Stores changes in database
	 * @param boolean $autoflush
	 */
	public function persist($autoflush = TRUE) {
		$em = EntityManager::get();
		$em->persist($this);
		if ($autoflush) $em->flush($this);
	}
}
