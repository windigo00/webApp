<?php
namespace App\Configs;

/**
 * Description of Config
 *
 * @author KuBik
 */
class AppConfig {
	/**
	 *
	 * @var \Nette\Configurator
	 */
	private static $_appConfig;
	/**
	 *
	 * @var \SystemContainer
	 */
	private static $_appContainer;
	/**
	 * 
	 * @param \Nette\Configurator $appCfg
	 */
	public static function set(\Nette\Configurator $appCfg, \SystemContainer $cnt) {
		self::$_appConfig = $appCfg;
		self::$_appContainer = $cnt;
	}
	/**
	 * 
	 * @return \Nette\Configurator
	 */
	public static function get() {
		return self::$_appConfig;
	}
	
	public static function getParameter($param) {
		$params = self::$_appContainer->getParameters();
		if (isset($params[$param]))
			return $params[$param];
		return array();
	}
}
