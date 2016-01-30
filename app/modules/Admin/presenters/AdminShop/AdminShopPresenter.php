<?php
namespace App\Modules\Admin\Presenters;

/**
 * Description of AdminModule
 *
 * @author KuBik
 */
class AdminShopPresenter extends AdminModulePresenter {
	
	public function formatTemplateFiles($view = NULL) {
		return parent::formatTemplateFiles($this->getTemplateFilesPath('AdminShop', $this->getName()));
	}
	
	public function renderDefaullt() {
		
	}
}
