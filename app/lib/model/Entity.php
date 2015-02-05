<?php
namespace App\Model;

use Grido\DataSources\IDataSource;
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

	public function __get($name) {
		if (property_exists($this, $name)){
			return $this->$name;
		}
		throw new \Exception('property \''.$name.'\' not exist!');
	}
	public function __set($name, $value) {
		if (property_exists($this, $name)){
			$this->$name = $value;
		} else {
			throw new \Exception('property \''.$name.'\' not exist!');
		}
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
	/**
	 * 
	 * @param \App\Management\EntityManager $cnt
	 * @return \static
	 */
	public static function getRepository(\App\Management\EntityManager $cnt = null) {
		if ($cnt == NULL) {
			if (self::$_em == NULL) {
				$cnt = self::$_em = \App\Management\EntityManager::getEm();
			} else {
				$cnt = self::$_em;
			}
		} else {
			self::$_em = $cnt;
		}
		
		dump($cnt);
		$ret = new static($cnt->getRepository(get_called_class()));
		return $ret;
	}

//	public function filter(array $condition) {
//		if (empty($condition)) return $this;
//	}
//
//	public function getCount() {
//		return 5;
//	}
//
//	public function getData() {
//		
//	}
//
//	public function limit($offset, $limit) {
//		throw new \Nette\NotImplementedException;
//	}
//
//	public function sort(array $sorting) {
//		throw new \Nette\NotImplementedException;
//	}
//
//	public function suggest($column, array $conditions, $limit) {
//		throw new \Nette\NotImplementedException;
//	}

}
