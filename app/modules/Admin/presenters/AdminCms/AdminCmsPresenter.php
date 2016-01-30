<?php
namespace App\Modules\Admin\Presenters;

/**
 * Description of AdminModule
 *
 * @author KuBik
 */
class AdminCmsPresenter extends AdminModulePresenter {
	
	public function formatTemplateFiles($view = NULL) {
		return parent::formatTemplateFiles($this->getTemplateFilesPath('AdminCms', $this->getName()));
	}
	
	public function renderDefaullt() {
		
	}
	
	public function formCancelled()
    {
        $this->redirect('default');
    }
}
