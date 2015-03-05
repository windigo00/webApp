<?php

namespace App\Model;

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
	
	public function __construct($entity = NULL) {
		$this->entity = $entity == NULL ? new static::$entityClass : $entity;
	}
	
	public static function getEntityClass() {
		return static::$entityClass;
	}
	
	public function persist($autoflush = TRUE) {
		if ($this->entity) {
			$this->entity->persist($autoflush);
		}
	}
}
