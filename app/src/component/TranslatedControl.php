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
	/**
	 *
	 * @var Translator
	 */
	protected $translator;
	
	public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
		parent::__construct($parent, $name);
		$this->translator = Translator::get();
	}
	/**
	 * 
	 * @return \App\Model\Translator;
	 */
	public function getTranslator() {
		return $this->translator;
	}
	
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
	
	/**
	 * @see Nette\Application\UI\Presenter
	 */
	public function formatTemplateFiles() {
		$ret = array();
		
		$tpls = $this->presenter->context->parameters['templates'];
		$pth1 = "..\app{$tpls}".$this->getTplPath();
		$pth2 = "..\app{$tpls}../base/".$this->getTplPath();
		$file = realpath($pth1);
		$file2 = realpath($pth2);
		if (empty($file) && empty($file2)) {
			throw new \Exception('Tamplate path "'.$pth1.'" and "'.$pth2.'" does not exits!');
		}
		
		$ret[] = "{$file}/{$this->tplName}";
		
		if (!empty($file2)) {
			$ret[] = "{$file2}/{$this->tplName}";
		}
		foreach ($ret as $file) {
			if (is_file($file)) {
				return $file;
			}
		}
		throw new \Exception('Tamplate not found! Paths : "'.  implode('", "', $ret).'"');
	}

	protected $tplDir = NULL;
	protected $tplName = NULL;
	protected function getTplPath() {
		if (!$this->tplDir){
			$this->tplDir = "components/";
		}
		return $this->tplDir;
	}

	
	public function render()
	{
//		\Tracy\Debugger::barDump($this->getTemplate());
		$this->setTpl();
		$this->template->setFile($this->formatTemplateFiles());
		$this->template->setTranslator($this->translator);
		$this->template->render();
	}
}
