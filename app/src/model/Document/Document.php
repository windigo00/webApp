<?php

namespace App\Model;

class Document extends Model {
	protected static $entityClass = '\App\Model\Entities\Documents';

	/**
	 * adds one view for document
	 */
	public function addView() {
//		$this->set(static::COLUMN_VIEWS, $this->get(static::COLUMN_VIEWS)+1);
	}
	/**
	 * 
	 * @param type $path
	 * @return null
	 */
	public static function getByPath($path, $limit = 1) {
		/**
		 * @var \Doctrine\ORM\EntityManager
		 */
		$sel = self::getRepository()->findByPath($path);
		foreach($sel as &$tmp){
			$tmp = new self($tmp);
		}
		return $sel;
	}
	
	public static function getAll() {
		$sel = self::getRepository()->getAll();
		dump($sel);
		foreach($sel as &$tmp){
			$tmp = new self($tmp);
		}
		return $sel;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function renderTemplate() {
		$tpl = $this->getTemplate();
		if (!empty($tpl)) {
			$doc = new \DOMDocument();
			if (@$doc->loadXML($tpl)) {
				$tpl = $doc->saveHTML($doc->getElementsByTagName('template')->item(0));
				$tpl = preg_replace('#\<(\/)?content\>#', '<$1div>', $tpl);
				$tpl = preg_replace('#\<(\/)?template\>#', '<$1div>', $tpl);
				$tpl = preg_replace('#\<(\/)?heading\>#', '<$1h1>', $tpl);
				
				if (preg_match_all('#\{\{([^\}]+)\}\}#', $tpl, $matches)) {
					foreach ($matches[1] as $match) {
						$tpl = str_replace('{{'.$match.'}}', View\View::renderPlugin($match, $this), $tpl);
					}
					
				}
			}
		}
		return $tpl;
	}
}
