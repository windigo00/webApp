<?php
namespace App\Modules\Admin\Presenters;

/**
 * Description of AdminModule
 *
 * @author KuBik
 */
class CmsPresenter extends ModulePresenter {
	
	public function formatTemplateFiles($view = NULL) {
		return parent::formatTemplateFiles($this->getTemplateFilesPath('Cms', $this->getName()));
	}
	
	public function renderDefaullt() {
		
	}
	
	public function formCancelled()
    {
        $this->redirect('default');
    }
}
