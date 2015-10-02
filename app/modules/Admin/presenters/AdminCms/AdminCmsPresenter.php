<?php
namespace App\Modules\Admin\Presenters;

/**
 * Description of AdminModule
 *
 * @author KuBik
 */
class AdminCmsPresenter extends AdminModulePresenter {
	
	public function formatTemplateFiles($view = NULL) {
		$view = explode(':', $this->getName())[1];
		$view = str_replace('AdminCms', '', $view);
		
		return parent::formatTemplateFiles('AdminCms/'.$view);
	}
	
	public function renderDefaullt() {
		
	}
	
	
}
