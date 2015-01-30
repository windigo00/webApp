<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Nette,
	Nette\Database,
	Nette\Database\Table,
	Nette\Database\Table\ActiveRow
		;
/**
 * Description of DBObject
 *
 * @author KuBik
 */
abstract class DBObject extends Nette\Object {
	
	protected static $dataPool = array();
	protected static $db;

	const 
		COLUMN_ID	= 'id',
		TABLE_NAME	= ''
	;
	
	
	protected $record;
	protected $newData = array();

	public function getId(){
		return $this->get(static::COLUMN_ID);
	}
	public function setId($id){
		$this->set(static::COLUMN_ID, $id);
		return $this;
	}
	
	protected function get($name) {
		return !isset($this->newData[$name]) ?
			$this->record[$name] : $this->newData[$name];
	}	
	protected function set($name, $value) {
		return $this->newData[$name] = $value;
	}	

	public function __construct($record = NULL) {
		if (!empty($record)) {
			$this->record = $record;
			if (!isset(self::$dataPool[static::TABLE_NAME])) {
				self::$dataPool[static::TABLE_NAME] = array();
			}
			self::$dataPool[static::TABLE_NAME][$record[static::COLUMN_ID]] = $this;
		} else {
			$this->record = new ActiveRow(array(static::COLUMN_ID => NULL), self::getTable());
		}
		
	}
	/**
	 * @return Nette\Database\Table Description
	 */
	
	public static function getTable($tableName = ''){
		if(empty($tableName)) {
			$tableName = static::TABLE_NAME;
		}
		return static::getDB()->table($tableName);
	}

	public static final function getDB() {
		return self::$db;
	}
	public static final function setDB(Database\Context $context = NULL) {
		self::$db = $context;
		
	}
	
	public static function getById($id) {
		if (isset(self::$dataPool[static::TABLE_NAME][$id])) {
			return self::$dataPool[static::TABLE_NAME][$id];
		}
		return new static(static::getTable()->get($id));
	}
	
	public function getRecord() {
		return $this->record;
	}

	/**
	 * 
	 * @return array<\App\Model\Document>
	 */
	public static function getAll() {
		$selection = static::getTable()->select('*');
		$items = array();
		while($tmp = $selection->fetch()){
			$items[] = new static($tmp);
		}
		return $items;
	}
	
	public function save() {
		if ($this->getId() == NULL) {
			return static::getTable()->insert($this->newData);
		} else {
			return $this->record->update($this->newData);
		}
	}
	public function delete() {
		$this->record->delete();
	}
}
