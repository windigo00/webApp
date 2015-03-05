<?php
namespace App\Model;

/**
 * Description of Language
 *
 * @author KuBik
 */
trait Language {
	protected static $lang = array(
		'cs_CZ','de_DE','en_GB','en_US','es_ES','fr_FR','nl_NL','pt_BR','ru_RU','zh_CN'
	);
	
	public static function getAll() {
		return static::$lang;
	}
	public static function get($id) {
		return static::$lang[$id];
	}
}
