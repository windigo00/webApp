<?php
namespace App\Modules\Front\Presenters;

use App\Model\Page,
	App\Modules\Front\Components\PageControl
		;

/**
 * 
 *
 * @author KuBik
 */
class PagePresenter extends BaseFrontPresenter {
	
	protected function createComponentPage() {
		$page = new PageControl($this, 'page');
		return $page;
	}
	
	public function renderDefault() {
//		\Tracy\Debugger::barDump($this->request);
		$id = 1;
		$lng = $this['page']->getTranslator()->getLang();
		$page = Page::get($id);
		$version;
		foreach ($page->version as $version){
			if ($version->language == $lng)
				break;
		}
		$this['page']->setup($version);
		
	}
}