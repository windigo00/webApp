<?php
namespace App\Model;

use Nette\Application\UI\Control
		;
/**
 * Description of TranslatedControl
 *
 * @author KuBik
 */
abstract class TranslatedControl extends Control {
	
	public abstract function setup($param);
	
	protected function setTpl($tplFile = ''){
		if ($tplFile=='') {
			if ($this->tplName=='') {
				$this->tplName = 'default.latte';
			}
		} else {
			$this->tplName = $tplFile;
		}
		$pth = $this->getTplPath().'/'.($this->tplName);
		return $pth;
	}

	protected $tplDir = NULL;
	protected $tplName = NULL;
	protected function getTplPath() {
		if (!$this->tplDir){
			$tpls = $this->presenter->context->parameters['templates'];
			$file = "../app{$tpls}components/";
			$this->tplDir = realpath($file);
		}
		return $this->tplDir;
	}

	public function render()
	{
		$this->template->setFile($this->setTpl());
		$this->template->locale = Translator::get();
		$this->template->setTranslator($this->template->locale);
		$this->template->render();
	}
}
