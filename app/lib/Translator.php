<?php
namespace App\Model;

use Nette,
	Nette\Environment
		;

/**
 * Description of Translator
 *
 * @author KuBik
 */
class Translator implements Nette\Localization\ITranslator 
{
	const LOCALE_CONFIG_KEY = 'locales';
	const LANG_CONFIG_KEY = 'default';

	protected $config;
	protected $dictionary;

	protected static $_instance;
	/**
	 * 
	 */
	protected function __construct() {
		$this->config = new \stdClass;
		$this->config->locale = Environment::getContext()
				->parameters[self::LOCALE_CONFIG_KEY][self::LANG_CONFIG_KEY];
		
		$tmp = glob(__DIR__.'/../locale/'.$this->config->locale.'/*.csv');
		$locales = array();
		foreach ($tmp as $tmpFile) {
//			echo $tmpFile.'<br>';
			$file = fopen($tmpFile, "r");
			while (list($key, $value) = fgetcsv($file)) {
				$locales[$key] = $value;
			}
			fclose($file);
		}
//		exit();
		$this->dictionary = $locales;
	}

	/**
     * Translates the given string.
     * @param  string   message
     * @param  int      plural count
     * @return string
     */
    public function translate($message, $count = NULL) {
        return isset($this->dictionary[$message]) ? $this->dictionary[$message] : $message;
    }
	
	public static function setLang($newLanguage) {
		self::get()->config->locale = $newLanguage;
	}
	public static function getLang() {
		return self::get()->config->locale;
	}
	
	public static function get() {
		if (empty(static::$_instance)) {
			static::$_instance = new static();
		}
		return static::$_instance;
	}
}
