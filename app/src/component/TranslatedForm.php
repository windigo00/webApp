<?php
namespace App\Model;

use Nette\Application\UI\Form
		;
/**
 * Description of TranslatedForm
 *
 * @author KuBik
 */
class TranslatedForm extends Form {
	
	public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
		parent::__construct($parent, $name);
		$this->setTranslator(\App\Model\Translator::get());
	}
	
	protected function setTpl($tplFile = ''){
		if ($tplFile=='') {
			if ($this->tplName=='') {
				$this->tplName = 'form.latte';
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

//	public function render()
//	{
//		$this->template->setFile($this->setTpl());
//		$this->template->setTranslator(Translator::get());
//		$this->template->render();
//	}
	
	public function setValues($values, $erase = FALSE) {
		if (is_object($values)) {
			foreach ($this->getComponents() as $name => $control) {
				if (isset($values->$name)) {
					/**
					 * Will not set referenced objects. that must be done explicitly
					 */
					if (!is_object($values->$name)) {
						$control->setValue($values->$name);
					} else {
						$control->setValue(NULL);
					}
				} elseif ($erase) {
					$control->setValue(NULL);
				}
			}
			return $this;
		} else {
			parent::setValues($values, $erase);
		}
	}
}
