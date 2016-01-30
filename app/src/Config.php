<?php
namespace App\Configs;

/**
 * neon config provider. see dir app/config/
 * singleton
 * @author KuBik
 */
class AppConfig {
	/**
	 * Instance
	 * @var \Nette\Configurator
	 */
	private static $_appConfig;
	/**
	 * application container
	 * @var \Nette\ComponentModel\IContainer
	 */
	private static $_appContainer;
	/**
	 * Set internal variables
	 * @param \Nette\Configurator $appCfg
	 * @param \Nette\ComponentModel\IContainer $cnt
	 */
	public static function set(\Nette\Configurator $appCfg, $cnt) {
		self::$_appConfig = $appCfg;
		self::$_appContainer = $cnt;
	}
	/**
	 * TODO: doc
	 * @return \Nette\Configurator
	 */
	public static function get() {
		return self::$_appConfig;
	}
	/**
	 * TODO: doc 
	 * @return \Nette\DI\Container
	 */
	public static function getContainer() {
		return self::$_appContainer;
	}
	/**
	 * TODO: doc
	 * @param string $param
	 * @return mixed
	 */
	public static function getParameter($param) {
		$params = self::$_appContainer->getParameters();
		
		if (isset($params[$param]))
			return $params[$param];
		return array();
	}
}
