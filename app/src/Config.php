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
	public static function set(\Nette\Configurator $appCfg, $cnt) {
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
	/**
	 * 
	 * @return \Nette\DI\Container
	 */
	public static function getContainer() {
		return self::$_appContainer;
	}
	
	public static function getParameter($param) {
		$params = self::$_appContainer->getParameters();
		
		if (isset($params[$param]))
			return $params[$param];
		return array();
	}
}
