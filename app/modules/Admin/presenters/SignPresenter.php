<?php

namespace App\Modules\Admin\Presenters;

use Nette,
	App\Model\TranslatedForm
        ;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BaseAdminPresenter
{

	/**
	 * password reset form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentResetForm()
	{
		$form = new TranslatedForm;
		$trans = $form->getTranslator();
		$form->addText('email', 'Email')
			->getControlPrototype()->addAttributes(array('placeholder'=> $trans->translate('Please enter your email.')))
			->setRequired('Please enter your email.');
		$form->addSubmit('send', 'Send reset email');
		
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->resetFormSucceeded;
		return $form;
	}
	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new TranslatedForm;
		$trans = $form->getTranslator();
		$form->addText('username', 'Username')
			->getControlPrototype()->addAttributes(array('placeholder'=> $trans->translate('type username')))
			->setRequired($trans->translate('Please enter your username.'));

		$form->addPassword('password', 'Password')
			->getControlPrototype()->addAttributes(array('placeholder'=> 'type password'))
			->setRequired($trans->translate('Please enter your password.'));

		$form->addCheckbox('remember', $trans->translate('Remember Me'));

		$form->addSubmit('send', $trans->translate('Sign in'));

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form, $values)
	{
		if ($values->remember) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->user->login($values->username, $values->password);
			if ($this->getParam('backlink')) {
				$this->getApplication()->restoreRequest($this->getParam('backlink'));
			} else {
				$this->redirect('Dashboard:');
			}

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
			$this->redirect('this');
		}
	}
	public function resetFormSucceeded($form, $values)
	{
		//try send email
		
		$this->flashMessage('A new password was sent to your email address. Please check your email and click Back to Login.');
		$this->redirect('in');
	}

	public function actionDefault()
	{
		if ($this->user->loggedIn)
			$this->redirect('out');
		$this->redirect('in');
	}
	public function actionReset()
	{
		$this->layout = 'layout2';
	}

	public function renderIn()
	{
		if ($this->user->loggedIn) {
			$this->redirect('Dashboard:');
		}
		
		$this->layout = 'layout2';
	}
	public function renderOut()
	{
		$this->getUser()->logout(TRUE);
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
