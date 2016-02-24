<?php
namespace App\Presenters;

use Nette\Security\IUserStorage
	;
/**
 * Description of SecurePresenter
 *
 * @author KuBik
 */
abstract class SecurePresenter extends BasePresenter {
	
	protected function startup() {
		parent::startup();
//		if (!$this->goingToLog) {
			if (!$this->user->loggedIn) {
				if ($this->user->logoutReason === IUserStorage::INACTIVITY) {
					$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
				}
				$this->redirect('Sign:in', array('backlink' => $this->storeRequest()));
			} elseif (!$this->getUser()->isAllowed($this->presenter->name, $this->presenter->action)) {
				$this->redirect('Security:notAllowed', array('backlink' => $this->storeRequest()));
			}
//		}
	}
	
	
}
