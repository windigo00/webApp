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
	const PATH_CONFIG_KEY = 'path';

	protected $config;
	protected $dictionary = array();

	protected static $_instance;
	/**
	 * 
	 */
	protected function __construct() {
		$this->config = new \stdClass;
		$env = Environment::getContext()->parameters[self::LOCALE_CONFIG_KEY];
		$this->config->locale = $env[self::LANG_CONFIG_KEY];
		$this->config->path = $env[self::PATH_CONFIG_KEY];
		
		$this->initLanguage($this->config->locale);
	}

	/**
     * Translates the given string.
     * @param  string   message
     * @param  int      plural count
     * @return string
     */
    public function translate($message, $count = NULL) {
        return isset($this->dictionary[$this->config->locale][$message]) ? $this->dictionary[$this->config->locale][$message] : $message;
    }
	/**
	 * Initiates dictionary
	 * @param string $newLanguage
	 * @return boolean Whether the locale files were found.
	 */
	protected function initLanguage($newLanguage) {
		$path = '../..'.$this->config->path.$newLanguage;
		if (file_exists($path)) {
			$tmp = glob($path.'/*.csv');
			$locales = array();
			foreach ($tmp as $tmpFile) {
				$file = fopen($tmpFile, "r");
				while (list($key, $value) = fgetcsv($file)) {
					$locales[$key] = $value;
				}
				fclose($file);
			}
			$this->dictionary[$newLanguage] = $locales;
			return TRUE;
		} else {
			// trigger something or send a message
			\Tracy\Debugger::log('Language files do not exist on path: '.$path);
			return FALSE;
		}
	}
	/**
	 * Sets active locale and initiates dictionary if none set
	 * @param string $newLanguage
	 * @return boolean Indicates if the set succeded or not
	 */
	public function setLang($newLanguage) {
		if (!isset($this->dictionary[$newLanguage])) {
			if ($this->initLanguage($newLanguage)) {
				$this->config->locale = $newLanguage;
				return TRUE;
			}
		} else {
			$this->config->locale = $newLanguage;
			return TRUE;
		}
		return FALSE;
	}
	/**
	 * Returns active locale code
	 * @return string
	 */
	public function getLang() {
		return self::get()->config->locale;
	}
	/**
	 * Returns translator instance
	 * @return self
	 */
	public static function get() {
		if (empty(static::$_instance)) {
			static::$_instance = new static();
		}
		return static::$_instance;
	}
}
