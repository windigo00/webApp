<?php
namespace App\Model;

/**
 * Description of Entity
 *
 * @author KuBik
 */
class Entity{
	protected static $_em;
	public $repo;

	public function __construct($repo = NULL) {
		$this->repo = $repo;
	}

	public function __call($method, $params) {

		$getset = substr($method, 0, 3);
		$rest = strtolower(substr($method, 3));
		switch ($getset) {
			case 'get':
				if (property_exists($this, $rest)){
					return $this->$rest;
				} else {
					throw new \Exception("name '{$rest}' not defied in ".get_class($this)."!");
				}
				break;
			case 'set':
				if (property_exists($this, $rest)){
					$this->$rest = $params;
					return $this;
				} else {
					throw new \Exception("name '{$rest}' not defied in ".get_class($this)."!");
				}
				break;
			default :
				return $this->$method($params);
				break;
		}
	}
	
	public static function get($id, $lockMode = \Doctrine\DBAL\LockMode::NONE, $lockVersion = null) {
		return static::$_em->getRepository(get_called_class())->find($id, $lockMode, $lockVersion);
	}
	public static function getRepository(\App\Management\EntityManager $cnt = null) {
		if (self::$_em) {
			if (!$cnt) {
				$cnt = self::$_em;
			}
		} else {
			if ($cnt) {
				self::$_em = $cnt;
			}
		}
		$ret = new static($cnt->getRepository(get_called_class()));
		return $ret;
	}
}
