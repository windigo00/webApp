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
abstract class TranslatedControl extends Control {
//	const TPL_PATH = '/../../AdminModule/templates/';
	
	abstract protected function setTpl();
	
	private $tplDir = NULL;
	protected function getTplPath($path = '') {
		if (is_null($this->tplDir)){
			$eds = addslashes(DIRECTORY_SEPARATOR);
			$this->tplDir = preg_replace('#('.$eds.'app'.$eds.'.+)$#', '', dirname($this->getReflection()->getFileName()));
		}
		$dir = $this->tplDir . ($path[0]=='/' ? '' : DIRECTORY_SEPARATOR) . $path;
		return $dir;
	}
	
	public function render()
	{
		$this->setTpl();
		$this->template->setTranslator(Translator::get());
		$this->template->render();
	}
}
