<?php
namespace App\Modules\Admin\Presenters;

use Nette,
	App\Model,
	App\Modules\Admin\Components\TopMenu
		;
/**
 * Description of SecurePresenter
 *
 * @author KuBik
 */
abstract class SecurePresenter extends BasePresenterAdmin {
	
	
	public function beforeRender() {
		parent::beforeRender();
		if (!$this->user->isLoggedIn()) {
			if ($this->user->logoutReason === Nette\Security\IUserStorage::INACTIVITY) {
				$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
			}
			$this->redirect('Sign:in', array('backlink' => $this->storeRequest()));
		}
	}
}
