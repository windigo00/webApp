<?php
namespace App\Model;

use App\Management\EntityManager;
//use Grido\DataSources\IDataSource;
/**
 * Description of Entity
 * @author KuBik
 */
class Entity
{
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
					$this->$rest = $params[0];
					return $this;
				} else {
					throw new \Exception("name '{$rest}' not defied in ".get_class($this)."!");
				}
				break;
			default :
				// call native methods of repository
				// shortcut
				return call_user_func($this->resource->$method, $params);

				break;
		}
	}
	/**
	 * Loads entity by id
	 * @param integer $id
	 * @param \Doctrine\DBAL\LockMode $lockMode
	 * @param string $lockVersion
	 * @return \Doctrine\ORM\Mapping\Entity
	 */
	public static function load($id, $lockMode = \Doctrine\DBAL\LockMode::NONE, $lockVersion = null) {
		return static::getRepository()->find($id, $lockMode, $lockVersion);
	}
	/**
	 * 
	 * @param \App\Management\EntityManager $cnt
	 * @return \static
	 */
	public static function getRepository(EntityManager $cnt = null) {
		if ($cnt == NULL) {
			$cnt = EntityManager::get();
		}
		
//		dump($cnt);
		$ret = $cnt->getRepository(get_called_class());
		return $ret;
	}
	/**
	 * Creates Query builder
	 * @return \Doctrine\ORM\QueryBuilder
	 */
	public static function createQB(){
		$em = EntityManager::get();
		return $em->createQueryBuilder();
	}
	
	public static function getClass() {
		return get_called_class();
	}
	
	public function flush() {
		EntityManager::get()->flush();
	}
	public function persist($autoFlush = TRUE) {
		EntityManager::get()->persist($this);
		if ($autoFlush) {
			$this->flush();
		}
		return $this;
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
