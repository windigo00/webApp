<?php

namespace App\Model\Catalog;
use App\Model\LangPath;
/**
 * @author KuBik
 * 
 **/
class Product extends \App\Model\Model
{
	protected static $entityClass = '\App\Model\Entities\CatalogProductEntity';
	protected $urlPath;
	
	/**
	 * Returns product url
	 * @param \Nette\Application\IPresenter $presenter
	 * @return string
	 */
	public function getUrlPath($presenter) {
		if (!$this->urlPath) {
			$this->urlPath = LangPath::getPath(__CLASS__, $this->entity_id);
			if ($this->urlPath) {
				$this->urlPath = $this->urlPath->value;
			} else {
				$this->urlPath = '';
			}
		}
		return $this->urlPath.'.html';
	}
	
	
}
