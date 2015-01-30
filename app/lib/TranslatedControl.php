<?php
namespace App\Model;

use Nette,
	Nette\Application\UI\Control
		;
/**
 * Description of TranslatedControl
 *
 * @author KuBik
 */
class TranslatedControl extends Control {
	
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
			$file = "..{$tpls}components/";
			$this->tplDir = realpath($file);
		}
		$dir = $this->tplDir;
		return $dir;
	}

	public function render()
	{
		$this->template->setFile($this->setTpl());
		$this->template->setTranslator(Translator::get());
		$this->template->render();
	}
}
