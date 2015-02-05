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
//			Model\DBObject::setDB($database);
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
		$presenter = explode(':', $this->getName());
		$tpls = $this->context->parameters['templates'];
		$file = realpath(getcwd()."/..{$tpls}");
		return array(
//			"{$file}/../@{$layout}.latte",
//			"{$file}/../@{$layout}.phtml",
			"{$file}/@$layout.latte",
			"{$file}/@$layout.phtml",
		);
	}
	/**
	 * @see Nette\Application\UI\Presenter
	 */
	public function formatTemplateFiles() {
		$presenter = explode(':', $this->getName());
		$tpls = $this->context->parameters['templates'];
		$file = realpath("..{$tpls}{$presenter[1]}");
		$file2 = realpath("..{$tpls}../base/{$presenter[1]}");
		return array(
			"{$file}/{$this->view}.latte",
			"{$file}/{$this->view}.phtml",
			"{$file2}/{$this->view}.latte",
			"{$file2}/{$this->view}.phtml",
		);
	}
	
//	protected function setTpl($tplFile = ''){
//		if ($tplFile=='') {
//			if ($this->tplName=='') {
//				$this->tplName = 'default.latte';
//			}
//		} else {
//			$this->tplName = $tplFile;
//		}
//		$pth = $this->getTplPath().'/'.($this->tplName);
//		return $pth;
//	}
//	protected function getTplPath() {
//		
//		if (!$this->tplDir){
//			$tpls = $this->presenter->context->parameters['templates'];
//			$file = $tpls;
//			$this->tplDir = realpath($file);
//		}
//		$dir = $this->tplDir;
//		return $dir;
//	}
	protected function beforeRender() {
//		$this->template->setFile($this->setTpl());
		$this->template->setTranslator(Model\Translator::get());
//		$this->template->render();
		parent::beforeRender();
	}
}
