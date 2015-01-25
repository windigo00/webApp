<?php

namespace App\Model\Presenters;

use Nette,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	public function __construct(Nette\Database\Context $database) {
		try {
			parent::__construct();
			Model\DBObject::setDB($database);
		} catch (\Exception $ex) {
			$this->flashMessage($ex->getMessage());
			$this->redirect('Error:', array('backlink' => $this->storeRequest()));
		}
	}
	/**
	 * @see Nette\Application\UI\Presenter
	 */
	public function formatLayoutTemplateFiles() {
		$layout = $this->layout ? $this->layout : 'layout';
		$dir = dirname($this->getReflection()->getFileName());
		return array(
			"$dir/../templates/@$layout.latte",
			"$dir/../templates/@$layout.phtml",
		);
	}
	/**
	 * @see Nette\Application\UI\Presenter
	 */
	public function formatTemplateFiles() {
		$presenter = explode(':', $this->getName());
		$dir = dirname($this->getReflection()->getFileName());
		return array(
			"$dir/../templates/{$presenter[1]}/$this->view.latte",
			"$dir/../templates/{$presenter[1]}/$this->view.phtml",
		);
	}
	
}
