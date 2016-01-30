<?php

namespace App\Model\Presenters;

use Nette,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	protected $tplDir = NULL;
	protected $tplName = NULL;
	public function __construct(Nette\Database\Context $database) {
		try {
			parent::__construct();
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
		$tpls = $this->context->parameters['templates'];
		$file = realpath("../app{$tpls}");
		$file2 = realpath("../app{$tpls}../base");
		$ret = array(
			"{$file}/@$layout.latte",
			"{$file}/@$layout.phtml",
			"{$file2}/@{$layout}.latte",
			"{$file2}/@{$layout}.phtml",
		);
		return $ret;
	}
	/**
	 * @see Nette\Application\UI\Presenter
	 */
	public function formatTemplateFiles($view = NULL) {
		$ret = array();
		if ($view !== NULL) {
			$presenter = $view;
		} else {
			$presenter = explode(':', $this->getName())[1];
		}
		$tpls = $this->context->parameters['templates'];
		$pth1 = "..\app{$tpls}{$presenter}";
		$pth2 = "..\app{$tpls}../base/{$presenter}";
		$file = realpath($pth1);
		$file2 = realpath($pth2);
		if (empty($file) && empty($file2)) {
			throw new \Exception('Tamplate path "'.$pth1.'" and "'.$pth2.'" does not exits!');
		}
		
		$ret[] = "{$file}/{$this->view}.latte";
		$ret[] = "{$file}/{$this->view}.phtml";
		
		if (!empty($file2)) {
			$ret[] = "{$file2}/{$this->view}.latte";
			$ret[] = "{$file2}/{$this->view}.phtml";
		}
		return $ret;
	}

	protected function beforeRender() {
		if (isset($this->context->parameters['coat'])) {
			$this->template->basePath = $this->context->parameters['coat'];
		}
		if (isset($this->context->parameters['scriptPath'])) {
			$this->template->scriptPath = $this->context->parameters['scriptPath'];
		}
		$this->template->setTranslator(Model\Translator::get());
		if (!isset($this->template->user)) {
		}
		parent::beforeRender();
	}
}
