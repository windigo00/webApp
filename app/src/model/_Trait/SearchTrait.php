<?php
namespace App\Model\Traits;
/**
 * Description of SearchTrait
 * findBy methods
 * @author KuBik
 */
trait SearchTrait {
	public static function get($id) {
		$entity = \App\Management\EntityManager::get()->find(static::getClass(), $id);
		$entity = new static($entity);
		return $entity;
	}
	public static function findAll() {
		$entity = static::getRepository()->findAll();
		foreach ($entity as &$item) {
			$item = new static($item);
		}
		return $entity;
	}
	
	public static function findBy($attributes) {
		$entity = static::getRepository()->findBy($attributes);
		foreach ($entity as &$item) {
			$item = new static($item);
		}
		return $entity;
		
	}
	public static function findOneBy($attributes) {
		$entity = static::getRepository()->findOneBy($attributes);
		
		return new static($entity);
	}
}
