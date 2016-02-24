<?php
namespace App\Model\Traits;

/**
 * Description of SearchTrait
 * findBy methods
 * @author KuBik
 */
trait SearchTrait {
	
	public static function get($id) {
		if ($id !== NULL) {
			$entity = self::rep()->find($id);
		} else {
			$entity = new static;
		}
		return $entity;
	}
	public static function findAll() {
		return self::rep()->findAll();
	}
	
	public static function findBy($attributes) {
		return self::rep()->findBy($attributes);
		
	}
	public static function findOneBy($attributes) {
		return self::rep()->findOneBy($attributes);
	}
}
