<?php

namespace App\Modules\Admin\Presenters;

use Nette,
    App\Model,
    App\Model\Presenters\BasePresenter
        ;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenterAdmin
{


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Username:')
			->getControlPrototype()->setClass('form-control')
			->setRequired('Please enter your username.');

		$form->addPassword('password', 'Password:')
			->getControlPrototype()->setClass('form-control')
			->setRequired('Please enter your password.');

		$form->addCheckbox('remember', 'Keep me signed in')
				->getControlPrototype()->setClass('checkbox');

		$form->addSubmit('send', 'Sign in')
				->getControlPrototype()->setClass('btn btn-lg btn-success btn-block');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form, $values)
	{
		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Dashboard:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
