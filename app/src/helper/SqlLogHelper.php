<?php
namespace App\Helper;

/**
 * Description of SqlLogHelper
 *
 * @author KuBik
 */
class SqlLogHelper extends \Doctrine\DBAL\Logging\DebugStack {
	
	protected $panel;
	protected static $_inst;
	protected function __construct() {
//		$this->conn = $connection;
	}
	
	public function startQuery($sql, array $params = null, array $types = null) {
		parent::startQuery($sql, $params, $types);
//		$q = $this->queries[$this->currentQuery];
//		dump($q);
	}

	public function stopQuery() {
		parent::stopQuery();
		$q = $this->queries[$this->currentQuery];
//		dump($q);
		\Tracy\Debugger::getBar()->getPanel('sqlDebug')->logQuery($q);
	}
	
	public static function get() {
		if (!self::$_inst) self::$_inst = new self();
		return self::$_inst;
	}
}
