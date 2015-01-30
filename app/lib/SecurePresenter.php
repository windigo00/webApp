<?php
namespace App\Model\Presenters;

use Nette
		;
/**
 * Description of SecurePresenter
 *
 * @author KuBik
 */
abstract class SecurePresenter extends BasePresenter {
	protected $goingToLog = false;
	protected function startup() {
		parent::startup();
		if (!$this->goingToLog) {
			if (!$this->getUser()->isAllowed($this->presenter->name)) {
				if ($this->user->logoutReason === Nette\Security\IUserStorage::INACTIVITY) {
					$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
				}
				$this->redirect('Sign:in', array('backlink' => $this->storeRequest()));
			}
		}
	}
}
