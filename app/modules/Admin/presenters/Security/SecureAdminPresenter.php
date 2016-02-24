<?php
namespace App\Modules\Admin\Presenters;

use Nette\Security\IUserStorage;
/**
 * Description of SecureAdminPresenter
 *
 * @author KuBik
 */
abstract class SecureAdminPresenter extends BaseAdminPresenter {
	
//	protected function startup() {
//		parent::startup();
////		return;
//		if (!$this->user->loggedIn) {
//			if ($this->user->logoutReason === IUserStorage::INACTIVITY) {
//				$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
//			}
//			$this->redirect('Sign:in', array('backlink' => $this->storeRequest()));
//		} elseif (!$this->getUser()->isAllowed($this->presenter->name, $this->presenter->action)) {
//			$this->redirect('Security:notAllowed',array('backlink' => $this->storeRequest()));
//		}
//	}
	
	
}
