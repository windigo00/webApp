<?php
namespace App\Model\Traits;

/**
 * Description of ModelGetSetTrait
 * getters and setters for object with entity
 * @author KuBik
 */
trait ModelGetSetTrait {
	public function __get($name) {
		$tmp = $this->entity;
//		\Tracy\Debugger::barDump($tmp->$name, $name);
		return $tmp->$name;
	}
	public function __set($name, $value) {
		$this->entity->$name = $value;
	}
	public static function __callStatic($method, $params) {
		$ret = @forward_static_call(array(static::$entityClass, $method), !empty($params)?$params[0]:NULL);
		if (!$ret) {
			$ret = @forward_static_call(array(static::$entityClass,'getRepository'));
			if ($ret) {
				$ret = $ret->$method($params[0]);
			}
		}
		return $ret;
	}
	public function __call($method, $params) {

		$getset = substr($method, 0, 3);
		$rest = strtolower(substr($method, 3));
		switch ($getset) {
			case 'get':
				if (property_exists($this, $rest)){
					return $this->$rest;
				} elseif (property_exists($this->entity, $rest)) {
					return $this->entity->$rest;
				} else {
					throw new \Exception("name '{$rest}' not defied in ".get_class($this)."!");
				}
				break;
			case 'set':
				if (property_exists($this, $rest)){
					$this->$rest = $params[0];
					return $this;
				} elseif (property_exists($this->entity, $rest)) {
					return $this->entity->$rest = $params[0];
				} else {
					throw new \Exception("name '{$rest}' not defied in ".get_class($this)."!");
				}
				break;
			default :
				// call native methods of repository
				// shortcut
//				dump($this);exit;
				return call_user_func($this->resource->$method, $params);

				break;
		}
	}
}
